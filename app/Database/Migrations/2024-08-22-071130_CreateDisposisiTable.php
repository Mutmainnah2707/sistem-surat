<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDisposisiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_surat_masuk' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => false,
            ],
            'tanggal_disposisi' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'disposisi_ke' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
                'null'       => false,
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'file_disposisi' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        // Membuat foreign key untuk id_surat_masuk
        $this->forge->addForeignKey('id_surat_masuk', 'surat_masuk', 'id_surat', 'CASCADE', 'CASCADE');

        // Membuat tabel disposisi
        $this->forge->createTable('disposisi');
    }

    public function down()
    {
        // Menghapus tabel disposisi
        $this->forge->dropTable('disposisi');
    }
}
