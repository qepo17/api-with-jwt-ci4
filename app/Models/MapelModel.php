<?php

namespace App\Models;

use CodeIgniter\Model;

class MapelModel extends Model
{
    protected $table      = 'mastermapel';
    protected $primaryKey = 'mapelid';

    protected $returnType = 'array';
    protected $allowedFields = ['mapelname'];

    public function getMaster()
    {
        return $this->find();
    }

    public function show($mapelid)
    {
        return $this->where('mapelid', $mapelid)->first();
    }

    public function deleteMaster($mapelid)
    {
        if ($this->where('mapelid', $mapelid)->first() != null) {
            $delete = $this->where('mapelid', $mapelid)->delete();
            return $delete;
        } else {
            return false;
        }
    }

    public function updateMaster($data)
    {
        if ($this->where('mapelid', $data['mapelid'])->first() != null) {
            $update = $this->update($data['mapelid'], [
                'mapelname' => $data['mapelname'],
            ]);

            return $update;
        } else {
            return false;
        }
    }

    public function insertMaster($data)
    {
        $data = [
            'mapelid' => $data['mapelid'],
            'mapelname' => $data['mapelname'],
        ];

        $builder = $this->db->table('mastermapel');
        $post = $builder->insert($data);
        return $post;
    }
}
