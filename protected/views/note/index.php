<?php
/* @var $this NoteController */
/* @var $p['notes'] */

$this->breadcrumbs=array(
	'Notes',
);
?>

<section class="notes" id="notes">

	
	<?php foreach ($notes as $m): ?>
		<button onclick="overlayOn(<?php echo $m->id; ?>)" id="info-button" class="pull-left"><i class="fa fa-info" aria-hidden="true"></i></button>
		<a href="<?php echo Yii::app()->request->baseUrl . '/note/items/' . $m->id ?>">
			<h3><?php echo $m->title ?><span class="small pull-right"><?php echo $m->numberOfCompletedItems . ' / ' . $m->numberOfItems ?></span></h3>
		</a>
		<hr>
		
		<div onclick="overlayOff(<?php echo $m->id; ?>)" id="overlay" data-overlay="<?php echo $m->id; ?>">
			<div id="overlay-text">
				<h2><?php echo $m->title ?></h2>
				<p><i><?php echo date('d/m/Y', $m->updated) ?> </i></p>
				<hr>
				<p><?php echo $m->description ?></p>
			</div>
		</div>
	<?php endforeach; ?>
	
	<div class="button-background">
		<a href="<?php echo Yii::app()->request->baseUrl ?>/note/create/" class="button-round"><span>+</span></a>
	</div>
		
</section>

<script>
	// Overlay effect on note/index for information
	function overlayOn(id) {
		$('#overlay[data-overlay="' + id + '"]').css('display', 'block');
	}
	function overlayOff(id) {
		$('#overlay[data-overlay="' + id + '"]').css('display', 'none');
	}
</script>