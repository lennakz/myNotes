<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>

<br>
<h1 class="text-center">Contact Us</h1>
<br>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p class="text-center">If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.</p>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
	),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="text-center text-danger">Fields with <span>*</span> are required.</p>
	<br>

	<?php echo $form->errorSummary($model,null,null,array('class'=>'alert alert-danger')); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'name',array('class'=>'control-label col-sm-3')); ?>
		<div class="col-sm-7">
			<?php echo $form->textField($model,'name'); ?>
			<?php echo $form->error($model,'name',array('class'=>'text-danger')); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email',array('class'=>'control-label col-sm-3')); ?>
		<div class="col-sm-7">
			<?php echo $form->textField($model,'email'); ?>
			<?php echo $form->error($model,'email',array('class'=>'text-danger')); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'subject',array('class'=>'control-label col-sm-3')); ?>
		<div class="col-sm-7">
			<?php echo $form->textField($model,'subject',array('maxlength'=>128)); ?>
			<?php echo $form->error($model,'subject',array('class'=>'text-danger')); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'body',array('class'=>'control-label col-sm-3')); ?>
		<div class="col-sm-7">
			<?php echo $form->textArea($model,'body',array('rows'=>6)); ?>
			<?php echo $form->error($model,'body',array('class'=>'text-danger')); ?>
		</div>
	</div>
	<br>
	
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-7">
			<?php echo CHtml::submitButton('Submit',array('class'=>'btn btn-success')); ?>
			<?php echo CHtml::resetButton('Clear', array('class'=>'btn btn-default')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

<?php endif; ?>