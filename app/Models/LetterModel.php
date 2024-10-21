<?php

namespace App\Models;

use CodeIgniter\Model;

class LetterModel extends Model
{
    protected $table = 'letters';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'letter_from',
        'received_date',
        'letter_date',
        'letter_number',
        'subject',
        'letter_file',
        'status'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
