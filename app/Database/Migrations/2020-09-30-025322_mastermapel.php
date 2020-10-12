<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mastermapel extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'mapelid' => [
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE
			],
			'mapelname' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
			],
		]);
		$this->forge->addKey('mapelid');
		$this->forge->createTable('mastermapel');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
