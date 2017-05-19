<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<style>
.modal-button {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
	margin-left: 15px;
	padding: 5px;
}

.model-button:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 9; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image */
.caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation */
.modal-content, .caption {    
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

</style>

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
			data-link2="<?php echo Yii::app()->request->baseUrl ?>/item/ajaxExclamationUpdate/<?php echo $m->id ?>"
			data-target="#ajax-container" >
				<!-- Check/uncheck button -->
				<a href="javascript:void(0)" id="item-check" class="pull-left"><?php if ($m->completed == 0): ?><i class="fa fa-square-o" aria-hidden="true"></i><?php else: ?><i class="fa fa-check-square-o" aria-hidden="true"></i><?php endif ?></a>
				<!-- Item text itself -->
				<div id="item-text"><?php echo ucwords($m->name) ?></div>
				<?php if (!empty($m->image)): ?>
					<a id="image-button" data-toggle="collapse" data-target="#image<?php echo $m->id ?>"><span class="glyphicon glyphicon-picture"></span></a>
					<!-- Show images -->
					<div id="image<?php echo $m->id ?>" class="collapse image-content">
						<?php //foreach ($m->image as $image): ?>
							<a href="#"><img id="myImg<?php echo $m->id ?>" class="modal-button" width="50" height="50" src="<?php echo Yii::app()->request->baseUrl.'/'.$m->image?>" alt="<?php echo $m->name ?>"></a>
						<?php //endforeach ?>	
					</div>
				<?php endif; ?>
				<!-- On double space show quantity separated -->
				<span class="items-quantity"><?php echo $m->quantity ?></span>
				<!-- Delete item button -->
				<a data-target="#ajax-container"
				   class="hidden-xs"
				   href="<?php echo Yii::app()->request->baseUrl ?>/item/delete/<?php echo $m->id ?>?ajax" 
				   id="button-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
		</li>
		<?php if (!empty($m->image)): ?>
			<!-- The Modal -->
			<div id="myModal<?php echo $m->id ?>" class="modal">
				<span class="close">&times;</span>
				<img class="modal-content" id="img<?php echo $m->id ?>">
				<div id="caption<?php echo $m->id ?>" class="caption"></div>
			</div>
			<script>
				$('#myImg<?php echo $m->id ?>').on('click', function() {
					$('#myModal<?php echo $m->id ?>').css('display', 'block');
					$('#img<?php echo $m->id ?>').attr('src', $(this).attr('src'));
					$('#caption<?php echo $m->id ?>').html($(this).attr('alt'));
				});

				$('.close').on('click', function() {
					$('#myModal<?php echo $m->id ?>').css('display', 'none');
				});
			</script>
		<?php endif; ?>
	<?php endforeach; ?>
</ul>



<script>
	// Swipe left each items
	$(function() {
		var a2 = Swiped.init({
			query: '.list #item',
			right: 180
		});
	});
</script>