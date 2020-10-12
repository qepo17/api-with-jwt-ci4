<?php

namespace App\Models;

use CodeIgniter\Model;

class TokenModel extends Model
{
    protected $table      = 'access_token';
    protected $primaryKey = 'seqid';

    protected $allowedFields = ['access_token', 'expire_at'];

    public function verifyToken($access_token)
    {
        return $this->where('access_token', $access_token)->first();
    }
}
