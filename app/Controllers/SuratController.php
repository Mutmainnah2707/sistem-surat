<?php namespace App\Controllers;

use App\Models\SuratMasukModel;
use App\Models\SuratKeluarModel;

class SuratController extends BaseController
{
    protected $suratMasukModel;
    protected $suratKeluarModel;

    public function __construct()
    {
        $this->suratMasukModel = new SuratMasukModel();
        $this->suratKeluarModel = new SuratKeluarModel();
    }

    // Dashboard
    public function dashboard()
    {
        return view('dashboard');
    }

    // Surat Masuk
    public function suratMasuk()
    {
        $data['surat_masuk'] = $this->suratMasukModel->findAll();
        return view('surat/surat_masuk', $data);
    }

    public function createSuratMasuk()
    {
        return view('surat/create_surat_masuk');
    }

    public function storeSuratMasuk()
{
    $validation = \Config\Services::validation();

    $validation->setRules([
        'asal_surat' => 'required|max_length[255]',
        'no_surat' => 'required|max_length[255]', // Jika nomor surat tidak otomatis
        'perihal' => 'required|max_length[255]',
        'tanggal_terima' => 'required|valid_date',
        'tujuan_surat' => 'required|max_length[255]',
        'file_surat' => 'uploaded[file_surat]|max_size[file_surat,2048]|ext_in[file_surat,pdf,doc,docx]',
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    // Handle file upload
    $file = $this->request->getFile('file_surat');
    $fileName = null;
    if ($file->isValid() && !$file->hasMoved()) {
        $fileName = $file->getRandomName();
        $file->move(WRITEPATH . 'uploads', $fileName);
    }

    // Save to surat_masuk
    $suratMasukModel = new SuratMasukModel();
    $suratMasukData = [
        'asal_surat' => $this->request->getPost('asal_surat'),
        'no_surat' => $this->request->getPost('no_surat'), // Pastikan data ini sesuai
        'perihal' => $this->request->getPost('perihal'),
        'tanggal_terima' => $this->request->getPost('tanggal_terima'),
        'tujuan_surat' => $this->request->getPost('tujuan_surat'),
        'file_surat' => $fileName
    ];

    if (!$suratMasukModel->save($suratMasukData)) {
        return redirect()->back()->with('error', 'Gagal menyimpan data ke surat_masuk.');
    }

    // Optionally, perform additional actions if needed
    // e.g., Logging or related data handling

    return redirect()->to('/surat/surat_masuk')->with('success', 'Data surat masuk berhasil disimpan.');
}




    // Surat Keluar
    public function suratKeluar()
    {
        $data['surat_keluar'] = $this->suratKeluarModel->findAll();
        return view('surat/surat_keluar', $data);
    }

    public function createSuratKeluar()
    {
        $data['surat_masuk'] = $this->suratMasukModel->findAll();
        return view('surat/create_surat_keluar', $data);
    }

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
        return redirect()->to('/surat/surat_keluar')->with('success', 'Data berhasil disimpan.');
    } else {
        return redirect()->back()->with('error', 'Gagal menyimpan data ke surat_keluar.');
    }
}


// Surat Keluar
public function editSuratKeluar($id_surat_keluar)
{
    $data['surat_keluar'] = $this->suratKeluarModel->find($id_surat_keluar);
    if (!$data['surat_keluar']) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Surat Keluar tidak ditemukan');
    }
    return view('surat/edit_surat_keluar', $data);
}

