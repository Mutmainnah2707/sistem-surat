<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');  // Update jalur view
    }

    public function authenticate()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            // Set session data
            $session = session();
            $session->set([
                'id' => $user['id'],
                'nama' => $user['nama'],
                'email' => $user['email'],
                'level' => $user['level'],
                'isLoggedIn' => true
            ]);

            return redirect()->to('/dashboard');
        } else {
            $session = session();
            $session->setFlashdata('error', 'Invalid email or password');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
