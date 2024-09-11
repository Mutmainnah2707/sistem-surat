<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLettersTable extends Migration
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
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true
            ],
            'letter_from' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => true
            ],
            'received_date' => [
                'type'           => 'DATE',
                'null'           => true
            ],
            'letter_date' => [
                'type'           => 'DATE'
            ],
            'letter_number' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'subject' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'description' => [
                'type'           => 'TEXT'
            ],
            'attachment' => [
                'type'           => 'TEXT'
            ],
            'status' => [
                'type'           => 'ENUM',
                'constraint'     => ['pending', 'processed'],
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
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('letters');
    }

    public function down()
    {
        $this->forge->dropTable('letters');
    }
}
