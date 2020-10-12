<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MasterloginGuru extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'guruid' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
			],
			'password' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
			],
			'last_login' => [
				'type' => 'DATETIME'
			],
		]);
		$this->forge->addKey('guruid');
		$this->forge->createTable('masterlogin_guru');
	}

	public function down()
	{
		//
	}
}
