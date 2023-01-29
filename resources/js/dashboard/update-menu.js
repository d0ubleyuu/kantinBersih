import { isNull, isUndefined } from "lodash";
import Swal from "sweetalert2";


export default () => ({
    idMenu: null,
    namaMenu: null,
    sellPrice: null,

    inputValid: {
        idMenu: true,
        namaMenu: true,
        sellPrice: true,
    },
    getFormData() {
        this.idMenu = +document.querySelector('input[name="id"]')?.value;
        this.namaMenu = document.querySelector('input[name="menu_name"')?.value;
        this.sellPrice = +document.querySelector('input[name="selling_price"]')?.value;
    },
    generateForm() {
        let formData = new FormData();
        formData.append('menu_name', this.namaMenu);
        formData.append('selling_price', this.sellPrice);

        return formData;
    },
    validate() {
        let valid = true;

        let validateId = () => {
            if (isNull(this.idMenu) || isNaN(this.idMenu) || isUndefined(this.idMenu)) {
                this.inputValid.idMenu = false;
                return false;
            }

            if (this.idMenu === 0) {
                this.inputValid.idMenu = false;
                return false;
            }

            this.inputValid.idMenu = true;
            return true;
        }

        if (!validateId()) valid = false;

        let validateName = () => {
            if (isNull(this.namaMenu) || isUndefined(this.namaMenu)) {
                this.inputValid.namaMenu = false;
                return false;
            }

            if (this.namaMenu === '') {
                this.inputValid.namaMenu = false;
                return false;
            }

            this.inputValid.namaMenu = true;
            return true;
        }

        if (!validateName()) valid = false;

        let validatePrice = () => {
            if (isNull(this.sellPrice) || isNaN(this.sellPrice) || isUndefined(this.sellPrice)) {
                this.inputValid.sellPrice = false;
                return false;
            }

            if (this.sellPrice <= 0) {
                this.inputValid.sellPrice = false;
                return false;
            }

            this.inputValid.sellPrice = true;
            return true;
        }

        if (!validatePrice()) valid = false;

        return valid;
    },
    submit() {
        this.getFormData();

        if (this.validate()) {
            let url = `${location.origin}/admin/menu/${this.idMenu}`;
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: this.generateForm(),
            }).then((response) => {
                if (response.ok) {
                    let result = response.json();
                    result.then(data => {
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
                    Swal.fire({
                        icon: 'error',
                        title: `Input Invalid`,
                        text: 'Mohon masukkan data valid.',
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: `Error: ${response.status}`,
                        text: 'Terjadi kesalahan ketika menyimpan data.'
                    });
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: `Input Invalid`,
                text: 'Mohon masukkan data valid.',
            });
        }
    }
});
