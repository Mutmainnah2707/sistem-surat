<?php namespace App\Controllers;

use App\Models\UserModel;

use App\Models\SuratMasukModel;

class AdminController extends BaseController
{
    public function listAdmins()
    {
        $session = session();
        $data['user'] = $session->get('nama');
        $data['level'] = $session->get('level');
        $suratMasukModel = new SuratMasukModel();
        $data['jumlahBelumDibaca'] = $suratMasukModel->where('status', 0)
                                                     ->countAllResults();
        $userModel = new UserModel();
        $data['admins'] = $userModel->where('level', 'admin')->findAll();

        return view('admin/list_admins', $data);
    }
    
    public function listSatkers()
    {
        $session = session();
        $data['user'] = $session->get('nama');
        $data['level'] = $session->get('level');
        $suratMasukModel = new SuratMasukModel();
        $data['jumlahBelumDibaca'] = $suratMasukModel->where('status', 0)
                                                     ->countAllResults();
        $userModel = new UserModel();
        $data['satkers'] = $userModel->where('level', 'satker')->findAll();

        return view('admin/list_satkers', $data);
    }

    public function listPengurus()
    {
        $session = session();
        $data['user'] = $session->get('nama');
        $data['level'] = $session->get('level');
        $suratMasukModel = new SuratMasukModel();
        $data['jumlahBelumDibaca'] = $suratMasukModel->where('status', 0)
                                                     ->countAllResults();
        $userModel = new UserModel();
        $data['pengurus'] = $userModel->where('level', 'pengurus')->findAll();

        return view('admin/list_pengurus', $data);
    }

    public function tambahAdmin()
    {
        $session = session();
        $data['user'] = $session->get('nama');
        $data['level'] = $session->get('level');
        $suratMasukModel = new SuratMasukModel();
        $data['jumlahBelumDibaca'] = $suratMasukModel->where('status', 0)
                                                     ->countAllResults();
        return view('admin/tambah_admin',$data);
    }

    public function simpanAdmin()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama' => 'required|max_length[255]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'level' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new UserModel();
        $userModel->save([
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'level' => 'admin'
        ]);

        return redirect()->to('/admin/list-admin')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function tambahSatker()
    {
        $session = session();
        $data['user'] = $session->get('nama');
        $data['level'] = $session->get('level');
        $suratMasukModel = new SuratMasukModel();
        $data['jumlahBelumDibaca'] = $suratMasukModel->where('status', 0)
                                                     ->countAllResults();
        return view('admin/tambah_satker',$data);
    }

    public function simpanSatker()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama' => 'required|max_length[255]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'level' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new UserModel();
        $userModel->save([
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'level' => 'satker'
        ]);

        return redirect()->to('/admin/list-satker')->with('success', 'Satker berhasil ditambahkan.');
    }

    public function tambahPengurus()
    {
        $session = session();
        $data['user'] = $session->get('nama');
        $data['level'] = $session->get('level');
        $suratMasukModel = new SuratMasukModel();
        $data['jumlahBelumDibaca'] = $suratMasukModel->where('status', 0)
                                                     ->countAllResults();
        return view('admin/tambah_pengurus',$data);
    }

    public function simpanPengurus()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama' => 'required|max_length[255]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'level' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new UserModel();
        $userModel->save([
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'level' => 'pengurus'
        ]);

        return redirect()->to('/admin/list-pengurus')->with('success', 'Pengurus pondok berhasil ditambahkan.');
    }

    public function editAdmin($id)
    {
        $session = session();
        $data['user'] = $session->get('nama');
        $data['level'] = $session->get('level');
        $suratMasukModel = new SuratMasukModel();
        $data['jumlahBelumDibaca'] = $suratMasukModel->where('status', 0)
                                                     ->countAllResults();
        $userModel = new UserModel();
        $data['admin'] = $userModel->find($id);

        if (!$data['admin']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Admin tidak ditemukan.');
        }

        return view('admin/edit_admin', $data);
    }

    public function updateAdmin($id)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama' => 'required|max_length[255]',
            'email' => 'required|valid_email',
            'password' => 'permit_empty|min_length[6]',
            'level' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new UserModel();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'level' => $this->request->getPost('level')
        ];

        // Update password only if it is provided
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $userModel->update($id, $data);

        return redirect()->to('/admin/list-admin')->with('success', 'Admin berhasil diperbarui.');
    }

    public function editSatker($id)
    {
        $session = session();
        $data['user'] = $session->get('nama');
        $data['level'] = $session->get('level');
        $suratMasukModel = new SuratMasukModel();
        $data['jumlahBelumDibaca'] = $suratMasukModel->where('status', 0)
                                                     ->countAllResults();
        $userModel = new UserModel();
        $data['satker'] = $userModel->find($id);

        if (!$data['satker']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Satker tidak ditemukan.');
        }

        return view('admin/edit_satker', $data);
    }

    public function updateSatker($id)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama' => 'required|max_length[255]',
            'email' => 'required|valid_email',
            'password' => 'permit_empty|min_length[6]',
            'level' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new UserModel();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'level' => $this->request->getPost('level')
        ];

        // Update password only if it is provided
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $userModel->update($id, $data);

        return redirect()->to('/admin/list-satker')->with('success', 'Satker berhasil diperbarui.');
    }

    public function editPengurus($id)
    {
        $session = session();
        $data['user'] = $session->get('nama');
        $data['level'] = $session->get('level');
        $suratMasukModel = new SuratMasukModel();
        $data['jumlahBelumDibaca'] = $suratMasukModel->where('status', 0)
                                                     ->countAllResults();
        $userModel = new UserModel();
        $data['pengurus'] = $userModel->find($id);

        if (!$data['pengurus']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengurus tidak ditemukan.');
        }

        return view('admin/edit_pengurus', $data);
    }

    public function updatePengurus($id)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama' => 'required|max_length[255]',
            'email' => 'required|valid_email',
            'password' => 'permit_empty|min_length[6]',
            'level' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new UserModel();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'level' => $this->request->getPost('level')
        ];

        // Update password only if it is provided
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $userModel->update($id, $data);

        return redirect()->to('/admin/list-pengurus')->with('success', 'Pengurus pondok berhasil diperbarui.');
    }

    public function deleteAdmin($id)
    {
        $userModel = new UserModel();
        $admin = $userModel->find($id);

        if (!$admin) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Admin tidak ditemukan.');
        }

        $userModel->delete($id);

        return redirect()->to('/admin/list-admin')->with('success', 'Admin berhasil dihapus.');
    }

    public function deleteSatker($id)
    {
        $userModel = new UserModel();
        $satker = $userModel->find($id);

        if (!$satker) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Satker tidak ditemukan.');
        }

        $userModel->delete($id);

        return redirect()->to('/admin/list-satker')->with('success', 'Satker berhasil dihapus.');
    }

    public function deletePengurus($id)
    {
        $userModel = new UserModel();
        $pengurus = $userModel->find($id);

        if (!$pengurus) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengurus tidak ditemukan.');
        }

        $userModel->delete($id);

        return redirect()->to('/admin/list-pengurus')->with('success', 'Pengurus pondok berhasil dihapus.');
    }
}
