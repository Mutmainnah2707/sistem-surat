<?php

namespace App\Controllers;

use Myth\Auth\Password;

class SettingController extends BaseController
{
    public function index()
    {
        return view('setting/index', $this->data);
    }

    public function update()
    {
        // Validasi data yang akan diperbarui
        if (!$this->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min_length[5]',
            'pass_confirm'     => 'required|matches[new_password]'
        ])) {
            return redirect()->back()->withInput();
        };

        // Tampung password saat ini ke dalam variabel
        $currentPassword = $this->request->getPost('current_password');

        // Get data pengguna yang akan diperbarui passwordnya
        $user = $this->userModel->asArray()->find(user()->id);

        // Cek apakah password saat ini sudah benar (sama dengan password yang ada di database)
        if (!Password::verify($currentPassword, $user['password_hash'])) {
            // Alert jika password saat ini salah
            $this->session->setFlashdata('error', 'Password saat ini salah.');
            return redirect()->back()->withInput();
        }

        // Tampung password baru ke dalam variabel
        $newPassword = $this->request->getPost('new_password');

        // Perbarui password
        if ($this->userModel->update(user()->id, ['password_hash' => Password::hash($newPassword)])) {
            // Alert jika data password berhasil diperbarui
            $this->session->setFlashdata('success', 'Password berhasil diperbarui.');
        } else {
            // Alert jika data password gagal diperbarui
            $this->session->setFlashdata('error', 'Password gagal diperbarui.');
        }

        return redirect()->back();
    }
}
