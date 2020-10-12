<?php

namespace App\Models;

use CodeIgniter\Model;

class JurusanModel extends Model
{
    protected $table      = 'masterjurusan';
    protected $primaryKey = 'jurusanid';

    protected $returnType = 'array';
    protected $allowedFields = ['jurusanname'];

    public function getMaster()
    {
        return $this->find();
    }

    public function show($jurusanid)
    {
        return $this->where('jurusanid', $jurusanid)->first();
    }

    public function deleteMaster($jurusanid)
    {
        if ($this->where('jurusanid', $jurusanid)->first() != null) {
            $delete = $this->where('jurusanid', $jurusanid)->delete();
            return $delete;
        } else {
            return false;
        }
    }

    public function updateMaster($data)
    {
        if ($this->where('jurusanid', $data['jurusanid'])->first() != null) {
            $update = $this->update($data['jurusanid'], [
                'jurusanname' => $data['jurusanname'],
            ]);

            return $update;
        } else {
            return false;
        }
    }

    public function insertMaster($data)
    {
        $data = [
            'jurusanid' => $data['jurusanid'],
            'jurusanname' => $data['jurusanname'],
        ];

        $builder = $this->db->table('masterjurusan');
        $post = $builder->insert($data);
        return $post;
    }
}
