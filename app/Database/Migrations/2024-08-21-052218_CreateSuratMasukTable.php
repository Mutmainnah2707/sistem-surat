<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratMasukTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_surat' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'asal_surat' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
            ],
            'no_surat' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'perihal' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
            ],
            'tanggal_surat' => [
                'type' => 'DATE',
            ],
            'tanggal_terima' => [
                'type' => 'DATE',
            ],
            'tujuan_surat' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
            ],
        ]);
        $this->forge->addKey('id_surat', true);
        $this->forge->createTable('surat_masuk');
    }

    public function down()
    {
        $this->forge->dropTable('surat_masuk');
    }
}
