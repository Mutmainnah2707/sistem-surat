<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'           => 'Admin',
                'username'       => 'admin',
                'email'          => 'admin@example.com',
                'password'       => password_hash('admin123', PASSWORD_BCRYPT),
                'departement_id' => 1,
                'created_at'     => Time::now(),
                'updated_at'     => Time::now()
            ],
            [
                'name'           => 'Satker',
                'username'       => 'satker',
                'email'          => 'satker@example.com',
                'password'       => password_hash('satker123', PASSWORD_BCRYPT),
                'departement_id' => 2,
                'created_at'     => Time::now(),
                'updated_at'     => Time::now()
            ],
            [
                'name'           => 'Pengurus',
                'username'       => 'pengurus',
                'email'          => 'pengurus@example.com',
                'password'       => password_hash('pengurus123', PASSWORD_BCRYPT),
                'departement_id' => 3,
                'created_at'     => Time::now(),
                'updated_at'     => Time::now()
            ]
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
