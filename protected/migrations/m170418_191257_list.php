<?php

class m170418_191257_list extends CDbMigration
{
	public function up()
	{
		$this->createTable('list', array(
			'id' => 'INTEGER PRIMARY KEY',
			'title' => 'TEXT',
			'description' => 'TEXT',
			'item_id' => 'INTEGER', // Foreign key -> item.id
			'user_id' => 'INTEGER', // Foreign key -> iser.id
			'completed' => 'INTEGER',
			'due_date' => 'INTEGER',
			'created' => 'INTEGER',
			'updated' => 'INTEGER'
		));

		$this->createTable('item', array(
			'id' => 'INTEGER PRIMARY KEY', // Primary key
			'name' => 'TEXT',
			'type' => 'TEXT', // type of groceries
			'completed' => 'INTEGER',
			'created' => 'INTEGER',
			'updated' => 'INTEGER'
		));

		$this->createTable('user', array(
			'id' => 'INTEGER PRIMARY KEY',
			'name' => 'TEXT',
			'email' => 'TEXT',
			'password' => 'TEXT',
			'created' => 'INTEGER',
			'updated' => 'INTEGER'
		));
		
	}

	public function down()
	{
		$this->dropTable('list');
		$this->dropTable('item');
		$this->dropTable('user');
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