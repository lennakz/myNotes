<?php
/* @var $this ItemController */
/* @var $model Item */

?>

<!-- For resize image client-side -->
<script src="<?php echo Yii::app()->request->baseUrl ?>/js/canvasResize/exif.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl ?>/js/canvasResize/binaryajax.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl ?>/js/canvasResize/canvasResize.js"></script>

<div class="container">

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
			<?php Yii::import('application.extensions.DateTimePicker.DateTimePicker');
				$this->widget('DateTimePicker',array(
					'model'=>$model, //Model object
					'attribute'=>'reminder', //attribute name
					'options'=>array(
						'closeOnTimeSelect' => false,
						'format' => 'D M j - H:i',
						'allowBlank' => true

					), // jquery plugin options

					'htmlOptions' => array(
						'autocomplete' => 'off',
						'onfocus' => 'blur()'
					),
				));
			?>
			<?php echo $form->error($model,'reminder'); ?>
		</div>

		<div class="form-group">
			<?php echo CHtml::fileField('file'); ?>
		</div>
		
		<input type="hidden" name="image-encoded" id="image-encoded">
		
		<div class="form-group">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-success')); ?>
		</div>

	<?php $this->endWidget(); ?>
		
		<img>

</div>

<script>
	$(function() {
		
		$('input[name=file]').change(function(e) {
			
			$('#image-encoded').val('');
			
			var file = e.target.files[0];
		
			canvasResize(file, {
				width: 300,
			    height: 0,
				crop: false,
				quality: 80,
				//rotate: 90,
				callback: function(data, width, height) {
					$('input[name=file]').val('');
					$('#image-encoded').val(data);
				}
			});
			
		});
	});
</script> 