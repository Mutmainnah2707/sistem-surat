<!-- JQuery -->
<script src="<?= base_url('assetAdmin/vendor/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap JS -->
<script src="<?= base_url('assetAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- Plugin -->
<script src="<?= base_url('assetAdmin/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
<!-- JavaScript template SB Admin 2 (Bootstrap 4)   -->
<script src="<?= base_url('assetAdmin/js/sb-admin-2.min.js') ?>"></script>
<!-- Bootstrap Select -->
<script src="<?= base_url('assetAdmin/vendor/bootstrap-select-1.13.14/js/bootstrap-select.min.js') ?>"></script>

<!-- Sweetalert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Datatables -->
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
<!-- Datatables Buttons -->
<script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.print.min.js"></script>

<script>
    // DOM untuk pemberitahuan info, sukses dan gagal (Sweetalert2)
    document.addEventListener('DOMContentLoaded', (event) => {
        <?php if (session()->getFlashdata('info')): ?>
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: '<?= session()->getFlashdata('info') ?>',
            });
        <?php elseif (session()->getFlashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: '<?= session()->getFlashdata('success') ?>',
            });
        <?php elseif (session()->getFlashdata('error')): ?>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "<?= session()->getFlashdata('error') ?>"
            });
        <?php endif; ?>
    });

    // Sweetalert2 untuk konfirmasi penghapusan data
    function confirmDelete(deleteUrl) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = deleteUrl;
            }
        })
    }

    // Ajax untuk menampilkan notifikasi pesan yang masuk
    $(document).ready(function() {
        $.ajax({
            url: "<?= site_url('notification') ?>",
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {

                    let incomingLetter = response.data.incomingLetter

                    for (let i = 0; i < incomingLetter.length; i++) {
                        console.log('Perhal: ' + incomingLetter[i].subject);
                        console.log('Pengirim: ' + incomingLetter[i].sender);
                        console.log('Dikirim: ' + incomingLetter[i].receive);
                    }

                } else {

                    console.log(response.message);

                }
            },
            error: function(xhr, status, error) {
                console.log("Error: " + error);
            }
        });
    });

    // Function untuk menampilkan nama file di halaman create dan edit
    function letterFileLable() {
        const letterFile = document.querySelector('#letter_file');
        const letterFileLable = document.querySelector('.custom-file-label');
        letterFileLable.textContent = letterFile.files[0].name;
    }

    // Datatables
    $('#dataTable').DataTable({
        scrollX: true,
        // buttons: [
        //     'copy', 'excel', 'pdf'
        // ],
        // layout: {
        //     topStart: 'buttons'
        // }
    });
</script>