// import { lowerCase } from 'lodash';
import Swal from 'sweetalert2';
import modal from './modal';

export default () => {
    // Store modal object for employee
    let modalEmpEl = document.getElementById('modal-employee');
    let modalEmpFormEl = {
        name: modalEmpEl.querySelector('input[name="name"]'),
        username: modalEmpEl.querySelector('input[name="username"]'),
        password: modalEmpEl.querySelector('input[name="password"]'),
        passwordConfirm: modalEmpEl.querySelector('input[name="password_confirmation"]'),
        role: modalEmpEl.querySelector('select[name="role"]'),
    };

    let modalEmployee = modal('modal-employee');

    modalEmployee.formEl = modalEmpFormEl;

    modalEmployee.formValid = {
        name: true,
        username: true,
        password: true,
        passwordConfirm: true,
        role: true,
    };

    // Util function for showing or hiding error and validation message
    modalEmployee.showError = function (elem, errMsg) {
        this.formEl[elem].classList.remove(
            'focus:border-yellow-400',
            'focus:ring-yellow-200'
        );
        this.formEl[elem].classList.add(
            'border-red-400',
            'focus:border-red-400',
            'focus:ring-red-200'
        );
        this.formEl[elem].nextElementSibling.innerText = errMsg;
        this.formValid[elem] = false;
    }

    modalEmployee.hideError = function (elem) {
        this.formEl[elem].classList.remove(
            'border-red-400',
            'focus:border-red-400',
            'focus:ring-red-200'
        );
        this.formEl[elem].classList.add(
            'focus:border-yellow-400',
            'focus:ring-yellow-200'
        );
        this.formEl[elem].nextElementSibling.innerText = '';
        this.formValid[elem] = false;
    }

    modalEmployee.getFormData = function () {
        let formData = new FormData();
        formData.append('name', this.formEl.name.value);
        formData.append('username', this.formEl.username.value);
        formData.append('password', this.formEl.password.value);
        formData.append('password_confirmation', this.formEl.passwordConfirm.value);
        formData.append('role', this.formEl.role.value);

        return formData;
    }

    // CSRF Token
    modalEmployee.csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    modalEmployee.source = null; // Modal activator

    // method to make sure the modal source is a button
    modalEmployee.wrapOpenModal = function (event) {
        this.source = event.target;

        // Loop and get the parent until button found
        while (true) {
            if (_.lowerCase(this.source?.nodeName) !== 'button') this.source = this.source.parentElement;
            else break;
        }

        // TODO: populate form when edit button clicked
        if (this.source.getAttribute('data-action') === 'update') this.populateForm();

        this.openModal();
    }

    modalEmployee.populateForm = function () {
        const employee = JSON.parse(this.source.getAttribute('data-employee'));
        // console.log(employee);

        for (const elem in employee) {
            if (typeof this.formEl[elem] === 'undefined') continue;
            if (elem !== 'role') {
                this.formEl[elem].value = employee[elem];
            } else {
                this.formEl[elem].value = _.upperFirst(employee[elem]);
            }
        }

        this.source.setAttribute('data-employee-id', employee.id);
    }

    modalEmployee.wrapCloseModal = function (event) {
        this.source = undefined;

        // Resep input value
        for (const elem in this.formEl) {
            if (elem !== 'role') this.formEl[elem].value = '';
            else this.formEl[elem].selectedIndex = 0;

            this.hideError(elem);
        }

        this.closeModal();
    }

    modalEmployee.validate = function (isUpdate = false) {
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

        let validateUsername = () => {
            if (this.formEl.username.value === '') {
                this.showError('username', 'Username is required!');
                return false;
            }

            this.hideError('username');
            return true;
        }

        if (!validateUsername()) isValid = false;

        let validatePassword = () => {
            if (this.formEl.password.value === '' && !isUpdate) {
                this.showError('password', 'Password is required!');
                return false;
            }

            if (this.formEl.password.value.length > 0 && this.formEl.password.value.length < 8) {
                this.showError('password', 'The Password must be at least 8 characters.');
                return false;
            }

            this.hideError('password');
            return true;
        }

        if (!validatePassword()) isValid = false;

        let validatePasswordConfirm = () => {
            if (this.formEl.passwordConfirm.value === '') {
                this.showError('passwordConfirm', 'Password confirmation is required!');
                return false;
            }

            if (this.formEl.passwordConfirm.value !== this.formEl.password.value) {
                this.showError('passwordConfirm', 'The Password confirmation does not match.');
                return false;
            }

            this.hideError('passwordConfirm');
            return true;
        }

        if (this.formEl.password.value.length > 0) {
            if (!validatePasswordConfirm()) isValid = false;
        }

        let validateRole = () => {
            if (!['Admin', 'Staff'].includes(this.formEl.role.value)) {
                this.showError('role', 'The selected Role is invalid.');
                return false;
            }

            this.hideError('role');
            return true;
        }

        if (!validateRole()) isValid = false;

        return isValid;
    }

    modalEmployee.submit = function (event) {
        let button = event.target;

        let disableButton = () => {
            // Add the disabled attribut
            button.setAttribute('disabled', '');
            // Remove and add class
            button.classList.remove(
                'active:bg-yellow-500',
                'hover:bg-yellow-400'
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
                'active:bg-yellow-500',
                'hover:bg-yellow-400'
            );
        };

        if (this.validate(this.source.getAttribute('data-action') === 'update')) {
            disableButton();
            let action = this.source.getAttribute('data-action');

            let url = 'http://localhost:8000/admin/employee';
            let reqMethod = 'POST';

            if (action === 'new') {
                url = 'http://localhost:8000/admin/employee';
                reqMethod = 'POST';
            } else {
                const employeeId = this.source.getAttribute('data-employee-id');
                url = `http://localhost:8000/admin/employee/${employeeId}`;
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
                            // console.log(data);
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
                                Alpine.store('modalEmployee').showError(key, data.errors[key][0]);
                                Alpine.store('modalEmployee').formValid[key] = false;
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
            // console.log(modalEmployee.formValid);
        }
    }

    return modalEmployee;
}
