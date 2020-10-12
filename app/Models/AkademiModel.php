<?php

namespace App\Models;

use CodeIgniter\Model;

class AkademiModel extends Model
{
    protected $table      = 'masterakademi';
    protected $primaryKey = 'akademiid';

    protected $returnType = 'array';
    protected $allowedFields = ['kelasid', 'guruid', 'mapelid'];

    public function getMaster()
    {
        return $this->find();
    }

    public function show($akademiid)
    {
        return $this->where('akademiid', $akademiid)->first();
    }

    public function deleteMaster($akademiid)
    {
        if ($this->where('akademiid', $akademiid)->first() != null) {
            $delete = $this->where('akademiid', $akademiid)->delete();
            return $delete;
        } else {
            return false;
        }
    }

    public function updateMaster($data)
    {
        if ($this->where('akademiid', $data['akademiid'])->first() != null) {
            $update = $this->update($data['akademiid'], [
                'kelasid' => $data['kelasid'],
                'guruid' => $data['guruid'],
                'mapelid' => $data['mapelid'],
            ]);

            return $update;
        } else {
            return false;
        }
    }

    public function insertMaster($data)
    {
        $data = [
            'kelasid' => $data['kelasid'],
            'guruid' => $data['guruid'],
            'mapelid' => $data['mapelid'],
        ];

        $builder = $this->db->table('masterakademi');
        $post = $builder->insert($data);
        return $post;
    }
}
