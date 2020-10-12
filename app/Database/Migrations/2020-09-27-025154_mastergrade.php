<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mastergrade extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'gradeid' => [
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE
			],
			'gradename' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
			],
		]);
		$this->forge->addKey('gradeid');
		$this->forge->createTable('mastergrade');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
