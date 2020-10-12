<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MasterLogin extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'no_induk' => [
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
		$this->forge->addKey('no_induk');
		$this->forge->createTable('masterlogin');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
