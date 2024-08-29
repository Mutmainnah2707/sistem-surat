<?php namespace App\Models;

use CodeIgniter\Model;

class SuratMasukModel extends Model
{
    protected $table = 'surat_masuk';
    protected $primaryKey = 'id_surat';

    protected $allowedFields = [
        'asal_surat',
        'no_surat',
        'perihal',
        'tanggal_surat',
        'tanggal_terima',
        'tujuan_surat',
        'jenis_surat',
        'file_surat',
        'status'  // Pastikan 'status' ada di allowedFields
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getAllSuratMasuk()
    {
        return $this->findAll(); // Mengambil semua data surat masuk
    }
}
