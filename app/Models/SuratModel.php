<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratModel extends Model
{
    protected $table = 'surat';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nomor_surat', 'tanggal_surat', 'jenis_surat', 'status', 'keterangan'];

    public function getSuratMasuk()
    {
        return $this->where('jenis_surat', 'Masuk')->findAll();
    }

    public function getSuratKeluar()
    {
        return $this->where('jenis_surat', 'Keluar')->findAll();
    }
}
