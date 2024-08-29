<?php

namespace App\Models;

use CodeIgniter\Model;

class DisposisiModel extends Model
{
    protected $table = 'disposisi';
    protected $primaryKey = 'id_surat_masuk';
    protected $allowedFields = ['id_surat_masuk', 'tanggal_disposisi', 'disposisi_ke', 'keterangan', 'file_disposisi'];

    protected $useTimestamps = true;
}
