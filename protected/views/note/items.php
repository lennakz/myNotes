<?php
/* @var $this NoteController */
/* @var $items Item[] */
/* @var $note Note */

$this->breadcrumbs=array(
	'Notes',
);
?>

<section class="items" id="items">
	
	<div class="items-body">
		
		<div class="header">
			<h1 class="text-center"><?php echo $note->title ?></h1>
			<p class="text-center"><i><?php echo date('d/m/Y', $note->updated) ?></i></p>
			<div id="form-error"></div>
			<form class="ajax-form" 
				  data-error-target="#form-error" 
				  data-target="#ajax-container" 
				  action="<?php echo Yii::app()->request->baseUrl ?>/item/ajaxCreate" 
				  method="post" >
				<input class="input-visible" type="text" name="Item[name]" placeholder="Enter your item..." autofocus="autofocus">
				<?php //echo CHtml::dropDownList('Item[type_id]', $select, $note->Type); ?>
				
<!--			<input type="text" class="form-control" name="Item[type_id]" placeholder="Enter your type...">-->
				<input type="hidden" name="Item[note_id]" value="<?php echo $note->id ?>">
				<button type="submit" class="addBtn">Add</button>
			</form>
		</div>

		<div id="ajax-container">
			<?php echo $note->renderItemsList(); ?>
		</div>
	</div>

	
</section>