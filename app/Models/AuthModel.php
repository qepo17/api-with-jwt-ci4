<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table      = 'masterlogin';
    protected $primaryKey = 'seqid';

    protected $allowedFields = ['no_induk', 'password', 'last_login', 'access_token', 'expires_at'];

    public function checkUser($no_induk)
    {
        return $this->where('no_induk', $no_induk)->first();
    }

    public function insertSiswa($no_induk)
    {
        $hash = password_hash($no_induk, PASSWORD_BCRYPT);
        $builder = $this->db->table('masterlogin');
        $post_auth = $builder->insert([
            'no_induk' => $no_induk,
            'password' => $hash,
        ]);
        return $post_auth;
    }

    public function insertGuru($guruid)
    {
        $hash = password_hash($guruid, PASSWORD_BCRYPT);
        $builder = $this->db->table('masterlogin_guru');
        $post_auth = $builder->insert([
            'guruid' => $guruid,
            'password' => $hash,
        ]);
        return $post_auth;
    }

    public function insertAccessToken($data)
    {
        $builder = $this->db->table('access_token');
        $post_token = $builder->insert([
            'no_induk' => $data['no_induk'],
            'access_token' => $data['access_token'],
            'expire_at' => $data['expire_at']
        ]);
        return $post_token;
    }

    public function insertRefreshToken($data)
    {
        $builder = $this->db->table('refresh_token');
        $post_refresh = $builder->insert([
            'no_induk' => $data['no_induk'],
            'refresh_token' => $data['refresh_token'],
            'expire_at' => $data['expire_at']
        ]);
        return $post_refresh;
    }
}
