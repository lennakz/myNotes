<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $fname
 * @property string $lname
 * @property string $email
 * @property integer $phone
 * @property string $created
 * @property string $updated
 * 
 * @property Notes[] $Notes Relation to Note model
 */
class User extends CActiveRecord
{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password', 'required'),
			array('phone', 'numerical', 'integerOnly' => true),
			array('email, fname, lname', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, fname, lname, email, phone, created, updated', 'safe', 'on' => 'search'),
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
			'Notes' => array(self::HAS_MANY, 'Note', 'user_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'phone' => 'Phone',
			'created' => 'Created',
			'updated' => 'Updated',
			'fname' => 'Fname',
            'lname' => 'Lname'
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
		$criteria->compare('username', $this->username, true);
		$criteria->compare('password', $this->password, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('fname', $this->fname, true);
		$criteria->compare('lname', $this->lname, true);
		$criteria->compare('phone', $this->phone);
		$criteria->compare('created', $this->created, true);
		$criteria->compare('updated', $this->updated, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	// Update date
	public function beforeSave()
	{
		if ($this->isNewRecord)
		{
			$this->created = time();
		}

		$this->updated = time();

		return parent::beforeSave();
	}

	// Delete all related notes to this user if deleted
	public function beforeDelete()
	{
		Note::model()->deleteAllByAttributes(array('user_id' => $this->id));
		return parent::beforeDelete();
	}
	
	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return $password === $this->password;
	}

}
