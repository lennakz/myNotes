<?php
/* @var $this NoteController */
/* @var $p['notes'] */
?>

<section class="notes" id="notes">

	
	<?php foreach ($notes as $m): ?>
		<div class="note">
			<a href="javascript:void(0)" onclick="overlayOn(<?php echo $m->id; ?>)" id="info-button" class="pull-left"><i class="fa fa-info" aria-hidden="true"></i></a>
			<a class="pull-left" id="place-on-map-button" href=<?php echo Yii::app()->request->baseUrl . "/note/addmap/" . $m->id ?>><i class="fa fa-map-marker" aria-hidden="true"></i></a>
			<a class="pull-left" id="note-button" href="<?php echo Yii::app()->request->baseUrl . '/note/items/' . $m->id ?>">
				<h3><?php echo ucwords($m->title) ?></h3>
			</a>
			<span class="pull-right" style="margin-top: 6px"><?php echo $m->numberOfCompletedItems . ' / ' . $m->numberOfItems ?></span>
		</div>
		<hr>
		
		<div id="overlay" data-overlay="<?php echo $m->id; ?>">
			<div id="overlay-text">
				<h2><?php echo ucwords($m->title) . ' (User: ' . ucwords($m->User->fname) . ')' ?></h2>
				<hr>
				<p><?php echo ucfirst($m->description) ?></p>
				<?php if (!empty($m->description)) echo '<hr style="margin-bottom: 40px">' ?>
				<a href="javascript:void(0)" onclick="editNote(<?php echo $m->id; ?>)" id="edit-button" data-id="<?php echo $m->id ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> EDIT</a>
				<a href="<?php echo Yii::app()->request->baseUrl . '/note/delete/' . $m->id ?>" id="note-delete-button"><i class="fa fa-trash-o" aria-hidden="true"></i> DELETE</a>
				<form action="<?php echo Yii::app()->request->baseUrl ?>/note/update/<?php echo $m->id ?>" method="post" class="note-update-form" data-form="<?php echo $m->id; ?>">
					<input type="text" name="Note[title]" placeholder="Name..." autocomplete="off" value="<?php echo $m->title ?>">
					<input type="text" name="Note[description]" placeholder="Description..." style="height: 70px" autocomplete="off" value="<?php echo $m->description ?>">
					<input type="submit" value="Update" class="btn btn-success">
				</form>
			</div>
			<button onclick="overlayOff(<?php echo $m->id; ?>)" id="close-button">X</button>
		</div>
	<?php endforeach; ?>
	
	<div class="button-background">
		<a href="<?php echo Yii::app()->request->baseUrl ?>/note/create/" id="create-note-button" class="button-round"><span>+</span></a>
		<a href="<?php echo Yii::app()->request->baseUrl ?>/note/viewmap/" id="view-all-notes-map-button" class="button-round"><span>GM</span></a>
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
		$('#edit-button[data-id="' + id + '"]').text('');
		if ($('.note-update-form[data-form="'+ id + '"]').css('display') == 'none') {
			$('.note-update-form[data-form="'+ id + '"]').css('display', 'block');
			$('#edit-button[data-id="' + id + '"]').append('<i class="fa fa-times" aria-hidden="true"></i> CLOSE');
		}
		else {
			$('.note-update-form[data-form="'+ id + '"]').css('display', 'none');
			$('#edit-button[data-id="' + id + '"]').append('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> EDIT');
		}

	}

</script>