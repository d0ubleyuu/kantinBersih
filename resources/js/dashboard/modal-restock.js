import { isNaN, result } from "lodash";
import Swal from "sweetalert2";
import modal from "./modal";

export default () => {
    let modalRestockEl = document.getElementById('modal-restock');

    let modalRestockFormEl = {
        name: modalRestockEl.querySelector('input[name="name"'),
        id: modalRestockEl.querySelector('input[name="id"'),
        capital_price: modalRestockEl.querySelector('input[name="capital_price"'),
        stock: modalRestockEl.querySelector('input[name="stock"'),
        added: document.getElementById('added'),
    };

    // Create the modal
    let modalRestock = modal('modal-restock');

    // CSRF Token
    modalRestock.csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Modal activator
    modalRestock.source = null;

    // Modal forms element
    modalRestock.formEl = modalRestockFormEl;

    modalRestock.stokTxt = 'Stok (Unit)';

    // Modal forms valid status
    modalRestock.formValid = {
        name: true,
        id: true,
        capital_price: true,
        stock: true,
        added: true,
    };

    // Method for showing validation error
    modalRestock.showError = function (elem, errMsg) {
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
    modalRestock.hideError = function (elem) {
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
    modalRestock.wrapOpenModal = function (event) {
        this.source = event.target;

        // Loop and get the parent until button found
        while (true) {
            if (_.lowerCase(this.source?.nodeName) !== 'button') this.source = this.source.parentElement;
            else break;
        }

        this.populateForm();

        this.openModal();
    }

    // Method for populating the input with measurement data
    // when edit button clicked
    modalRestock.populateForm = function () {
        const ingredient = JSON.parse(this.source.getAttribute('data-ingredient'));

        for (const elem in ingredient) {
            if (typeof this.formEl[elem] === 'undefined') continue;
            if (elem !== 'measurement_id') {
                this.formEl[elem].value = ingredient[elem];
            } else {
                this.formEl[elem].value = _.upperFirst(ingredient[elem]);
            }
        }

        this.stokTxt = `Stok (${ingredient.measurement.short_name})`;
        this.source.setAttribute('data-ingredient-id', ingredient.id);
    }

    // Wrapper for closeModal function
    modalRestock.wrapCloseModal = function (event) {
        this.source = undefined;

        // Resep input value
        // for (const elem in this.formEl) {
        //     if (elem !== 'measurement_id') this.formEl[elem].value = '';
        //     else this.formEl[elem].selectedIndex = 0;

        //     this.hideError(elem);
        // }

        this.formEl.added.value = 0;

        this.closeModal();
    }

    // Method for validating input
    modalRestock.validate = function (isUpdate = false) {
        let isValid = true;

        // Validasi nama
        let validateName = () => {
            if (this.formEl.name.value === '') {
                this.showError('name', 'Name is required!');
                return false;
            }

            this.hideError('name');
            return true;
        }

        if (!validateName()) isValid = false;

        let validateCapital = () => {
            if (this.formEl.capital_price.value === '') {
                this.showError('capital_price', 'Capital price is required!');
                return false;
            }

            if (isNaN(this.formEl.capital_price.value)) {
                this.showError('capital_price', 'Capital price must be a number!');
                return false;
            }

            this.hideError('capital_price');
            return true;
        }

        if (!validateCapital()) isValid = false;

        let validateMeasure = () => {
            if (this.formEl.measurement_id.selectedIndex === 0) {
                this.showError('measurement_id', 'Please select a measurement.');
                return false;
            }

            this.hideError('measurement_id');
            return true;
        }

        if (!validateMeasure()) isValid = false;

        return isValid;
    }

    // Modal for generating the form data
    modalRestock.getFormData = function () {
        let formData = new FormData();
        formData.append('added', this.formEl.added.value);

        return formData;
    }

    // Method for submitting the form
    modalRestock.submit = function (event) {
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

        disableButton();

        const ingredientId = this.source.getAttribute('data-ingredient-id');

        let url = `${location.origin}/admin/restock/${ingredientId}`;
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': this.csrf,
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: this.getFormData(),
        }).then(response => {
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
                        Alpine.store('modalIngredient').showError(key, data.errors[key][0]);
                        Alpine.store('modalIngredient').formValid[key] = false;
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

    return modalRestock;
}
