<?php

class ItemController extends Controller
{

	public $layout = '//layouts/bootstrap';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions' => array('index', 'view', 'ajaxCreate', 'create', 'update', 'delete'),
				'users' => array('*'),
			),
			array('allow', // allow authenticated user
				'actions' => array(),
				'users' => array('@'),
			),
			array('allow', // allow admin user
				'actions' => array('admin'),
				'users' => array('admin'),
			),
//			array('deny', // deny all users
//				'users' => array('*'),
//			),
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
	
	public function actionAjaxCreate()
	{
		$model = new Item;
				
		if (!isset($_POST['Item']))
			throw new CHttpException('No Item data received', 400);
		
		$model->attributes = $_POST['Item'];
		
		// Split string when 2 whitespaces, put first part to name, second part to quantity
		$entries = preg_split('/(\s{2,})/', $_POST['Item']['name']);
		
		if (!empty($entries[1]))
		{
			$model->name = $entries[0];
			$model->quantity = $entries[1];
		}
		
		if ($model->save())
		{
			$file =$_FILES['file'];
			$folder = 'uploads/' . $model->Note->id . '/' . $model->id;
			$fileName = time() . '_' . $file['name'];
			$link = $folder . '/' . $fileName;

			if(!is_writable($folder))
				mkdir($folder, 0777, true);

			$uploadedFile = CUploadedFile::getInstanceByName('file');
			$uploadedFile->saveAs($link);

			$model->image = $link;
			
			$json = ['status' => 'ok', 'html' => $model->Note->renderItemsList()];
		}
		else 
			$json = ['status' => 'error', 'errors' => $model->errors];
		
		echo json_encode($json);
		exit;
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Item;
		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Item']))			
		{
			$model->attributes = $_POST['Item'];
			
			
			$entries = preg_split('/(\s{2,})/', $_POST['Item']['name']);
			if (!empty($entries[1]))
			{
				$model->name = $entries[0];
				$model->quantity = $entries[1];
			}
			
			if ($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$this->layout = '//layouts/items';
		
		$model = $this->loadModel($id);
		if (!empty($model->reminder))
			$model->reminder = date("D M j \- H:i", $model->reminder);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Item']))
		{
			$folder = 'uploads/' . $model->Note->id . '/' . $model->id;
						
			if(!is_writable($folder))
					mkdir($folder, 0777, true);
			
			if (!empty($_POST['image-encoded']))
			{
				$imageEncouded = $_POST['image-encoded']; // Encoded base64 with data:image/jpeg;base64, prefix
				
				$fileName = saveBase64($imageEncouded, $folder); // Save image and return filename
			}
				
			if ($_FILES['file']['error'] === 0)
			{
				$file =$_FILES['file'];
				$uploadedFile = CUploadedFile::getInstanceByName('file');
				$fileName = time().'.'.$uploadedFile->getExtensionName();
											
				//tempImageResize(300, 300, $uploadedFile); server-side resize
				$uploadedFile->saveAs($folder.'/'.$fileName);
			}
						
			$time =$_POST['Item']['reminder'];
			$model->attributes = $_POST['Item'];
			$model->quantity = $_POST['Item']['quantity'];
			$model->reminder = strtotime(str_replace('- ', '', $_POST['Item']['reminder']));
			$model->comment = $_POST['Item']['comment'];
			$model->image = $folder.'/'.$fileName;
			
			if ($model->save())
				$this->redirect(Yii::app()->request->baseUrl . '/note/items/' . $model->Note->id);
		}

		$this->render('update', array(
			'model' => $model,
		));
	}
	
	public function actionAjaxCompleteUpdate($id)
	{
		$model = $this->loadModel($id);
		
		if ($model->completed == 0)
		{
			$model->completed = 1;
			$model->exclamation = 0;
		}
		else
			$model->completed = 0;
		//dump($model->completed);exit;
		if ($model->save())
			echo $model->Note->renderItemsList();
	}

	public function actionAjaxExclamationUpdate($id)
	{
		$model = $this->loadModel($id);
		
		if ($model->exclamation == 0)
			$model->exclamation = 1;
		else
			$model->exclamation = 0;
		//dump($model->completed);exit;
		if ($model->save())
			echo $model->Note->renderItemsList();
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

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		
		echo $model->Note->renderItemsList();
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('Item');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Item('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Item']))
			$model->attributes = $_GET['Item'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Item the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Item::model()->findByPk($id);
		
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Item $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'item-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
