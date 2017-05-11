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
			   href="<?php echo Yii::app()->request->baseUrl ?>/item/delete/<?php echo $m->id ?>?ajax" 
			   id="button-danger"><i class="fa fa-exclamation" aria-hidden="true"></i></a>
			<a data-target="#ajax-container" 
			   href="<?php echo Yii::app()->request->baseUrl ?>/item/delete/<?php echo $m->id ?>?ajax" 
			   id="button-notice"><i class="fa fa-pencil" aria-hidden="true"></i></a>
			<a data-target="#ajax-container"
			   class="visible-xs-block"
			   href="<?php echo Yii::app()->request->baseUrl ?>/item/delete/<?php echo $m->id ?>?ajax" 
			   id="button-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
		</li>
		<li	id="item"
			class="<?php if ($m->completed == 0) echo 'unchecked'; else echo 'checked'; ?>"
			data-link="<?php echo Yii::app()->request->baseUrl ?>/item/ajaxCompleteUpdate/<?php echo $m->id ?>"
			data-target="#ajax-container" >
				<!-- Check/uncheck button -->
				<a href="javascript:void(0)" id="item-check"><?php if ($m->completed == 0): ?><i class="fa fa-square-o" aria-hidden="true"></i><?php else: ?><i class="fa fa-check-square-o" aria-hidden="true"></i><?php endif ?></a>
				<!-- Item text itself -->
				<?php echo ucwords($m->name) ?>
				<!-- On double space show quantity separated -->
				<span class="items-quantity"><?php echo $m->quantity ?></span>
				<!-- Delete item button -->
				<a data-target="#ajax-container"
				   class="hidden-xs"
				   href="<?php echo Yii::app()->request->baseUrl ?>/item/delete/<?php echo $m->id ?>?ajax" 
				   id="button-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
		</li>
	<?php endforeach; ?>
</ul>

<script>
	$(function() {
		var a2 = Swiped.init({
			query: '.list #item',
			right: 135
		});
	});

</script>