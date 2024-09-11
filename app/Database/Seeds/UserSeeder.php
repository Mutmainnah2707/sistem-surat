<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Password;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name'           => 'Admin',
            'username'       => 'admin',
            'email'          => 'admin@example.com',
            'active'           => 1,
            'password_hash'    => Password::hash('admin123')
        ];

        $userModel = new UserModel();
        $userModel->save($data);

        // Set role to admin
        $authorize = service('authorization');
        $authorize->addUserToGroup(1, 'admin');
    }
}
