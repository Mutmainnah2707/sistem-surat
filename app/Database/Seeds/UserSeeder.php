<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'nama' => 'John Doe',
                'email' => 'john.doe@example.com',
                'password' => password_hash('password123', PASSWORD_BCRYPT),  // Password terenkripsi
                'level' => 'admin',
            ],
            [
                'id' => 2,
                'nama' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'password' => password_hash('password123', PASSWORD_BCRYPT),  // Password terenkripsi
                'level' => 'user',
            ],
            // Tambahkan lebih banyak data sesuai kebutuhan
        ];

        // Insert data into the users table
        $this->db->table('users')->insertBatch($data);
    }
}
