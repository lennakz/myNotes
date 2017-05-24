<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<ul class="list">
	<?php foreach ($items as $m): ?>
		<!-- Swipeleft additional buttons -->
		<li class="hidden-buttons">
			<a data-target="#ajax-container" 
			   href="javascript:void(0)" 
			   id="button-exclamation"><i class="fa fa-exclamation" aria-hidden="true"></i></a>
			<a href="<?php echo Yii::app()->request->baseUrl ?>/item/update/<?php echo $m->id ?>" 
			   id="button-edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
			<a data-target="#ajax-container"
			   class="visible-xs-block"
			   href="<?php echo Yii::app()->request->baseUrl ?>/item/delete/<?php echo $m->id ?>?ajax" 
			   id="button-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
		</li>
		<li	id="item"
			class="<?php if ($m->completed == 0) echo 'unchecked'; else echo 'checked'; if ($m->exclamation == 1) echo ' exclamation'; ?>"
			data-link="<?php echo Yii::app()->request->baseUrl ?>/item/ajaxCompleteUpdate/<?php echo $m->id ?>"
			data-add-exclamation="<?php echo Yii::app()->request->baseUrl ?>/item/ajaxExclamationUpdate/<?php echo $m->id ?>"
			data-target="#ajax-container" >
				<!-- Check/uncheck button -->
				<a href="javascript:void(0)" id="item-check" class="pull-left"><?php if ($m->completed == 0): ?><i class="fa fa-square-o" aria-hidden="true"></i><?php else: ?><i class="fa fa-check-square-o" aria-hidden="true"></i><?php endif ?></a>
				<!-- Item text itself -->
				<div id="item-text"><?php echo ucwords($m->name) ?></div>
				<?php if (!empty($m->file)): ?>
					<a class="image-button" id="image-button" data-toggle="collapse" data-target=".image<?php echo $m->id ?>"><span class="glyphicon glyphicon-picture"></span></a>
					<!-- Show images -->
					<div class="image<?php echo $m->id ?> collapse image-content">
						<?php foreach ($m->file as $key => $file): ?>
							<?php if (strpos($file, '.jpg') or strpos($file, '.png') or strpos($file, '.gif')): ?>
								<a class="image-modal-button modal-button" href="#"><img id="myImg<?php echo $m->id.'_'.$key ?>" width="50" height="50" src="<?php echo Yii::app()->request->baseUrl.'/'.$file?>" alt="<?php echo $m->name ?>"></a>
							<?php else: ?>
								<a class="file-download-button" href="<?php echo Yii::app()->request->baseUrl.'/'.$file ?>"><span class="glyphicon glyphicon-file"></span></a>
							<?php endif ?>
						<?php endforeach ?>
						<a id="add-file-button"
						   class="add-file-button"
						   data-id="<?php echo $m->id ?>"
						   href="javascript:void(0)">
							<span class="glyphicon glyphicon-plus"></span>
						</a>
					</div>
				<?php else: ?>
					<a class="image-button" id="add-file-button" data-id="<?php echo $m->id ?>"><span class="glyphicon glyphicon-plus"></span></a>
				<?php endif ?>
				<!-- On double space show quantity separated -->
				<span class="items-quantity"><?php echo $m->quantity ?></span>
				<!-- Delete item button -->
				<a data-target="#ajax-container"
				   class="hidden-xs"
				   href="<?php echo Yii::app()->request->baseUrl ?>/item/delete/<?php echo $m->id ?>?ajax" 
				   id="button-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
		</li>
		<?php if (!empty($m->file)): ?>  
			<!-- The Modals -->
			<?php foreach ($m->file as $key => $file): ?>
				<?php if (strpos($file, '.jpg') or strpos($file, '.png') or strpos($file, '.gif')): ?>
					<div id="myModal<?php echo $m->id.'_'.$key ?>" class="modal">
						<span class="close">&times;</span>
						<img class="modal-content" id="img<?php echo $m->id.'_'.$key ?>">
						<div id="caption<?php echo $m->id.'_'.$key ?>" class="caption"></div>
					</div>
					<script>
						$('#myImg<?php echo $m->id.'_'.$key ?>').on('click', function() {
							$('#myModal<?php echo $m->id.'_'.$key ?>').css('display', 'block');
							$('#img<?php echo $m->id.'_'.$key ?>').attr('src', $(this).attr('src'));
							$('#caption<?php echo $m->id.'_'.$key ?>').html($(this).attr('alt'));
						});

						$('.close').on('click', function() {
							$('#myModal<?php echo $m->id.'_'.$key ?>').css('display', 'none');
						});
					</script>
				<?php endif ?>
			<?php endforeach ?>
		<?php endif  ?>
	<?php endforeach; ?>
</ul>
<form style="display: none"
	data-target="#ajax-container"
	id="hidden-add-form"
	enctype="multipart/form-data"
	method="post">
  <input id="hidden-add-image" name="hidden-add-image" type="text">
  <input id="hidden-add-file" name="hidden-add-file" type="file">
</form>

<h6></h6>

<script>
	var baseUrl = "<?php echo Yii::app()->request->baseUrl ?>";
	// Swipe left each items
	$(function() {
		var a2 = Swiped.init({
			query: '.list #item',
			right: 180
		});
	});
</script>