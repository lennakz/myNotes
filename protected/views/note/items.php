<?php
/* @var $this NoteController */
/* @var $items Item[] */
/* @var $note Note */

$this->breadcrumbs=array(
	'Notes',
);
?>

<section class="items" id="items">
	
	<div class="items-header">
		
		<div class="row text-center">
			<h1 class="text-center"><?php echo $note->title ?></h1>
			<p class="text-center"><i><?php echo date('d/m/Y', $note->updated) ?></i></p>
		</div>
		
	</div>

	<div class="items-body">
		
		<div id="myDIV" class="header">
			<h2>My To Do List</h2>
			<form class="ajax-form" data-target="#ajax-container" action="<?php echo Yii::app()->request->baseUrl ?>/item/create" method="post">
				<input type="text" class="form-control" name="Item[name]" placeholder="Enter your item...">
				<input type="text" class="form-control" name="Item[type_id]" placeholder="Enter your type...">
				<input type="hidden" name="Item[note_id]" value="<?php echo $note->id ?>">
				<button type="submit" class="btn btn-primary">Add</button>
			</form>
<!--			<input type="text" id="myInput" placeholder="Enter your item...">
			<span onclick="newElement()" class="addBtn">Add</span>-->
		</div>

		<div id="ajax-container">
			<?php $note->renderItemsList(); ?>
		</div>
	</div>

	
</section>