public function updateSuratKeluar($id_surat_keluar)
{
    $validation = \Config\Services::validation();

    $validation->setRules([
        'asal_surat' => 'required|max_length[255]',
        'perihal' => 'required|max_length[255]',
        'tanggal_terima' => 'required|valid_date',
        'tujuan_surat' => 'required|max_length[255]',
        'jenis_surat' => 'required|max_length[255]',
        'file_surat' => 'if_exist|uploaded[file_surat]|max_size[file_surat,2048]|ext_in[file_surat,pdf,doc,docx]',
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    // Handle file upload
    $file = $this->request->getFile('file_surat');
    $fileName = $this->request->getPost('current_file_surat'); // Use existing file name by default

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $fileName = $file->getRandomName();
        $file->move(WRITEPATH . 'uploads', $fileName);
    }

    // Determine if the letter is a draft
    $isDraft = $this->request->getPost('is_draft') ? 1 : 0;

    // Update surat_keluar data
    $suratKeluarData = [
        'asal_surat' => $this->request->getPost('asal_surat'),
        'perihal' => $this->request->getPost('perihal'),
        'tanggal_terima' => $this->request->getPost('tanggal_terima'),
        'tujuan_surat' => $this->request->getPost('tujuan_surat'),
        'jenis_surat' => $this->request->getPost('jenis_surat'),
        'file_surat' => $fileName,
        'is_draft' => $isDraft
    ];

    if ($this->suratKeluarModel->update($id_surat_keluar, $suratKeluarData)) {
        // If not a draft, update surat_masuk table as well
        if (!$isDraft) {
            $suratMasukModel = new SuratMasukModel();
            $suratMasukData = [
                'asal_surat' => $this->request->getPost('asal_surat'),
                'no_surat' => $this->generateNoSurat(), // Optional: Update surat masuk nomor surat if needed
                'jenis_surat' => $this->request->getPost('jenis_surat'),
                'perihal' => $this->request->getPost('perihal'),
                'tanggal_terima' => $this->request->getPost('tanggal_terima'),
                'file_surat' => $fileName,
                'tujuan_surat' => 'Satker'
            ];

            // Check if surat masuk exists and update it
            $existingSuratKeluar = $this->suratKeluarModel->find($id_surat_keluar);
            $id_surat_masuk = $existingSuratKeluar['id_surat_masuk'] ?? null;

            if ($id_surat_masuk) {
                $suratMasukModel->update($id_surat_masuk, $suratMasukData);
            } else {
                // Insert new surat masuk if it doesn't exist
                $suratMasukModel->save($suratMasukData);
            }
        }

        return redirect()->to('/surat/surat_keluar')->with('success', 'Data surat keluar berhasil diperbarui.');
    } else {
        return redirect()->back()->with('error', 'Gagal memperbarui data surat keluar.');
    }
}




    private function generateNoSurat()
    {
        $tahun = date('Y'); 
        $bulan = date('m'); 

        $suratMasukModel = new SuratMasukModel();
        $lastNoSurat = $suratMasukModel->orderBy('id_surat', 'DESC')->first();

        
        $nomorUrut = 1;
        if ($lastNoSurat) {
            preg_match('/(\d+)/', $lastNoSurat['no_surat'], $matches);
            $nomorUrut = $matches[0] + 1;
        }

        $noSurat = sprintf('%s/%03d/%s/%s', 'VI', $nomorUrut, 'A', 'VIII');
        return $noSurat;
    }
    
    public function download($fileName)
    {
        $filePath = WRITEPATH . 'uploads/' . $fileName; 
        
        if (file_exists($filePath)) {
            return $this->response->download($filePath, null);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('File not found');
        }
    }
    

    public function showSuratMasuk($id_surat_masuk)
    {
        $data['surat_masuk'] = $this->suratMasukModel->find($id_surat_masuk);

        if (!$data['surat_masuk']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Surat Masuk tidak ditemukan');
        }

        return view('surat/show_surat_masuk', $data);
    }

public function showSuratKeluar($id_surat_keluar)
{
    $data['surat_keluar'] = $this->suratKeluarModel->find($id_surat_keluar);

    if (!$data['surat_keluar']) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Surat Keluar tidak ditemukan');
    }

    return view('surat/show_surat_keluar', $data);
}

    public function profile()
    {
        return view('profile');
    }

    public function deleteSuratKeluar($id_surat_keluar)
    {
        $suratKeluar = $this->suratKeluarModel->find($id_surat_keluar);

        if (!$suratKeluar) {
            return redirect()->back()->with('error', 'Surat Keluar tidak ditemukan.');
        }

        // Hapus file terkait jika ada
        if ($suratKeluar['file_surat'] && file_exists(WRITEPATH . 'uploads/' . $suratKeluar['file_surat'])) {
            unlink(WRITEPATH . 'uploads/' . $suratKeluar['file_surat']);
        }

        if ($this->suratKeluarModel->delete($id_surat_keluar)) {
            return redirect()->to('/surat/surat_keluar')->with('success', 'Surat keluar berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus surat keluar.');
        }
    }

    public function deleteSuratMasuk($id_surat_masuk)
    {
        $suratMasuk = $this->suratMasukModel->find($id_surat_masuk);

        if (!$suratMasuk) {
            return redirect()->back()->with('error', 'Surat Masuk tidak ditemukan.');
        }

        // Hapus file terkait jika ada
        if ($suratMasuk['file_surat'] && file_exists(WRITEPATH . 'uploads/' . $suratMasuk['file_surat'])) {
            unlink(WRITEPATH . 'uploads/' . $suratMasuk['file_surat']);
        }

        if ($this->suratMasukModel->delete($id_surat_masuk)) {
            return redirect()->to('/surat/surat_masuk')->with('success', 'Surat masuk berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus surat masuk.');
        }
    }
}
