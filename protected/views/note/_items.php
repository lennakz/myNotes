<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<style>
/*	.ui-listview > .ui-li-static {
		overflow: initial;
		-webkit-transition: -webkit-transform 300ms ease;
		-moz-transition: -moz-transform 300ms ease;
		-o-transition: -moz-transform 300ms ease;
		transition: transform 300ms ease;
	}
	ul span {
		float: right;
		padding: 21.5px 20px;
		z-index: -1;
		background-color: inherit;
		box-sizing: border-box;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
	}
	ul .on {
		background-image: url(https://dl.dropboxusercontent.com/u/43649999/icons/on.png);
		background-repeat: no-repeat;
		background-position: center;
	}
	ul .off {
		background-image: url(https://dl.dropboxusercontent.com/u/43649999/icons/off.png);
		background-repeat: no-repeat;
		background-position: center;
	}*/
</style>

<ul>
	<?php foreach ($items as $m): ?>
		<li	id="item"
			class="<?php if ($m->completed == 0) echo 'unchecked'; else echo 'checked'; ?>"
			data-link="<?php echo Yii::app()->request->baseUrl ?>/item/ajaxCompleteUpdate/<?php echo $m->id ?>"
			data-target="#ajax-container" >
			<a href="javascript:void(0)" class="item-check">
				<?php if ($m->completed == 0): ?> 
					<i class="fa fa-square-o" aria-hidden="true"></i>
				<?php else: ?>
					<i class="fa fa-check-square-o" aria-hidden="true"></i>
				<?php endif ?>
			</a>
			<?php echo ucwords($m->name) ?>
			<span class="items-quantity"><?php echo $m->quantity ?></span>
			<a data-target="#ajax-container" 
			   href="<?php echo Yii::app()->request->baseUrl ?>/item/delete/<?php echo $m->id ?>?ajax" 
			   class="button-delete"><span class="close">&times;</span></a>
		</li>
	<?php endforeach; ?>
</ul>

<script>
//	$(document).on("click", "ul span", function() {
//	  $(this).toggleClass("off on");
//	}).on("swipeleft", "ul li", function(e) {
//	  $(this).off("click");
//	  $(this).css({
//		transform: "translateX(-40px)"
//	  }).one("transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd", function() {
//		$(this).one("click", function() {
//		  $(this).css({
//			transform: "translateX(0)"
//		  });
//		});
//	  });
//	});
</script>