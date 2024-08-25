<?php

namespace App\Controllers;

use App\Models\DisposisiModel;
use App\Models\SuratMasukModel;

class DisposisiController extends BaseController
{
    protected $disposisiModel;
    
    public function __construct()
    {
        $this->disposisiModel = new DisposisiModel();
    }

    public function index()
    {
        $data['disposisi'] = $this->disposisiModel->findAll();
        return view('disposisi/index', $data);
    }

    public function create()
{
    $suratMasukModel = new \App\Models\SuratMasukModel();
    $suratMasukList = $suratMasukModel->findAll(); // Ambil semua surat masuk

    return view('disposisi/create', ['suratMasukList' => $suratMasukList]);
}


public function store()
{
    $data = [
        'id_surat_masuk'   => $this->request->getVar('id_surat_masuk'),
        'tanggal_disposisi' => $this->request->getVar('tanggal_disposisi'),
        'disposisi_ke'     => $this->request->getVar('disposisi_ke'),
        'keterangan'       => $this->request->getVar('keterangan')
    ];

    $db = \Config\Database::connect();
    $builder = $db->table('disposisi');
    $builder->insert($data);

    // Check if insert is successful
    if ($db->affectedRows() > 0) {
        // Update tabel surat_masuk
        $suratMasukModel = new \App\Models\SuratMasukModel();
        $suratMasukModel->update($data['id_surat_masuk'], [
            'tujuan_surat' => $data['disposisi_ke']
        ]);

        return redirect()->to('admin/disposisi')->with('success', 'Disposisi berhasil ditambahkan');
    } else {
        log_message('error', 'Failed to insert into disposisi.');
        return redirect()->back()->with('error', 'Gagal menambahkan disposisi');
    }
}




    public function edit($id_surat_masuk)
    {
        $data['disposisi'] = $this->disposisiModel->find($id_surat_masuk);
        return view('disposisi/edit', $data);
    }

    public function update($id_surat_masuk)
    {
        $this->disposisiModel->save([
            'id_surat_masuk'   => $id_surat_masuk,
            'tanggal_disposisi' => $this->request->getVar('tanggal_disposisi'),
            'disposisi_ke'     => $this->request->getVar('disposisi_ke'),
            'keterangan'       => $this->request->getVar('keterangan')
        ]);

        return redirect()->to('admin/disposisi')->with('success', 'Disposisi berhasil diupdate');
    }

    public function delete($id_surat_masuk)
    {
        $this->disposisiModel->delete($id_surat_masuk);
        return redirect()->to('admin/disposisi')->with('success', 'Disposisi berhasil dihapus');
    }
}
