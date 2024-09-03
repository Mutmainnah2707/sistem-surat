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
        $session = session();
        $data['user'] = $session->get('nama');
        $data['level'] = $session->get('level');
        $suratMasukModel = new SuratMasukModel();
        $data['jumlahBelumDibaca'] = $suratMasukModel->where('status', 0)
                                                     ->countAllResults();
        $data['disposisi'] = $this->disposisiModel->findAll();
        return view('disposisi/index', $data);
    }

    public function create($id)
    {
        $session = session();
        $data['user'] = $session->get('nama');
        $data['level'] = $session->get('level');
    
        // Model SuratMasuk digunakan untuk mendapatkan data surat masuk
        $suratMasukModel = new \App\Models\SuratMasukModel();
    
        // Hitung jumlah surat masuk yang belum dibaca
        $data['jumlahBelumDibaca'] = $suratMasukModel->where('status', 0)->countAllResults();
    
        // Ambil semua data surat masuk
        $data['suratMasuk'] = $suratMasukModel->find($id);
    
        // Kirim data ke view 'disposisi/create'
        return view('disposisi/create', $data);
    }
    


    public function store($id)
    {
        $file_surat = $this->request->getFile('file_surat');

        // Validasi file upload
        if ($file_surat->isValid() && !$file_surat->hasMoved()) {
            // Tentukan path dan nama file
            $path = WRITEPATH . 'uploads/';
            $file_name = $file_surat->getRandomName();

            // Pindahkan file ke path yang diinginkan
            $file_surat->move($path, $file_name);

            // Simpan data disposisi
            $data_disposisi = [
                'id_surat_masuk'   => $id,
                'tanggal_disposisi' => $this->request->getVar('tanggal_disposisi'),
                'disposisi_ke'     => $this->request->getVar('disposisi_ke'),
                'keterangan'       => $this->request->getVar('keterangan'),
                'file_disposisi'   => $file_name,
            ];

            $db = \Config\Database::connect();
            $builder_disposisi = $db->table('disposisi');
            $builder_disposisi->insert($data_disposisi);

            // Check if insert is successful
            if ($db->affectedRows() > 0) {
                // Update tabel surat_masuk dengan nama file dan tujuan disposisi
                $suratMasukModel = new \App\Models\SuratMasukModel();
                $updateData = [
                    'file_surat'   => $file_name, // Update nama file
                    'tujuan_surat' => $data_disposisi['disposisi_ke'] // Update tujuan disposisi
                ];
                if (!$suratMasukModel->update($data_disposisi['id_surat_masuk'], $updateData)) {
                    log_message('error', 'Failed to update surat_masuk.');
                    return redirect()->back()->with('error', 'Gagal memperbarui surat masuk.');
                }

                return redirect()->to('admin/disposisi')->with('success', 'Disposisi berhasil ditambahkan');
            } else {
                log_message('error', 'Failed to insert into disposisi.');
                return redirect()->back()->with('error', 'Gagal menambahkan disposisi');
            }
        } else {
            log_message('error', 'File upload failed or file already moved.');
            return redirect()->back()->with('error', 'Gagal meng-upload file.');
        }
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
