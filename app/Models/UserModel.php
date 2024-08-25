<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nama', 'password', 'email', 'level'];
    protected $useTimestamps = false;

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}
