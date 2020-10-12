<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Masterclassgroup extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'kelasid' => [
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE
			],
			'kelasname' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
			],
			'gradeid' => [
				'type' => 'INT',
				'constraint' => 11,
			],
			'jurusanid' => [
				'type' => 'INT',
				'constraint' => 11,
			],
			'walikelas_guruid' => [
				'type' => 'INT',
				'constraint' => 11,
			],
		]);
		$this->forge->addKey('kelasid');
		$this->forge->createTable('masterclassgroup');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
