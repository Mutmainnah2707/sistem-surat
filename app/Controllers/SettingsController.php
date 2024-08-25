<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings');
    }

    public function updatePassword()
    {
        $validation =  \Config\Services::validation();
        
        $validation->setRules([
            'current_password' => 'required',
            'new_password'     => 'required|min_length[6]',
            'confirm_password' => 'required|matches[new_password]',
        ]);
    
        if (! $this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
    
        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');
        
        $userModel = new UserModel();
        $userId = session()->get('id'); // Assuming user ID is stored in session
    
        $user = $userModel->find($userId);
    
        if (!password_verify($currentPassword, $user['password'])) {
            return redirect()->back()->withInput()->with('errors', ['current_password' => 'Password saat ini salah']);
        }
    
        $userModel->update($userId, ['password' => password_hash($newPassword, PASSWORD_DEFAULT)]);
    
        return redirect()->to('/settings')->with('success', 'Password berhasil diperbarui');
    }
    
    
}
