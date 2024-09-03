<?php

namespace App\Controllers\Satker;

use App\Controllers\BaseController;
use App\Models\SuratMasukModel;
use App\Models\SuratKeluarModel;

class SuratKeluarSatkerController extends BaseController
{
    protected $suratMasukModel;
    protected $suratKeluarModel;

    public function __construct()
    {
        $this->suratMasukModel = new SuratMasukModel();
        $this->suratKeluarModel = new SuratKeluarModel();
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
        $suratKeluarModel = new SuratKeluarModel();
        $data['surat_keluar'] = $suratKeluarModel->getSuratKeluarWithStatus();
        return view('satker/surat_keluar/index', $data);
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

        $data['surat_keluar'] = $this->suratKeluarModel->find($id);
        $data['surat_masuk'] = $this->suratMasukModel->findAll();
        if (!$data['surat_keluar']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Surat Keluar tidak ditemukan');
        }
        return view('satker/surat_keluar/edit', $data);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'asal_surat' => 'required|max_length[255]',
            'perihal' => 'required|max_length[255]',
            'tanggal_terima' => 'required|valid_date',
            'jenis_surat' => 'required|max_length[255]',
            'file_surat' => 'max_size[file_surat,2048]|ext_in[file_surat,pdf,doc,docx]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Handle file upload
        $file = $this->request->getFile('file_surat');
        $fileName = $this->request->getPost('current_file_surat');
        if ($file->isValid() && !$file->hasMoved()) {
            // Remove old file
            if ($fileName && file_exists(WRITEPATH . 'uploads/' . $fileName)) {
                unlink(WRITEPATH . 'uploads/' . $fileName);
            }
            $fileName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $fileName);
        }

        // Update surat_keluar
        $suratKeluarData = [
            'asal_surat' => $this->request->getPost('asal_surat'),
            'no_surat' => $this->request->getPost('no_surat'),
            'perihal' => $this->request->getPost('perihal'),
            'tanggal_terima' => $this->request->getPost('tanggal_terima'),
            'tujuan_surat' => $this->request->getPost('tujuan_surat'),
            'jenis_surat' => $this->request->getPost('jenis_surat'),
            'file_surat' => $fileName,
            'id_surat_masuk' => $this->request->getPost('id_surat_masuk'),
            'is_draft' => $this->request->getPost('is_draft')
        ];

