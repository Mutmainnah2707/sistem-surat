<?= $this->extend('dashboard/index') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="page-heading mb-3">
        <h3>Daftar Pengurus Pondok</h3>
    </div>
    
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>
    <?php endif; ?>

    <a href="<?= site_url('admin/tambah-pengurus') ?>" class="btn btn-primary mb-3">Tambah Pengurus</a>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pengurus Pondok</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0 ?>
                        <?php if (!empty($pengurus) && is_array($pengurus)): ?>
                            <?php foreach ($pengurus as $item): ?>
                            <tr>
                                <td><?= ++$i ?></td>
                                <td><?= esc($item['nama']) ?></td>
                                <td><?= esc($item['email']) ?></td>
                                <td><?= esc($item['level']) ?></td>
                                <td>
                                    <a href="<?= site_url('admin/edit-pengurus/' . $item['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete('<?= site_url('admin/delete-pengurus/' . $item['id']) ?>')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data pengurus ditemukan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
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

    document.addEventListener('DOMContentLoaded', (event) => {
        <?php if (session()->getFlashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: '<?= session()->getFlashdata('success') ?>',
            });
        <?php endif; ?>
    });
</script>

<?= $this->endSection() ?>
