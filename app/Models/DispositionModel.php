<?php

namespace App\Models;

use CodeIgniter\Model;

class DispositionModel extends Model
{
    protected $table = 'dispositions';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'letter_recipient_id',
        'user_id_receipient',
        'instruction',
        'status'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
