<?php
/* @var $this NoteController */
/* @var $items Item[] */
/* @var $note Note */
?>

<style>
	#add-picture {
		position: absolute;
		top: 133px;
		right: 28%;
		color: #000;
		padding: 11px 14px;		
	}

</style>
	

<section class="items" id="items">
	
	<div class="items-body">
		
		<div class="header">
			<h2 class="text-center"><?php echo $note->title ?></h2>
			<div id="form-error"></div>
			<div style="height: 42px">
				<form class="ajax-form" 
					  data-error-target="#form-error" 
					  data-target="#ajax-container" 
					  action="<?php echo Yii::app()->request->baseUrl ?>/item/ajaxCreate" 
					  method="post" >
					<input class="input-visible" 
						   type="text" 
						   name="Item[name]" 
						   placeholder="Enter your item..." 
						   autofocus="autofocus" 
						   autocomplete="off">
					<input type="hidden" 
						   name="Item[note_id]" 
						   value="<?php echo $note->id ?>">
					<button type="submit" class="addBtn">Add</button>
				</form>
			</div>
			<a href="#" id="add-picture"><i class="fa fa-camera" aria-hidden="true"></i></a>
			<p class="small">Double space to enter quantity of purchase</p>
		</div>

		<div id="ajax-container">
			<?php echo $note->renderItemsList(); ?>
		</div>
	</div>

	
</section>