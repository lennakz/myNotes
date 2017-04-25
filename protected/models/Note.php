<?php

/**
 * This is the model class for table "Note".
 *
 * The followings are the available columns in table 'Note':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $completed
 * @property integer $created
 * @property integer $updated
 * 
 * @property Item[] $Items Relation
 */
class Note extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Note';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('completed, created, updated', 'numerical', 'integerOnly'=>true),
			array('title, description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, description, completed, created, updated', 'safe', 'on'=>'search'),
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
			'Items' => array(self::HAS_MANY, 'Item', 'note_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'description' => 'Description',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
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
	 * @return Note the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	// Get number of items inside this note
	public function getNumberOfItems()
	{
		return Item::model()->countByAttributes(array('note_id' => $this->id));
	}

	// Get number of completed (bought) items
	public function getNumberOfCompletedItems()
	{
		 return Item::model()->countByAttributes(array('note_id' => $this->id, 'completed' => 1));
	}

	// Get % of completed (bought) items
	public function getPercentComplete()
	{
		$numberOfItems = $this->getNumberOfItems();
		$numberOfCompletedItems = $this->getNumberOfCompletedItems();

		if ($numberOfItems == 0)
			return 100;
		return ($numberOfCompletedItems / $numberOfItems) * 100;
	}

	// Update date
	public function beforeSave()
	{
		if ($this->isNewRecord)
			$this->created = time();

		$this->updated = time();

		return parent::beforeSave();
	}

	// Delete all related items to this note if note deleted
	public function beforeDelete()
	{
		Item::model()->deleteAllByAttributes(array('note_id' => $this->id));
		return parent::beforeDelete();
	}
	
	public function renderItemsList()
	{
		$c = Yii::app()->controller;
		$c->renderPartial('/note/_items', ['items' => $this->Items]);
	}
}
