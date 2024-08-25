<?php namespace App\Models;

use CodeIgniter\Model;

class SuratKeluarModel extends Model
{
    protected $table = 'surat_keluar';
    protected $primaryKey = 'id_surat';

    protected $allowedFields = [
        'asal_surat', 
        'no_surat', 
        'perihal', 
        'tanggal_terima', 
        'tujuan_surat', 
        'jenis_surat', 
        'file_surat', 
        'id_surat_masuk', 
        'is_draft'
    ];
    
    protected $useTimestamps = false;

    public function getAllSuratKeluar()
    {
        return $this->findAll();
    }

    public function getSuratKeluarWithStatus()
    {
        return $this->select('surat_keluar.*, surat_masuk.status')
                    ->join('surat_masuk', 'surat_keluar.no_surat = surat_masuk.no_surat', 'left')
                    ->where('surat_keluar.tujuan_surat', 'Satker')
                    ->findAll();
    }
}
