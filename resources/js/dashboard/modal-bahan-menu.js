import { isNaN } from "lodash";
import Swal from "sweetalert2";
import modal from "./modal";

export default () => {
    let modalBahanMenuEl = document.getElementById('modal-bahan-menu');

    let modalBahanMenuFormEl = {
        ingredient_id: modalBahanMenuEl.querySelector('select[name="ingredient_id"'),
        quantity: modalBahanMenuEl.querySelector('input[name="quantity"'),
    };

    // Create the modal
    let modalBahanMenu = modal('modal-bahan-menu');

    // CSRF Token
    modalBahanMenu.csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Modal activator
    modalBahanMenu.source = null;

    // Modal forms element
    modalBahanMenu.formEl = modalBahanMenuFormEl;

    // Modal forms valid status
    modalBahanMenu.formValid = {
        ingredient_id: true,
        quantity: true,
    };

    // Method for showing validation error
    modalBahanMenu.showError = function (elem, errMsg) {
        this.formEl[elem].classList.remove(
            'focus:border-orange-400',
            'focus:ring-orange-200'
        );
        this.formEl[elem].classList.add(
            'border-red-400',
            'focus:border-red-400',
            'focus:ring-red-200'
        );
        this.formEl[elem].nextElementSibling.innerText = errMsg;
        this.formValid[elem] = false;
    }

    // Method for hiding validation error
    modalBahanMenu.hideError = function (elem) {
        this.formEl[elem].classList.remove(
            'border-red-400',
            'focus:border-red-400',
            'focus:ring-red-200'
        );
        this.formEl[elem].classList.add(
            'focus:border-orange-400',
            'focus:ring-orange-200'
        );
        this.formEl[elem].nextElementSibling.innerText = '';
        this.formValid[elem] = false;
    }

    // Wrapper for openModal function
    modalBahanMenu.wrapOpenModal = function (event) {
        this.source = event.target;

        // Loop and get the parent until button found
        while (true) {
            if (_.lowerCase(this.source?.nodeName) !== 'button') this.source = this.source.parentElement;
            else break;
        }

        if (this.source.getAttribute('data-action') === 'update') this.populateForm();
        else this.populateSelect();

        this.openModal();
    }

    // Method for populating the input with measurement data
    // when edit button clicked
    modalBahanMenu.populateForm = function () {
        const bahanMenu = JSON.parse(this.source.getAttribute('data-bahan-menu'));

        this.formEl.quantity.value = bahanMenu.pivot.quantity;

        let optNode = document.createElement('option');
        optNode.appendChild(document.createTextNode(bahanMenu.name));
        optNode.setAttribute('value', bahanMenu.id);

        this.formEl.ingredient_id.innerHTML = '';
        this.formEl.ingredient_id.appendChild(optNode);
        this.formEl.ingredient_id.setAttribute('disabled', '');

        this.source.setAttribute('data-bahan-menu-id', bahanMenu.id);
    }

    modalBahanMenu.populateSelect = function () {
        const ingredients = JSON.parse(this.formEl.ingredient_id.getAttribute('data-available'));

        for (const bahan of ingredients) {
            let optNode = document.createElement('option');
            optNode.appendChild(document.createTextNode(bahan.name));
            optNode.setAttribute('value', bahan.id);

            this.formEl.ingredient_id.appendChild(optNode);
        }
    }

    // Wrapper for closeModal function
    modalBahanMenu.wrapCloseModal = function (event) {
        if (this.source.getAttribute('data-action') === 'update') {
            this.formEl.ingredient_id.removeAttribute('disabled');
        }

        this.source = undefined;

        // Resep input value
        for (const elem in this.formEl) {
            if (elem !== 'ingredient_id') this.formEl[elem].value = '';
            else {
                this.formEl[elem].selectedIndex = 0;
                this.formEl[elem].innerHTML = '';

                let optNode = document.createElement('option');
                optNode.appendChild(document.createTextNode('Select an Option'));

                this.formEl.ingredient_id.appendChild(optNode);
            }

            this.hideError(elem);
        }

        this.closeModal();
    }

    // Method for validating input
    modalBahanMenu.validate = function (isUpdate = false) {
        let isValid = true;

        // Validasi nama
        let validateIngredient = () => {
            if (this.formEl.ingredient_id.selectedIndex === 0 && !isUpdate) {
                this.showError('ingredient_id', 'Please select an ingredient.');
                return false;
            }

            this.hideError('ingredient_id');
            return true;
        }

        if (!validateIngredient()) isValid = false;

        let validateQuantity = () => {
            if (this.formEl.quantity.value === '') {
                this.showError('quantity', 'Quantity is required!');
                return false;
            }

            if (isNaN(this.formEl.quantity.value)) {
                this.showError('quantity', 'Quantity must be a number!');
                return false;
            }

            if (+(this.formEl.quantity.value) <= 0) {
                this.showError('quantity', 'Quantity invalid!');
                return false;
            }

            this.hideError('quantity');
            return true;
        }

        if (!validateQuantity()) isValid = false;

        return isValid;
    }

    // Modal for generating the form data
    modalBahanMenu.getFormData = function () {
        let formData = new FormData();
        formData.append('ingredient_id', this.formEl.ingredient_id.value);
        formData.append('quantity', this.formEl.quantity.value);

        return formData;
    }

    // Method for submitting the form
    modalBahanMenu.submit = function (event) {
        let button = event.target;

        let disableButton = () => {
            // Add the disabled attribut
            button.setAttribute('disabled', '');
            // Remove and add class
            button.classList.remove(
                'active:bg-orange-500',
                'hover:bg-orange-400'
            );
            button.classList.add(
                'opacity-50',
                'cursor-not-allowed'
            );
        };

        let enableButton = () => {
            // Add the disabled attribut
            button.removeAttribute('disabled');
            // Remove and add class
            button.classList.remove(
                'opacity-50',
                'cursor-not-allowed'
            );
            button.classList.add(
                'active:bg-orange-500',
                'hover:bg-orange-400'
            );
        };

        let action = this.source.getAttribute('data-action')

        if (this.validate(action === 'update')) {
            disableButton();

            let menuId = location.pathname.replace(/\/+$/, '').split('/')[3];
            let url = `http://localhost:8000/admin/menu/${menuId}/ingredient`;
            let reqMethod = 'POST';

            if (action === 'new') {
                url = `http://localhost:8000/admin/menu/${menuId}/ingredient`;
                reqMethod = 'POST';
            } else {
                const bahanMenuId = this.source.getAttribute('data-bahan-menu-id');
                url = `http://localhost:8000/admin/menu/${menuId}/ingredient/${bahanMenuId}`;
                reqMethod = 'POST';
            }

            let response = fetch(url, {
                method: reqMethod,
                headers: {
                    'X-CSRF-TOKEN': this.csrf,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: this.getFormData(),
            })
                .then((response) => {
                    if (response.ok) {
                        let result = response.json();
                        result.then(data => {
                            this.wrapCloseModal();

                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: data.message,
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(result => {
                                if (result.isDismissed) {
                                    location.reload();
                                }
                            });
                        });

                    } else if (response.status === 422) {
                        // console.log(response.status);
                        let result = response.json();
                        result.then(data => {
                            for (const key in data.errors) {
                                Alpine.store('modalBahanMenu').showError(key, data.errors[key][0]);
                                Alpine.store('modalBahanMenu').formValid[key] = false;
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: `Error: ${response.status}`,
                            text: 'Terjadi kesalahan ketika menyimpan data.'
                        });
                    }

                    enableButton();
                });
        }
    }

    return modalBahanMenu;
}
