<?php

namespace App\Controllers\Satker;

use App\Controllers\BaseController;
use App\Models\SuratMasukModel;

class SuratMasukSatkerController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new SuratMasukModel();
    }

    public function index()
    {

        $session = session();
        $data['user'] = $session->get('nama');
        $data['level'] = $session->get('level');
        $suratMasukModel = new SuratMasukModel();
        $data['jumlahBelumDibaca'] = $suratMasukModel->where('status', 0)
            ->where('tujuan_surat', 'Satker')
            ->countAllResults();
        $data['surat_masuk'] = $this->model->where('tujuan_surat', 'Satker')->findAll(); // Mengambil data surat yang ditujukan ke Satker
        return view('satker/surat_masuk/index', $data);
    }

    public function suratMasuk()
    {
        $session = session();
        $data['user'] = $session->get('nama');
        $data['level'] = $session->get('level');



        return view('surat_masuk/index', $data);
    }

    public function create()
    {
        $session = session();
        $data['user'] = $session->get('nama');
        $data['level'] = $session->get('level');
        $suratMasukModel = new SuratMasukModel();
        $data['jumlahBelumDibaca'] = $suratMasukModel->where('status', 0)
            ->where('tujuan_surat', 'Satker')
            ->countAllResults();
        return view('satker/surat_masuk/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'asal_surat' => 'required|max_length[255]',
            'no_surat' => 'required|max_length[100]',
            'perihal' => 'required|max_length[255]',
            'tanggal_terima' => 'required|valid_date',
            'tujuan_surat' => 'required|max_length[255]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->model->save([
            'asal_surat' => $this->request->getPost('asal_surat'),
            'no_surat' => $this->request->getPost('no_surat'),
            'perihal' => $this->request->getPost('perihal'),
            'tanggal_terima' => $this->request->getPost('tanggal_terima'),
            'tujuan_surat' => 'Satker' // Set tujuan_surat to 'Satker'
        ]);

        return redirect()->to('/satker/surat_masuk')->with('success', 'Surat Masuk berhasil ditambahkan.');
    }

    public function show($id)
    {

        $session = session();
        $data['user'] = $session->get('nama');
        $data['level'] = $session->get('level');
        $suratMasukModel = new SuratMasukModel();
        $data['jumlahBelumDibaca'] = $suratMasukModel->where('status', 0)
            ->where('tujuan_surat', 'Satker')
            ->countAllResults();
        // Ambil detail surat berdasarkan ID
        $data['surat_masuk'] = $this->model->find($id);

        // Jika surat tidak ditemukan, lemparkan exception
        if (!$data['surat_masuk']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat tidak ditemukan.');
        }

        // Periksa status surat dan update jika perlu
        if ($data['surat_masuk']['status'] == 0) {
            $this->model->update($id, ['status' => 1]);
        }

        $filePath = WRITEPATH . 'uploads/' . $data['surat_masuk']['file_surat'];
        $fileInfo = pathinfo($filePath);
        $data['fileExtension'] = strtolower($fileInfo['extension']);

        // Tampilkan view dengan data surat
        return view('satker/surat_masuk/show', $data);
    }

    public function edit($id)
    {
        $session = session();
        $data['user'] = $session->get('nama');
        $data['level'] = $session->get('level');
        $suratMasukModel = new SuratMasukModel();
        $data['jumlahBelumDibaca'] = $suratMasukModel->where('status', 0)
            ->where('tujuan_surat', 'Satker')
            ->countAllResults();
        $data['surat'] = $this->model->find($id);

        if (!$data['surat']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat tidak ditemukan.');
        }

        return view('satker/surat_masuk/edit', $data);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'asal_surat' => 'required|max_length[255]',
            'no_surat' => 'required|max_length[100]',
            'perihal' => 'required|max_length[255]',
            'tanggal_terima' => 'required|valid_date',
            'tujuan_surat' => 'required|max_length[255]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->model->update($id, [
            'asal_surat' => $this->request->getPost('asal_surat'),
            'no_surat' => $this->request->getPost('no_surat'),
            'perihal' => $this->request->getPost('perihal'),
            'tanggal_terima' => $this->request->getPost('tanggal_terima'),
            'tujuan_surat' => 'Satker' // Set tujuan_surat to 'Satker'
        ]);

        return redirect()->to('/satker/surat_masuk')->with('success', 'Surat Masuk berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/satker/surat_masuk')->with('success', 'Surat Masuk berhasil dihapus.');
    }
}
