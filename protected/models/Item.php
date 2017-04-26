<?php

/**
 * This is the model class for table "Item".
 *
 * The followings are the available columns in table 'Item':
 * @property integer $id
 * @property string $name
 * @property integer $note_id
 * @property string $type_id
 * @property integer $quantity
 * @property integer $completed
 * @property integer $created
 * @property integer $updated
 * 
 * @property Note $Note Relation to note
 * @property Type $Type Relation to types
 */
class Item extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('note_id, quantity, completed, created, updated', 'numerical', 'integerOnly'=>true),
			array('name, type_id', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, note_id, type_id, quantity, completed, created, updated', 'safe', 'on'=>'search'),
			array('name', 'required'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'Note' => array(self::BELONGS_TO, 'Note', 'note_id'),
			'Type' => array(self::BELONGS_TO, 'Type', 'type_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'note_id' => 'Note',
			'type_id' => 'Type',
			'quantity' => 'Quantity',
			'completed' => 'Completed',
			'created' => 'Created',
			'updated' => 'Updated',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('note_id',$this->note_id);
		$criteria->compare('type_id',$this->type_id,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('completed',$this->completed);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Item the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	// Update date
	public function beforeSave()
	{
		if ($this->isNewRecord)
		{
			$this->created = time();
			$this->completed = 0;
		}
			
		$this->updated = time();
		
		return parent::beforeSave();
	}
}