        if ($this->suratKeluarModel->update($id, $suratKeluarData)) {
            // If not a draft, update surat_masuk table as well
            if (!$this->request->getPost('is_draft')) {
                $suratMasukModel = new SuratMasukModel();
                $suratMasukData = [
                    'asal_surat' => $this->request->getPost('asal_surat'),
                    'no_surat' => $this->generateNoSurat(), // Optional: Update surat masuk nomor surat if needed
                    'jenis_surat' => $this->request->getPost('jenis_surat'),
                    'perihal' => $this->request->getPost('perihal'),
                    'tanggal_terima' => $this->request->getPost('tanggal_terima'),
                    'file_surat' => $fileName,
                    'tujuan_surat' => $this->request->getPost('tujuan_surat')
                ];

                // Check if surat masuk exists and update it
                $existingSuratKeluar = $this->suratKeluarModel->find($id);
                $id_surat_masuk = $existingSuratKeluar['id_surat_masuk'] ?? null;

                if ($id_surat_masuk) {
                    $suratMasukModel->update($id_surat_masuk, $suratMasukData);
                } else {
                    // Insert new surat masuk if it doesn't exist
                    $suratMasukModel->save($suratMasukData);
                }
            }

            return redirect()->to('/satker/surat_keluar')->with('success', 'Data berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui data surat keluar.');
        }
    }


    // Tampilkan form untuk menambahkan surat keluar baru
    public function createSuratKeluar()
    {
        $session = session();
        $data['user'] = $session->get('nama');
        $data['level'] = $session->get('level');
        $suratMasukModel = new SuratMasukModel();
        $data['jumlahBelumDibaca'] = $suratMasukModel->where('status', 0)
            ->where('tujuan_surat', 'Satker')
            ->countAllResults();
        $data['surat_masuk'] = $this->suratMasukModel->findAll();
        return view('satker/surat_keluar/create', $data);
    }

    // Simpan surat keluar baru
    public function storeSuratKeluar()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'asal_surat' => 'required|max_length[255]',
            'perihal' => 'required|max_length[255]',
            'tanggal_terima' => 'required|valid_date',
            'tujuan_surat' => 'required|max_length[255]',
            'jenis_surat' => 'required|max_length[255]',
            'file_surat' => 'uploaded[file_surat]|max_size[file_surat,2048]|ext_in[file_surat,pdf,doc,docx]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Generate nomor surat
        $noSurat = $this->generateNoSurat();

        // Handle file upload
        $file = $this->request->getFile('file_surat');
        $fileName = null;
        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $fileName);
        }

        // Tentukan apakah surat disimpan sebagai draft atau final
        $isDraft = $this->request->getPost('is_draft') ? 1 : 0;

        // Jika bukan draft, simpan data ke tabel surat_masuk
        $id_surat_masuk = null;
        if (!$isDraft) {
            $suratMasukModel = new SuratMasukModel();
            $suratMasukData = [
                'asal_surat' => $this->request->getPost('asal_surat'),
                'no_surat' => $noSurat,
                'jenis_surat' => $this->request->getPost('jenis_surat'),
                'perihal' => $this->request->getPost('perihal'),
                'tanggal_terima' => $this->request->getPost('tanggal_terima'),
                'file_surat' => $fileName,
                'tujuan_surat' => 'Satker',
            ];

            if (!$suratMasukModel->save($suratMasukData)) {
                return redirect()->back()->with('error', 'Gagal menyimpan data ke surat_masuk.');
            }

            // Dapatkan ID dari surat_masuk yang baru disimpan
            $id_surat_masuk = $suratMasukModel->getInsertID();
        }

        // Simpan data ke tabel surat_keluar
        $suratKeluarModel = new SuratKeluarModel();
        $suratKeluarData = [
            'asal_surat' => $this->request->getPost('asal_surat'),
            'no_surat' => $noSurat,
            'perihal' => $this->request->getPost('perihal'),
            'tanggal_terima' => $this->request->getPost('tanggal_terima'),
            'tujuan_surat' => $this->request->getPost('tujuan_surat'),
            'jenis_surat' => $this->request->getPost('jenis_surat'),
            'file_surat' => $fileName,
            'id_surat_masuk' => $id_surat_masuk,
            'is_draft' => $isDraft
        ];

        if ($suratKeluarModel->save($suratKeluarData)) {
            return redirect()->to('/satker/surat_keluar')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data ke surat_keluar.');
        }
    }


    // Generate nomor surat
    private function generateNoSurat()
    {
        $tahun = date('Y'); // Contoh format tahun
        $bulan = date('m'); // Contoh format bulan

        // Ambil nomor urut terakhir
        $lastNoSurat = $this->suratMasukModel->orderBy('id_surat', 'DESC')->first();

        // Generate nomor urut baru
        $nomorUrut = 1;
        if ($lastNoSurat) {
            // Ambil nomor urut dari no_surat yang terakhir
            preg_match('/(\d+)/', $lastNoSurat['no_surat'], $matches);
            $nomorUrut = $matches[0] + 1;
        }

        // Format nomor surat
        $noSurat = sprintf('%s/%03d/%s/%s', 'VI', $nomorUrut, 'A', 'VIII');
        return $noSurat;
    }

    public function delete($id)
    {
        $suratKeluar = $this->suratKeluarModel->find($id);
        if (!$suratKeluar) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Surat Keluar tidak ditemukan');
        }

        // Hapus file jika ada
        if ($suratKeluar['file_surat'] && file_exists(WRITEPATH . 'uploads/' . $suratKeluar['file_surat'])) {
            unlink(WRITEPATH . 'uploads/' . $suratKeluar['file_surat']);
        }

        if ($this->suratKeluarModel->delete($id)) {
            return redirect()->to('/satker/surat_keluar')->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data surat keluar.');
        }
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

        $data['surat_keluar'] = $this->suratKeluarModel->find($id);

        if (!$data['surat_keluar']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Surat Keluar tidak ditemukan');
        }

        $filePath = WRITEPATH . 'uploads/' . $data['surat_keluar']['file_surat'];
        $fileInfo = pathinfo($filePath);
        $data['fileExtension'] = strtolower($fileInfo['extension']);

        return view('satker/surat_keluar/show', $data);
    }
}
