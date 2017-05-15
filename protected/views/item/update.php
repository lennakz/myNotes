<?php
/* @var $this ItemController */
/* @var $model Item */

?>



	<h1 class="text-center"><?php echo $model->name; ?></h1>

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'item-form',
		'htmlOptions' => array(
			'class' => 'form-horizontal',
			'enctype' => 'multipart/form-data'
		),
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation' => false,
	));

	?>

	<p class="text-center text-danger">Fields with <span>*</span> are required.</p>

		<?php echo $form->errorSummary($model, '', '', array('class' => 'alert alert-danger')); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model, 'name', array('class' => 'control-label')); ?>
		<?php echo $form->textField($model, 'name'); ?>
		<?php echo $form->error($model, 'name'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model, 'quantity', array('class' => 'control-label')); ?>
		<?php echo $form->textField($model, 'quantity'); ?>
		<?php echo $form->error($model, 'quantity'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model, 'comment', array('class' => 'control-label')); ?>
		<?php echo $form->textArea($model, 'comment'); ?>
		<?php echo $form->error($model, 'comment'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'reminder',array('class'=>'control-label')); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
			$this->widget('CJuiDateTimePicker',array(
				'model'=>$model, //Model object
				'attribute'=>'reminder', //attribute name
				'mode'=>'datetime', //use "time","date" or "datetime" (default)
				'options'=>array(
					"dateFormat"=>'D M d',
					'stepMinute' => '15',
					'hourMax' => '23',
				) // jquery plugin options
			));
		?>
		<?php echo $form->error($model,'reminder'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model, 'image', array('class' => 'control-label')); ?>
		<?php echo CHtml::activeFileField($model, 'image'); ?>
		<?php echo $form->error($model, 'image'); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

