<?php

namespace App\Models;

use CodeIgniter\Model;

class LetterRecipientModel extends Model
{
    protected $table = 'letter_recipients';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'letter_id',
        'user_id',
        'is_read',
        'received_date'
    ];
}
