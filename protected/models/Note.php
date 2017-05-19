<?php

/**
 * This is the model class for table "Note".
 *
 * The followings are the available columns in table 'Note':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $completed
 * @property integer $user_id
 * @property integer $created
 * @property integer $updated
 * @property double $lat
 * @property double $lng
 * 
 * @property Item[] $Items Relation to Item model
 * @property User $User Relation to User model
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
			array('title, user_id', 'required'),
			array('completed, user_id, created, updated', 'numerical', 'integerOnly' => true),
			array('lat, lng', 'numerical'),
			array('title, description, user_id', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, description, user_id, completed, created, updated', 'safe', 'on' => 'search'),
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
			'Items' => array(self::HAS_MANY, 'Item', 'note_id'),
			'User' => array(self::BELONGS_TO, 'User', 'user_id')
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
			'user_id' => 'User Id',
			'created' => 'Created',
			'updated' => 'Updated',
			'lat' => 'Latitude',
            'lng' => 'Longitude'
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

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('completed', $this->completed);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('created', $this->created);
		$criteria->compare('updated', $this->updated);
		$criteria->compare('lat',$this->lat);
        $criteria->compare('lng',$this->lng);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Note the static model class
	 */
	public static function model($className = __CLASS__)
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

	// Delete all related items to this note if note deleted
	public function beforeDelete()
	{
		Item::model()->deleteAllByAttributes(array('note_id' => $this->id));
		
		$folders = glob('uploads/'.$this->id.'/*'); // get all folders names
		
		if (!empty($folders)) 
		{
			foreach ($folders as $folder) // iterate folders
			{
				$files = glob($folder.'/*'); // get all file names inside each folder
				
				if (!empty($files))
				{
					foreach ($files as $file) //iterate files
						if (is_file($file))
							unlink($file); // delete file	
				}
				
				rmdir($folder);
			}
		}
		if (file_exists('uploads/'.$this->id))
			rmdir('uploads/'.$this->id);
		
		return parent::beforeDelete();
	}

	public function renderItemsList()
	{
		$c = Yii::app()->controller;
		
		$array = $this->Items;
		
		$p['items'] = array_msort($array, array('exclamation' => SORT_DESC, 'completed' => SORT_ASC, 'updated' => SORT_DESC));
		
		return $c->renderPartial('/note/_items', $p, true);
	}
	
}
