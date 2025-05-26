<?php

namespace App\Models;

use CodeIgniter\Model;

class DispositionModel extends Model
{
    protected $table = 'dispositions';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'letter_id',
        'sender_id',
        'recipient_id',
        'instruction',
        'status'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getDispositionLetters(int $userId)
    {
        return $this->builder('dispositions')
            ->select('*, letters.*, recipients.*')
            ->join('letters', 'letters.id = dispositions.letter_id')
            ->join('users as recipients', 'recipients.id = dispositions.recipient_id')
            ->where('dispositions.recipient_id', $userId)
            ->get()->getResultArray();
    }
}
