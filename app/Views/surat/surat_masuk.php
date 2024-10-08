<?= $this->extend('dashboard/index') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="page-heading mb-3">
        <h3>Surat Masuk</h3>
    </div>

    <a href="<?= site_url('surat/create_surat_masuk') ?>" class="btn btn-primary mb-3">Tambah Surat Masuk</a>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Surat Masuk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Asal Surat</th>
                            <th>No Surat</th>
                            <th>Perihal</th>
                            <th>Tanggal Surat</th>
                            <th>Tanggal Terima</th>
                            <th>Tujuan Surat</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0 ?>
                        <?php if (!empty($surat_masuk) && is_array($surat_masuk)): ?>
                            <?php foreach ($surat_masuk as $item): ?>
                                <tr>
                                    <td><?= ++$i ?></td>
                                    <td><?= esc($item['asal_surat']) ?></td>
                                    <td><?= esc($item['no_surat']) ?></td>
                                    <td><?= esc($item['perihal']) ?></td>
                                    <td><?= esc($item['tanggal_surat']) ?></td>
                                    <td><?= esc($item['tanggal_terima']) ?></td>
                                    <td><?= esc($item['tujuan_surat']) ?></td>
                                    <td><?= esc($item['status']) ? 'Sudah dibaca' : 'Belum dibaca' ?></td>
                                    <td>
                                        <a href="<?= site_url('surat/show_surat_masuk/' . $item['id_surat']) ?>" class="btn btn-info btn-sm">Show</a>
                                        <a href="<?= site_url('surat/edit_surat_masuk/' . $item['id_surat']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="<?= site_url('admin/disposisi/create/' . $item['id_surat']) ?>" class="btn btn-primary btn-sm">Disposisi</a>
                                        <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete('<?= site_url('surat/delete_surat_masuk/' . $item['id_surat']) ?>')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">No data found</td>
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