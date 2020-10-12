<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table      = 'mastersiswa';
    protected $primaryKey = 'no_induk';

    protected $returnType = 'array';
    protected $allowedFields = ['no_induk', 'kelasid', 'nama', 'tempat_lahir', 'tanggal_lahir', 'agama', 'jenis_kelamin', 'alamat', 'email', 'no_hp', 'foto', 'created_at', 'updated_at'];

    public function encryptData($data)
    {
        $encrypter = \Config\Services::encrypter();
        $siswa_data = [
            'nama' =>  bin2hex($encrypter->encrypt($data['nama'])),
            'tempat_lahir' => bin2hex($encrypter->encrypt($data['tempat_lahir'])),
            'alamat' => bin2hex($encrypter->encrypt($data['alamat'])),
            'email' => bin2hex($encrypter->encrypt($data['email'])),
            'no_hp' => bin2hex($encrypter->encrypt($data['no_hp'])),
        ];

        return $siswa_data;
    }

    public function decryptData($data)
    {
        $encrypter = \Config\Services::encrypter();
        $siswa_data = [
            'nama' =>  $encrypter->decrypt(hex2bin($data['nama'])),
            'tempat_lahir' => $encrypter->decrypt(hex2bin($data['tempat_lahir'])),
            'alamat' => $encrypter->decrypt(hex2bin($data['alamat'])),
            'email' => $encrypter->decrypt(hex2bin($data['email'])),
            'no_hp' => $encrypter->decrypt(hex2bin($data['no_hp'])),
        ];

        return $siswa_data;
    }

    public function getMaster($no_induk)
    {
        return $this->where('no_induk', $no_induk)->first();
    }

    public function deleteMaster($no_induk)
    {
        if ($this->where('no_induk', $no_induk)->first() != null) {
            $delete = $this->where('no_induk', $no_induk)->delete();
            return $delete;
        } else {
            return false;
        }
    }

    public function updateMaster($data)
    {
        if ($this->where('no_induk', $data['no_induk'])->first() != null) {
            $encrypted_data = $this->encryptData($data);
            $siswa_data = [
                'kelasid' =>  $data['kelasid'],
                'nama' =>  $encrypted_data['nama'],
                'tempat_lahir' => $encrypted_data['tempat_lahir'],
                'tanggal_lahir' =>  $data['tanggal_lahir'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'alamat' => $encrypted_data['alamat'],
                'email' => $encrypted_data['email'],
                'no_hp' => $encrypted_data['no_hp'],
                'foto' => $data['foto']
            ];

            $update = $this->update($data['no_induk'], $siswa_data);

            return $update;
        } else {
            return false;
        }
    }

    public function insertMaster($data)
    {
        $encrypted_data = $this->encryptData($data);
        $siswa_data = [
            'no_induk' => $data['no_induk'],
            'kelasid' => $data['kelasid'],
            'nama' =>  $encrypted_data['nama'],
            'tempat_lahir' => $encrypted_data['tempat_lahir'],
            'tanggal_lahir' =>  $data['tanggal_lahir'],
            'agama' => $data['agama'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'alamat' => $encrypted_data['alamat'],
            'email' => $encrypted_data['email'],
            'no_hp' => $encrypted_data['no_hp'],
            'foto' => $data['foto']
        ];

        $builder = $this->db->table('mastersiswa');
        $post = $builder->insert($siswa_data);
        return $post;
    }
}
