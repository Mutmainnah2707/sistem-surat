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
}
