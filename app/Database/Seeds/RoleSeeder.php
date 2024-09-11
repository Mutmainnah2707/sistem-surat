<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $authorize = service('authorization');

        // Role
        $authorize->createGroup('admin', 'Site Administrators');
        $authorize->createGroup('satker', 'Satuan Kerja');
        $authorize->createGroup('penpon', 'Pengurus Pondok');
        $authorize->createGroup('user', 'Pengguna biasa');
    }
}
