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
		
		<div id="overlay" data-overlay="<?php echo $m->id; ?>">
			<div id="overlay-text">
				<h2><?php echo $m->title ?></h2>
				<p><i><?php echo date('d/m/Y', $m->updated) ?> </i></p>
				<hr>
				<p><?php echo $m->description ?></p>
				<button onclick="editNote(<?php echo $m->id; ?>)" id="edit-button" class="btn btn-default">Edit</button>
				<form action="<?php echo Yii::app()->request->baseUrl ?>/note/update/<?php echo $m->id ?>" method="post" class="note-update-form" data-form="<?php echo $m->id; ?>">
					<input type="text" name="Note[title]" placeholder="Name..." autocomplete="off">
					<input type="text" name="Note[description]" placeholder="Description..." style="height: 70px" autocomplete="off">
					<input type="submit" value="Update" class="btn btn-success" style="margin-right: 0">
				</form>
			</div>
			<button onclick="overlayOff(<?php echo $m->id; ?>)" id="close-button">X</button>
		</div>
	<?php endforeach; ?>
	
	<div class="button-background">
		<a href="<?php echo Yii::app()->request->baseUrl ?>/note/create/" class="button-round"><span>+</span></a>
	</div>
		
</section>

<script>
	// Overlay effect on note/index for information
	function overlayOn(id) {
		$('#overlay[data-overlay="' + id + '"]').css({'width': '100%'});
	}
	function overlayOff(id) {
		$('#overlay[data-overlay="' + id + '"]').css({'width': '0'});
		$('.note-update-form').css('display', 'none');
		$('#edit-button').text('Edit');
	}
	// Show and hide update form in overlay part
	function editNote(id) {
		if ($('.note-update-form[data-form="'+ id + '"]').css('display') == 'none') {
			$('.note-update-form[data-form="'+ id + '"]').css('display', 'block');
			$('#edit-button').text('Close');
		}
		else {
			$('.note-update-form[data-form="'+ id + '"]').css('display', 'none');
			$('#edit-button').text('Edit');
		}

	}

</script>