<?php

namespace App\Controllers\Pengurus;

use App\Controllers\BaseController;
use App\Models\SuratMasukModel;

class SuratMasukPengurusController extends BaseController
{
    public function index()
    {
        $model = new SuratMasukModel();

        // Mendapatkan data sesi pengguna
        $session = session();
        $data['user'] = $session->get('nama');
        $data['level'] = $session->get('level');

        // Menghitung jumlah surat masuk yang belum dibaca
        $data['jumlahBelumDibaca'] = $model->where('status', 0)
                                           ->where('tujuan_surat', 'Pimpinan Pondok')
                                           ->countAllResults();

        // Mengambil semua surat masuk untuk Pimpinan Pondok
        $data['surat_masuk'] = $model->where('tujuan_surat', 'Pimpinan Pondok')->findAll();

        return view('pengurus/surat_masuk/index', $data);
    }

    public function show($id)
    {
        $model = new SuratMasukModel();
        $session = session();
        $data['user'] = $session->get('nama');
        $data['level'] = $session->get('level');

        // Menghitung jumlah surat masuk yang belum dibaca
        $data['jumlahBelumDibaca'] = $model->where('status', 0)
                                           ->where('tujuan_surat', 'Pimpinan Pondok')
                                           ->countAllResults();
        
        
    
        // Ambil detail surat berdasarkan ID
        $data['surat'] = $model->find($id);
    
        // Jika surat tidak ditemukan, lemparkan exception
        if (!$data['surat']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat tidak ditemukan.');
        }
    
        // Periksa status surat dan update jika perlu
        if ($data['surat']['status'] == 0) {
            $model->update($id, ['status' => 1]);
        }
    
        // Tampilkan view dengan data surat
        return view('pengurus/surat_masuk/show', $data);
    }
    

    
}
