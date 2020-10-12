<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Masterjurusan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'jurusanid' => [
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE
			],
			'jurusanname' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
			],
		]);
		$this->forge->addKey('jurusanid');
		$this->forge->createTable('masterjurusan');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
