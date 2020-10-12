<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $table      = 'masterguru';
    protected $primaryKey = 'guruid';

    protected $returnType = 'array';
    protected $allowedFields = ['guruid', 'nickname', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'alamat', 'email', 'no_hp', 'foto', 'created_at', 'updated_at'];

    public function encryptData($data)
    {
        $encrypter = \Config\Services::encrypter();
        $guru_data = [
            'nickname' =>  bin2hex($encrypter->encrypt($data['nickname'])),
            'nama' =>  bin2hex($encrypter->encrypt($data['nama'])),
            'tempat_lahir' => bin2hex($encrypter->encrypt($data['tempat_lahir'])),
            'alamat' => bin2hex($encrypter->encrypt($data['alamat'])),
            'email' => bin2hex($encrypter->encrypt($data['email'])),
            'no_hp' => bin2hex($encrypter->encrypt($data['no_hp'])),
        ];

        return $guru_data;
    }

    public function decryptData($data)
    {
        $encrypter = \Config\Services::encrypter();
        $guru_data = [
            'nickname' =>  $encrypter->decrypt(hex2bin($data['nickname'])),
            'nama' =>  $encrypter->decrypt(hex2bin($data['nama'])),
            'tempat_lahir' => $encrypter->decrypt(hex2bin($data['tempat_lahir'])),
            'alamat' => $encrypter->decrypt(hex2bin($data['alamat'])),
            'email' => $encrypter->decrypt(hex2bin($data['email'])),
            'no_hp' => $encrypter->decrypt(hex2bin($data['no_hp'])),
        ];

        return $guru_data;
    }

    public function getMaster($no_induk)
    {
        return $this->where('guruid', $no_induk)->first();
    }

    public function deleteMaster($guruid)
    {
        if ($this->where('guruid', $guruid)->first() != null) {
            $delete = $this->where('guruid', $guruid)->delete();
            return $delete;
        } else {
            return false;
        }
    }

    public function updateMaster($data)
    {
        if ($this->where('guruid', $data['guruid'])->first() != null) {
            $encrypted_data = $this->encryptData($data);
            $guru_data = [
                'nickname' =>  $encrypted_data['nickname'],
                'nama' =>  $encrypted_data['nama'],
                'tempat_lahir' => $encrypted_data['tempat_lahir'],
                'tanggal_lahir' =>  $data['tanggal_lahir'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'alamat' => $encrypted_data['alamat'],
                'email' => $encrypted_data['email'],
                'no_hp' => $encrypted_data['no_hp'],
                'foto' => $data['foto']
            ];

            $update = $this->update($data['guruid'], $guru_data);

            return $update;
        } else {
            return false;
        }
    }

    public function insertMaster($data)
    {
        $encrypted_data = $this->encryptData($data);
        $guru_data = [
            'guruid' => $data['guruid'],
            'nickname' =>  $encrypted_data['nickname'],
            'nama' =>  $encrypted_data['nama'],
            'tempat_lahir' => $encrypted_data['tempat_lahir'],
            'tanggal_lahir' =>  $data['tanggal_lahir'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'alamat' => $encrypted_data['alamat'],
            'email' => $encrypted_data['email'],
            'no_hp' => $encrypted_data['no_hp'],
            'foto' => $data['foto']
        ];

        $builder = $this->db->table('masterguru');
        $post = $builder->insert($guru_data);
        return $post;
    }
}
