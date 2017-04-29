<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'htmlOptions' => array(
		'class' => 'form-horizontal',
	),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="text-center text-danger">Fields with <span>*</span> are required.</p>

	<?php echo $form->errorSummary($model, '', '', array('class' => 'alert alert-danger')); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'username', array('class' => 'control-label')); ?>
		<?php echo $form->textArea($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'password', array('class' => 'control-label')); ?>
		<?php echo $form->textArea($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'fname', array('class' => 'control-label')); ?>
		<?php echo $form->textArea($model,'fname'); ?>
		<?php echo $form->error($model,'fname'); ?>
	</div>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'lname', array('class' => 'control-label')); ?>
		<?php echo $form->textArea($model,'lname'); ?>
		<?php echo $form->error($model,'lname'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email', array('class' => 'control-label')); ?>
		<?php echo $form->textArea($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'phone', array('class' => 'control-label')); ?>
		<?php echo $form->textField($model,'phone'); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>