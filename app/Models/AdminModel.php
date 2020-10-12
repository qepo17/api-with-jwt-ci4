<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $returnType = 'array';

    public function insertGrade($data)
    {
        $data = [
            'gradeid' => $data['gradeid'],
            'gradename' => $data['gradename'],
        ];

        $builder = $this->db->table('mastergrade');
        $post = $builder->insert($data);
        return $post;
    }

    public function insertJurusan($data)
    {
        $data = [
            'jurusanid' => $data['jurusanid'],
            'jurusanname' => $data['jurusanname'],
        ];

        $builder = $this->db->table('masterjurusan');
        $post = $builder->insert($data);
        return $post;
    }

    public function insertGuru($data)
    {
        $data = [
            'guruid' => $data['guruid'],
            'guruname' => $data['guruname'],
            'guruemail' => $data['guruemail'],
            'guruphone' => $data['guruphone'],
        ];

        $builder = $this->db->table('masterguru');
        $post = $builder->insert($data);
        return $post;
    }
}
