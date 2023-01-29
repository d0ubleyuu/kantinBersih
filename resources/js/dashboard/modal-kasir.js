import { isNaN } from "lodash";
import Swal from "sweetalert2";
import modal from "./modal";

export default () => {
    let modalMenuEl = document.getElementById('modal-kasir');

    let modalMenuFormEl = {
        menu_name: modalMenuEl.querySelector('input[name="menu_name"'),
        selling_price: modalMenuEl.querySelector('input[name="selling_price"'),
    };

    // Create the modal
    let modalMenu = modal('modal-kasir');

    // CSRF Token
    modalMenu.csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Modal activator
    modalMenu.source = null;

    // Modal forms element
    modalMenu.formEl = modalMenuFormEl;

    // Modal forms valid status
    modalMenu.formValid = {
        menu_name: true,
        selling_price: true,
    };

    // Method for showing validation error
    modalMenu.showError = function (elem, errMsg) {
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
    modalMenu.hideError = function (elem) {
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
    modalMenu.wrapOpenModal = function (event) {
        this.source = event.target;

        // Loop and get the parent until button found
        while (true) {
            if (_.lowerCase(this.source?.nodeName) !== 'button') this.source = this.source.parentElement;
            else break;
        }

        if (this.source.getAttribute('data-action') === 'update') this.populateForm();

        this.openModal();
    }

    // Method for populating the input with measurement data
    // when edit button clicked
    modalMenu.populateForm = function () {
        const menu = JSON.parse(this.source.getAttribute('data-menu'));

        for (const elem in menu) {
            if (typeof this.formEl[elem] === 'undefined') continue;
            this.formEl[elem].value = menu[elem];
        }

        this.source.setAttribute('data-menu-id', menu.id);
    }

    // Wrapper for closeModal function
    modalMenu.wrapCloseModal = function (event) {
        this.source = undefined;

        // Resep input value
        for (const elem in this.formEl) {
            this.formEl[elem].value = '';

            this.hideError(elem);
        }

        this.closeModal();
    }

    // Method for validating input
    modalMenu.validate = function (isUpdate = false) {
        let isValid = true;

        // Validasi nama
        let validateName = () => {
            if (this.formEl.menu_name.value === '') {
                this.showError('menu_name', 'Menu name is required!');
                return false;
            }

            this.hideError('menu_name');
            return true;
        }

        if (!validateName()) isValid = false;

        let validateSelling = () => {
            if (this.formEl.selling_price.value === '') {
                this.showError('selling_price', 'Selling price is required!');
                return false;
            }

            if (isNaN(this.formEl.selling_price.value)) {
                this.showError('selling_price', 'Selling price must be a number!');
                return false;
            }

            this.hideError('selling_price');
            return true;
        }

        if (!validateSelling()) isValid = false;

        return isValid;
    }

    // Modal for generating the form data
    modalMenu.getFormData = function () {
        let formData = new FormData();
        formData.append('menu_name', this.formEl.menu_name.value);
        formData.append('selling_price', this.formEl.selling_price.value);

        return formData;
    }

    // Method for submitting the form
    modalMenu.submit = function (event) {
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

            let url = 'http://localhost:8000/admin/menu';
            let reqMethod = 'POST';

            if (action === 'new') {
                url = 'http://localhost:8000/admin/menu';
                reqMethod = 'POST';
            } else {
                const menuId = this.source.getAttribute('data-menu-id');
                url = `http://localhost:8000/admin/menu/${menuId}`;
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
                                    location.href = `${location.origin}/admin/menu/${data.id}`;
                                }
                            });
                        });

                    } else if (response.status === 422) {
                        // console.log(response.status);
                        let result = response.json();
                        result.then(data => {
                            for (const key in data.errors) {
                                Alpine.store('modalMenu').showError(key, data.errors[key][0]);
                                Alpine.store('modalMenu').formValid[key] = false;
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

    return modalMenu;
}
