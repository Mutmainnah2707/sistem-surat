<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDispositionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'letter_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true
            ],
            'sender_id' => [ // Pengirim disposisi
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true
            ],
            'recipient_id' => [ // Penerima disposisi
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true
            ],
            'instruction' => [
                'type'           => 'TEXT'
            ],
            'status' => [
                'type'           => 'ENUM',
                'constraint'     => ['Pending', 'Completed'],
                'default'        => 'Pending'
            ],
            'created_at' => [
                'type'           => 'DATETIME',
                'null'           => true
            ],
            'updated_at' => [
                'type'           => 'DATETIME',
                'null'           => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('letter_id', 'letters', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('sender_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('recipient_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('dispositions');
    }

    public function down()
    {
        $this->forge->dropTable('dispositions');
    }
}
