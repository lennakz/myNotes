<?php
/* @var $this NoteController */
/* @var $items Item[] */
/* @var $note Note */
?>
<!-- For swipe left menu -->
<script src="<?php echo Yii::app()->request->baseUrl ?>/js/swiped.min.js"></script>

<!-- For resize image client-side -->
<script src="<?php echo Yii::app()->request->baseUrl ?>/js/canvasResize/exif.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl ?>/js/canvasResize/binaryajax.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl ?>/js/canvasResize/canvasResize.js"></script>

<style>
form {
	position: relative;
}
#add-picture {
	position: absolute;
	right: 27%;
	color: #000;
	padding: 11px 14px;
	text-decoration: none;
}

#add-picture:hover {
	color: blue;
	text-decoration: none;
}
#add-picture:visited, #add-picture:active {
	text-decoration: none;
}
#file-name {
	position: relative;
	top: 5px;
	left: 0;
}
#loading, #loading-item {
	display: none;
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
					  method="post"
					  enctype="multipart/form-data">
					<input class="input-visible" 
						   type="text" 
						   name="Item[name]" 
						   placeholder="Enter your item..." 
						   autofocus="autofocus" 
						   autocomplete="off">
					<input type="hidden" 
						   name="Item[note_id]" 
						   value="<?php echo $note->id ?>">
					<input id="add-picture-form"
						   type="file"
						   name="file" style="display: none">
					<input type="hidden" name="image-encoded" id="image-encoded">
					<button type="submit" class="addBtn"><span>Add</span><img width="20" height="20" id="loading" src="<?php echo Yii::app()->request->baseUrl ?>/images/loading.gif"></button>
				</form>
				<a href="#" id="add-picture"><i class="fa fa-camera" aria-hidden="true"></i>&nbsp;&nbsp;<span id="picture-loaded">0</span></a>
			</div>
			<span id="file-name"></span>
			<p class="small">Double space to enter quantity of purchase</p>
		</div>

		<div id="ajax-container">
			<?php echo $note->renderItemsList(); ?>
		</div>
	</div>
	
</section>

<script>
	$(function() {
		$('#add-picture').on('click', function() {
			$('#add-picture-form').trigger('click');
		});
		$('#add-picture-form').change(function(e) {
			//$('#file-name').html($(this).val().replace('C:\\fakepath\\', 'File name: '));
			$('#picture-loaded').html('1');
			$('#image-encoded').val('');

			var file = e.target.files[0];

			canvasResize(file, {
				width: 500,
				height: 0,
				crop: false,
				quality: 90,
				//rotate: 90,
				callback: function(data, width, height) {
					$('#add-picture-form').val('');
					$('#image-encoded').val(data);
				}
			});
		});
	});
</script>