import Swal from "sweetalert2";
import modal from "./modal";

export default () => {
    let modalMeasureEl = document.getElementById('modal-measurement');

    let modalMeasureFormEl = {
        long_name: modalMeasureEl.querySelector('input[name="long_name"'),
        short_name: modalMeasureEl.querySelector('input[name="short_name"'),
    };

    // Create the modal
    let modalMeasurement = modal('modal-measurement');

    // CSRF Token
    modalMeasurement.csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Modal activator
    modalMeasurement.source = null;

    // Modal forms element
    modalMeasurement.formEl = modalMeasureFormEl;

    // Modal forms valid status
    modalMeasurement.formValid = {
        long_name: true,
        short_name: true,
    };

    // Method for showing validation error
    modalMeasurement.showError = function (elem, errMsg) {
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
    modalMeasurement.hideError = function (elem) {
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
    modalMeasurement.wrapOpenModal = function (event) {
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
    modalMeasurement.populateForm = function () {
        const measurement = JSON.parse(this.source.getAttribute('data-measurement'));

        for (const elem in measurement) {
            if (typeof this.formEl[elem] === 'undefined') continue;
            this.formEl[elem].value = measurement[elem];
        }

        this.source.setAttribute('data-measurement-id', measurement.id);
    }

    // Wrapper for closeModal function
    modalMeasurement.wrapCloseModal = function (event) {
        this.source = undefined;

        // Resep input value
        for (const elem in this.formEl) {
            this.formEl[elem].value = '';

            this.hideError(elem);
        }

        this.closeModal();
    }

    // Method for validating input
    modalMeasurement.validate = function (isUpdate = false) {
        let isValid = true;

        // Validasi nama
        let validateName = () => {
            if (this.formEl.long_name.value === '') {
                this.showError('long_name', 'Name is required!');
                return false;
            }

            this.hideError('long_name');
            return true;
        }

        if (!validateName()) isValid = false;

        let validateShort = () => {
            if (this.formEl.short_name.value === '') {
                this.showError('short_name', 'Short name is required!');
                return false;
            }

            this.hideError('short_name');
            return true;
        }

        if (!validateShort()) isValid = false;

        return isValid;
    }

    // Modal for generating the form data
    modalMeasurement.getFormData = function () {
        let formData = new FormData();
        formData.append('long_name', this.formEl.long_name.value);
        formData.append('short_name', this.formEl.short_name.value);

        return formData;
    }

    // Method for submitting the form
    modalMeasurement.submit = function (event) {
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

            let url = 'http://localhost:8000/admin/measurement';
            let reqMethod = 'POST';

            if (action === 'new') {
                url = 'http://localhost:8000/admin/measurement';
                reqMethod = 'POST';
            } else {
                const measurementId = this.source.getAttribute('data-measurement-id');
                url = `http://localhost:8000/admin/measurement/${measurementId}`;
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
                                Alpine.store('modalMeasurement').showError(key, data.errors[key][0]);
                                Alpine.store('modalMeasurement').formValid[key] = false;
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

    return modalMeasurement;
}
