<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Myth\Auth\Password;

class UserManagementController extends BaseController
{
    public function index($level) // Parameter level untuk menampilkan data sesuai level ke view sesuai menu view yg diklik
    {
        // Get data pengguna dan rolenya
        $this->data['users'] = $this->userModel
            ->select('users.id, users.name, users.username, users.email, auth_groups.name as level, auth_groups.description')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->where('auth_groups.name', $level)
            ->get()->getResultArray();

        $this->data['level'] = $level;

        return view('admin/user_management/index', $this->data);
    }

    public function create($level) // Parameter level untuk menampilkan tulisan level ke view sesuai menu input pengguna yg diklik
    {
        $this->data['level'] = $level;
        return view('admin/user_management/create', $this->data);
    }

    public function store($level) // Parameter level untuk menyimpan data user dengan level tertentu
    {
        // Validasi data yang akan disimpan
        if (!$this->validate([
            // Validasi tabel users
            'name'         => 'required|alpha_space',
            'email'        => 'required|is_unique[users.email]',
            'password'     => 'required|min_length[5]',
            'pass_confirm' => 'required|matches[password]'
        ])) {
            return redirect()->back()->withInput();
        };

        // Tampung data pengguna ke dalam variabel
        $user = [
            'name'          => $this->request->getPost('name'),
            'email'         => $this->request->getPost('email'),
            'active'        => 1,
            'password_hash' => Password::hash($this->request->getPost('password'))
        ];

        // Simpan data pengguna
        $this->userModel->save($user);

        // Get id pengguna yang baru saja disimpan
        $userId = $this->userModel->insertID();

        $authorize = service('authorization');

        // Atur level pengguna menggunakan parameter $level
        if ($authorize->addUserToGroup($userId, $level)) {
            // Alert jika data pengguna berhasil ditambahkan
            $this->session->setFlashdata('success', 'Data pengguna berhasil ditambahkan.');
        } else {
            // Alert jika data pengguna gagal ditambahkan
            $this->session->setFlashdata('error', 'Data pengguna gagal ditambahkan.');
        }

        return redirect()->to('manajemen-pengguna/' . $level);
    }

    public function edit($level, $id) // Parameter level dan id untuk menampilkan data sesuai level dan data pengguna yang akan diperbarui
    {
        // Get data pengguna dan levelnya
        $this->data['user'] = $this->userModel->asArray()
            ->select('users.id, users.name, users.email, auth_groups.id as id_level, auth_groups.name as level')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->find($id);

        // dd($this->data['user']);

        // Kirim paramenter level ke view edit
        $this->data['level'] = $level;

        // Get data level pengguna dari database
        $this->data['groups'] = $this->groupModel->asArray()->findAll();

        return view('admin/user_management/edit', $this->data);
    }

    public function update($id)
    {
        // Get data user yang akan diedit
        $user = $this->userModel->asArray()
            ->select('auth_groups_users.*, auth_groups.name as level, users.name, users.email')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->where('users.id', $id)
            ->first();

        // Cek jika email yang diinput sama dengan email yang ada di database
        if ($this->request->getPost('email') == $user['email']) {
            $email_rules = 'required';
        } else {
            $email_rules = 'required|is_unique[users.email]';
        }

        // Validasi data yang akan diperbarui
        if (!$this->validate([
            // Validasi tabel users
            'name'         => 'required|alpha_space',
            'email'        => $email_rules,
            // 'password'     => 'required|min_length[5]',
            // 'pass_confirm' => 'required|matches[password]'
        ])) {
            return redirect()->back()->withInput();
        };

        // Tampung data pengguna ke dalam variabel
        $userForm = [
            'name'          => $this->request->getPost('name'),
            'email'         => $this->request->getPost('email'),
            // 'password_hash' => Password::hash($this->request->getPost('password'))
        ];

        // Perbarui data pengguna
        $this->userModel->update($id, $userForm);

        // Tampung data level berdasarkan id level yang diambil dari form
        $level = $this->groupModel->asArray()->find($this->request->getPost('level'));

        $authorize = service('authorization');

        // Hapus level pengguna saat ini kemudian tambah level pengguna sekarang
        if (
            $authorize->removeUserFromGroup($id, $user['level']) &&
            $authorize->addUserToGroup($id, $level['name'])
        ) {
            // Alert jika data pengguna berhasil diperbarui
            $this->session->setFlashdata('success', 'Data pengguna berhasil diperbarui.');
        } else {
            // Alert jika data pengguna gagal diperbarui
            $this->session->setFlashdata('error', 'Data pengguna gagal diperbarui.');
        }

        return redirect()->to('manajemen-pengguna/' . $level['name']);
    }

    public function delete($id)
    {
        // Jika data yang akan dihapus adalah admin pertama
        if ($id == 1) {
            $this->session->setFlashdata('error', 'Data admin tidak boleh dihapus.');
            return redirect()->back();
        }

        // Hapus data pengguna, tambahkan paramenter true untuk menghapus data secara permanen (karena menggunakan soft delete)
        if ($this->userModel->delete($id, true)) {
            // Alert jika data pengguna berhasil dihapus
            $this->session->setFlashdata('success', 'Data pengguna berhasil dihapus.');
        } else {
            // Alert jika data pengguna gagal dihapus
            $this->session->setFlashdata('error', 'Data pengguna gagal dihapus.');
        }

        return redirect()->back();
    }
}
