<?= $this->extend('dashboard/index') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="page-heading mb-3">
        <h3>Daftar Disposisi</h3>
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


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Disposisi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Surat Masuk</th>
                            <th>Tanggal Disposisi</th>
                            <th>Disposisi Ke</th>
                            <th>Keterangan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0 ?>
                        <?php if (!empty($disposisi) && is_array($disposisi)): ?>
                            <?php foreach ($disposisi as $item): ?>
                                <tr>
                                    <td><?= ++$i ?></td>
                                    <td><?= esc($item['id_surat_masuk']) ?></td>
                                    <td><?= esc($item['tanggal_disposisi']) ?></td>
                                    <td><?= esc($item['disposisi_ke']) ?></td>
                                    <td><?= esc($item['keterangan']) ?></td>
                                    <td>
                                        <a href="<?= site_url('surat/show_surat_masuk/' . $item['id_surat_masuk']) ?>" class="btn btn-info btn-sm">Lihat Surat Masuk</a>
                                        <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete('<?= site_url('admin/disposisi/delete/' . $item['id_surat_masuk']) ?>')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data disposisi ditemukan.</td>
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