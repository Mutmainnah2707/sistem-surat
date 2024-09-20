<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Password;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'          => 'Kabir',
                'email'         => 'admin@example.com',
                'active'        => 1,
                'password_hash' => Password::hash('admin123')
            ],
            [
                'name'          => 'Fakultas Teknik',
                'email'         => 'satker@example.com',
                'active'        => 1,
                'password_hash' => Password::hash('satker123')
            ],
            [
                'name'          => 'Indah Permata',
                'email'         => 'penpon@example.com',
                'active'        => 1,
                'password_hash' => Password::hash('penpon123')
            ],
        ];

        $userModel = new UserModel();

        foreach ($data as $account) {
            $userModel->save($account);
        }

        // Set user role
        $authorize = service('authorization');
        $authorize->addUserToGroup(1, 'admin');
        $authorize->addUserToGroup(2, 'satker');
        $authorize->addUserToGroup(3, 'penpon');
    }
}
