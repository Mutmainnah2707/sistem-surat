<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLetterRecipientsTable extends Migration
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
            'user_id' => [ // Penerima surat, sekaligus yang akan mengirim disposisi
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true
            ],
            'received_date' => [
                'type'           => 'DATETIME'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('letter_id', 'letters', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('letter_recipients');
    }

    public function down()
    {
        $this->forge->dropTable('letter_recipients');
    }
}
