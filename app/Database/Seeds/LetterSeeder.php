<?php

namespace App\Database\Seeds;

use App\Models\LetterModel;
use App\Models\LetterRecipientModel;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class LetterSeeder extends Seeder
{
    public function run()
    {
        $letters = [
            [
                'user_id'       => 1, // Sender (Admin)
                'letter_from'   => 'Universitas Islam Madura',
                'received_date' => Time::now(),
                'letter_date'   => Time::now(),
                'letter_number' => '0003/ilmu/KAPRODI/X/24',
                'subject'       => 'Undangan',
                'description'   => "Assalamu'alaikum Wr. Wb.",
                'attachment'    => 'surat-undangan.pdf'
            ],
            [
                'user_id'       => 2, // Sender (Satker)
                'letter_date'   => Time::now(),
                'letter_number' => '0003/ilmu/ADMIN/X/24',
                'subject'       => 'Edaran',
                'description'   => "Assalamu'alaikum Wr. Wb."
            ]
        ];

        $recipients = [
            [
                'letter_id'       => 1,
                'user_id'         => 2, // Satker
                'received_date' => Time::now()
            ],
            [
                'letter_id'       => 2,
                'user_id'         => 3, // Pengurus Pondok
                'received_date' => Time::now()
            ]
        ];

        $letterModel = new LetterModel();
        $recipientModel = new LetterRecipientModel();

        foreach ($letters as $letter) {
            $letterModel->save($letter);
        }
        foreach ($recipients as $recipient) {
            $recipientModel->save($recipient);
        }
    }
}
