<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Masterakademi extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'akademiid' => [
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE
			],
			'kelasid' => [
				'type' => 'INT',
				'constraint' => 11,
			],
			'guruid' => [
				'type' => 'INT',
				'constraint' => 11,
			],
			'mapelid' => [
				'type' => 'INT',
				'constraint' => 11,
			],
		]);
		$this->forge->addKey('akademiid');
		$this->forge->createTable('masterakademi');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
