import Swal from "sweetalert2";

function delBahanMenu(idMenu, idBahan) {
    let url = `${location.origin}/admin/menu/${idMenu}/ingredient/${idBahan}`;
    // console.log(url);

    fetch(url, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest',
        },
    }).then((result) => {
        if (result.ok) {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Berhasil menghapus bahan pada menu.',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
            }).then(result => {
                location.reload();
            });
        } else if (result.status === 403) {
            result.json().then((data) => {
                Swal.fire({
                    icon: 'error',
                    title: `Error: Forbidden`,
                    text: data.message,
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                });
            });
        } else {
            result.json().then((data) => {
                Swal.fire({
                    icon: 'error',
                    title: `Error: ${data.status}`,
                    text: data.message,
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                });
            });
        }
    });
}

export default (event) => {
    let source = event.target;

    // Loop and get the parent until button found
    while (true) {
        if (_.lowerCase(source?.nodeName) !== 'button') source = source.parentElement;
        else break;
    }

    Swal.fire({
        icon: 'warning',
        title: 'Konfirmasi',
        text: 'Apakah anda yakin ingin menghapus bahan ini?',
        showCancelButton: true,
    })
        .then((result) => {
            if (result.isConfirmed) {
                let menuId = location.pathname.replace(/\/+$/, '').split('/')[3];
                delBahanMenu(menuId, source.getAttribute('data-bahan-menu-id'));
            }
        });
}
