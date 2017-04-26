<?php
/* @var $this ItemController */
/* @var $model Item */

$this->breadcrumbs=array(
	'Items'=>array('index'),
	'Create',
);
?>

<h1>Create Item</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>