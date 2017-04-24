<?php

class m170420_232747_note extends CDbMigration
{
	public function up()
	{
		$this->createTable('note', array(
			'id' => 'INTEGER PRIMARY KEY',
			'title' => 'TEXT',
			'description' => 'TEXT',
			'item_id' => 'INTEGER', // Foreign key -> item.id
			'completed' => 'INTEGER',
			'created' => 'INTEGER',
			'updated' => 'INTEGER',
		));

		$this->createTable('item', array(
			'id' => 'INTEGER PRIMARY KEY', // Primary key
			'name' => 'TEXT',
			'type_id' => 'TEXT', // Foreign key -> type.id
			'quantity' => 'INTEGER',
			'completed' => 'INTEGER',
			'created' => 'INTEGER',
			'updated' => 'INTEGER',
		));

		$this->createTable('type', array(
			'id' => 'INTEGER PRIMARY KEY', // Primary key
			'name' => 'TEXT',
			'measurement' => 'TEXT',
			'created' => 'INTEGER',
			'updated' => 'INTEGER',
		));			
	}

	public function down()
	{
		$this->dropTable('list');
		$this->dropTable('item');
		$this->dropTable('type');
		return true;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}