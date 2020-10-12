<?php

namespace App\Models;

use CodeIgniter\Model;

class GradeModel extends Model
{
    protected $table      = 'mastergrade';
    protected $primaryKey = 'gradeid';

    protected $returnType = 'array';
    protected $allowedFields = ['gradename'];

    public function getMaster()
    {
        return $this->find();
    }

    public function show($gradeid)
    {
        return $this->where('gradeid', $gradeid)->first();
    }

    public function deleteMaster($gradeid)
    {
        if ($this->where('gradeid', $gradeid)->first() != null) {
            $delete = $this->where('gradeid', $gradeid)->delete();
            return $delete;
        } else {
            return false;
        }
    }

    public function updateMaster($data)
    {
        if ($this->where('gradeid', $data['gradeid'])->first() != null) {
            $update = $this->update($data['gradeid'], [
                'gradename' => $data['gradename'],
            ]);

            return $update;
        } else {
            return false;
        }
    }

    public function insertMaster($data)
    {
        $data = [
            'gradeid' => $data['gradeid'],
            'gradename' => $data['gradename'],
        ];

        $builder = $this->db->table('mastergrade');
        $post = $builder->insert($data);
        return $post;
    }
}
