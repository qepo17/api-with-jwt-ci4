<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mastersiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'no_induk' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'kelas_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 500
            ],
            'tempat_lahir' => [
                'type' => 'VARCHAR',
                'constraint' => 500
            ],
            'tanggal_lahir' => [
                'type' => 'DATE'
            ],
            'agama' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'jenis_kelamin' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 500
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 500
            ],
            'no_hp' => [
                'type' => 'VARCHAR',
                'constraint' => 500
            ],
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('no_induk');
        $this->forge->createTable('mastersiswa');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        //
    }
}
