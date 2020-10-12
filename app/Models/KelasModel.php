<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table      = 'masterclassgroup';
    protected $primaryKey = 'kelasid';

    protected $returnType = 'array';
    protected $allowedFields = ['kelasname', 'gradeid', 'jurusanid', 'walikelas_guruid'];

    public function getMaster()
    {
        return $this->find();
    }

    public function show($kelasid)
    {
        return $this->where('kelasid', $kelasid)->first();
    }

    public function deleteMaster($kelasid)
    {
        if ($this->where('kelasid', $kelasid)->first() != null) {
            $delete = $this->where('kelasid', $kelasid)->delete();
            return $delete;
        } else {
            return false;
        }
    }

    public function updateMaster($data)
    {
        if ($this->where('kelasid', $data['kelasid'])->first() != null) {
            $kelas_data = [
                'kelasname' => $data['kelasname'],
                'gradeid' => $data['gradeid'],
                'jurusanid' => $data['jurusanid'],
                'walikelas_guruid' => $data['walikelas_guruid'],
            ];

            $update = $this->update($data['kelasid'], $kelas_data);

            return $update;
        } else {
            return false;
        }
    }

    public function insertMaster($data)
    {
        $kelas_data = [
            'kelasname' => $data['kelasname'],
            'gradeid' => $data['gradeid'],
            'jurusanid' => $data['jurusanid'],
            'walikelas_guruid' => $data['walikelas_guruid'],
        ];

        $builder = $this->db->table('masterclassgroup');
        $post = $builder->insert($kelas_data);
        return $post;
    }
}
