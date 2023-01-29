import Swal from "sweetalert2";
import modalKasir from "./modal-kasir";

function getMenus() {
    let daftarMenuEl = document.getElementById('daftar-menu');

    return JSON.parse(daftarMenuEl.getAttribute('data-menus'));
}

function createMenuItem(data) {
    return {
        data: data,
        quantity: 1,
        increment() {
            this.quantity++;
        },
        decrement() {
            this.quantity--;
        }
    }
}

export default () => ({
    menus: getMenus(),
    selectedMenus: [],
    search: '',
    get filteredMenus() {
        return this.menus.filter(menu => {
            let pattern = `${this.search}.*`;
            let regex = new RegExp(pattern, 'i');
            return menu.menu_name.match(regex);
        });
    },
    selectMenu(event) {
        let source = event.target;

        // Loop and get the parent until button found
        while (true) {
            if (_.lowerCase(source?.nodeName) !== 'button') source = source.parentElement;
            else break;
        };

        let selectedMenu = JSON.parse(source.getAttribute('data-menu'));
        let exist = this.selectedMenus.find((o, i) => {
            // console.log(o);
            return o.data.id == selectedMenu.id
        });

        if (exist) {
            exist.quantity++;
        } else {
            this.selectedMenus.push(createMenuItem(selectedMenu));
        }
    },
    removeMenu(event) {
        let source = event.target;

        // Loop and get the parent until button found
        while (true) {
            if (_.lowerCase(source?.nodeName) !== 'button') source = source.parentElement;
            else break;
        };

        let menuId = +(source.getAttribute('data-menu-id'));

        let menuIdx = this.selectedMenus.findIndex((o) => o.data.id == menuId);
        this.selectedMenus.splice(menuIdx, 1);
    },
    modal: modalKasir(),
    get total() {
        let total = 0;
        for (const selectedMenu of this.selectedMenus) {
            total += selectedMenu.data.selling_price * selectedMenu.quantity;
        }

        return total;
    },
    payment: 0,
    get change() {
        return this.payment - this.total;
    },
    submit() {
        let formData = new FormData();
        formData.append('total', this.total);
        formData.append('payment', this.payment);
        formData.append('change', this.change);

        let menusJson = [];
        for (const menu of this.selectedMenus) {
            let a = {
                data: menu.data,
                quantity: menu.quantity
            };

            menusJson.push(JSON.stringify(a));
        }
        formData.append('menus', JSON.stringify(menusJson));

        let url = `${location.origin}/admin/kasir`;
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: formData,
        }).then((response) => {
            if (response.ok) {
                let result = response.json();
                result.then(data => {
                    // console.log(data)
                    Alpine.store('kasir').modal.closeModal();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message,
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                    }).then(result => {
                        if (result.isDismissed) {
                            location.href = `${location.origin}/admin/transaction/${data.id}`;
                        }
                    });
                });

            } else if (response.status === 422) {
                // console.log(response.status);
                let result = response.json();
                result.then(data => {
                    Swal.fire({
                        icon: 'error',
                        title: `Error: invalid data`,
                        text: 'Mohon berikan data yang valid.'
                    });
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: `Error: ${response.status}`,
                    text: 'Terjadi kesalahan ketika menyimpan data.'
                });
            }
        });
    }
});
