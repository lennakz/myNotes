<?php
/* @var $this NoteController */
/* @var $p['notes'] */

$this->breadcrumbs=array(
	'Notes',
);
?>

<h1 class="text-center">Notes</h1>
<p class="text-center">Here are all your Notes</p>

<div class="row text-center">
	<?php foreach ($notes as $m): ?>
    <div class="col-sm-4">
		<a href="<?php echo Yii::app()->request->baseUrl . '/note/items/' . $m->id ?>">
			<div class="thumbnail">
				<h3><?php echo $m->title ?></h3>
				<p><i><?php echo date('d/m/Y', $m->updated) ?> </i></p>
				<hr>
				<p><?php echo $m->description ?></p>
				<p><?php echo $m->numberOfItems . ' (' . $m->percentComplete . '%)' ?></p>
			</div>
		</a>
    </div>
	<?php endforeach; ?>
</div>