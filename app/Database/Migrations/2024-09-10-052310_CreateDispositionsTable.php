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
            'letter_recipient_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true
            ],
            'user_id_recipient' => [ // Penerima disposisi
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true
            ],
            'instruction' => [
                'type'           => 'TEXT'
            ],
            'status' => [
                'type'           => 'ENUM',
                'constraint'     => ['pending', 'completed'],
                'default'        => 'pending'
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
        $this->forge->addForeignKey('letter_recipient_id', 'letter_recipients', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id_recipient', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('dispositions');
    }

    public function down()
    {
        $this->forge->dropTable('dispositions');
    }
}
