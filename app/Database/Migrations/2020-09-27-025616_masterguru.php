<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Masterguru extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'guruid' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
			],
			'nickname' => [
				'type' => 'VARCHAR',
				'constraint' => 500,
			],
			'nama' => [
				'type' => 'VARCHAR',
				'constraint' => 500,
			],
			'tempat_lahir' => [
				'type' => 'VARCHAR',
				'constraint' => 500,
			],
			'tanggal_lahir' => [
				'type' => 'DATE',
			],
			'alamat' => [
				'type' => 'VARCHAR',
				'constraint' => 500,
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => 500,
			],
			'no_hp' => [
				'type' => 'VARCHAR',
				'constraint' => 500,
			],
			'created_at' => [
				'type' => 'DATETIME',
			],
			'updated_at' => [
				'type' => 'DATETIME',
			],
		]);
		$this->forge->addKey('guruid');
		$this->forge->createTable('masterguru');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('masterguru');
	}
}
