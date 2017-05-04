<?php

class NoteController extends Controller
{

	public $layout = '//layouts/bootstrap';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow all users
				'actions' => array('index', 'view', 'items'),
				'users' => array('*'),
			),
			array('allow', // allow authenticated user
				'actions' => array('create', 'update', 'delete', 'addmap', 'savePosition', 'viewmap'),
				'users' => array('@'),
			),
			array('allow', // allow admin user
				'actions' => array('admin'),
				'users' => array('admin'),
			),
			array('deny', // deny all users
				'users' => array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view', array(
			'model' => $this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Note;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Note']))
		{
			$model->attributes = $_POST['Note'];
			if ($model->save())
				$this->redirect(Yii::app()->request->baseUrl . '/note/index');
		}

		$this->render('create', array(
			'model' => $model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Note']))
		{
			$model->attributes = $_POST['Note'];
			if ($model->save())
				$this->redirect(Yii::app()->request->baseUrl . '/note/index');
		}

		$this->render('update', array(
			'model' => $model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		$model->delete();
		$this->redirect(Yii::app()->request->baseUrl . '/note/index');

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria = new CDbCriteria;
		$criteria->compare('t.user_id', Yii::app()->user->id);
		$criteria->with = array('User');
		$criteria->order = 't.updated DESC, t.completed DESC';
		
		$p['notes'] = Note::model()->findAll($criteria);
		
		$this->render('index', $p);
	}

	public function actionItems($id)
	{
		$this->layout = '//layouts/items';

		$p['note'] = $this->loadModel($id);
		if (empty($p['note']))
			throw new CHttpException(400, 'No project with that ID exists');

		$this->render('items', $p);
	}
	
	public function actionAddmap($id)
	{
		$this->layout = '//layouts/items';
		
		$p['note'] = $this->loadModel($id);
		
		$this->render('addmap', $p);
	}
	
	public function actionViewmap()
	{
		$this->layout = '//layouts/items';
		
		$p['notes'] = Note::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id));
		
		$this->render('viewmap', $p);
	}
	
	public function actionSavePosition($id)
	{	
		$model = $this->loadModel($id);
		
		if (isset($_POST['Note']))
		{
			$model->attributes = $_POST['Note'];
			
			if ($model->save())
				$this->redirect(Yii::app()->request->baseUrl . '/note/index');
		}
		
		throw new CHttpException(400, 'Your request is empty');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Note('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Note']))
			$model->attributes = $_GET['Note'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Note the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Note::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Note $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'note-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
