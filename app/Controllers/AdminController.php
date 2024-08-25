<?php namespace App\Controllers;

use App\Models\UserModel;

class AdminController extends BaseController
{
    public function listAdmins()
    {
        $userModel = new UserModel();
        $data['admins'] = $userModel->where('level', 'admin')->findAll();

        return view('admin/list_admins', $data);
    }
    
    public function listSatkers()
    {
        $userModel = new UserModel();
        $data['satkers'] = $userModel->where('level', 'satker')->findAll();

        return view('admin/list_satkers', $data);
    }

    public function listPengurus()
    {
        $userModel = new UserModel();
        $data['pengurus'] = $userModel->where('level', 'pengurus')->findAll();

        return view('admin/list_pengurus', $data);
    }

    public function tambahAdmin()
    {
        return view('admin/tambah_admin');
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
        return view('admin/tambah_satker');
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
        return view('admin/tambah_pengurus');
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
}
