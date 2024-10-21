<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run()
    {
        $authorize = service('authorization');

        // Group
        $authorize->createGroup('admin', 'Site Administrators');
        $authorize->createGroup('pimpinan', 'Pimpinan');
        $authorize->createGroup('satker', 'Satuan Kerja');
        $authorize->createGroup('penpon', 'Pengurus Pondok');
        $authorize->createGroup('user', 'Pengguna biasa');
    }
}
