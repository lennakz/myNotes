<?php
/* @var $this NoteController */
/* @var $model Note */

?>
<div class="container">
	<h1 class="text-center">Create Note</h1>

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'note-form',
		'htmlOptions' => array(
			'class' => 'form-horizontal',
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
	<?php echo $form->labelEx($model, 'title', array('class' => 'control-label')); ?>
		<?php echo $form->textArea($model, 'title'); ?>
		<?php echo $form->error($model, 'title', array('class' => 'text-danger text-center')); ?>
	</div>

	<div class="form-group">
	<?php echo $form->labelEx($model, 'description', array('class' => 'control-label')); ?>
		<?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
		<?php echo $form->error($model, 'description', array('class' => 'text-danger text-center')); ?>
	</div>

	<div class="form-group">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-success')); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>