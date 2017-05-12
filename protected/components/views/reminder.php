<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php if (!empty($returnYes)): ?>

	<div class="container">
		<div class="alert alert-danger alert-dismissable fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Reminder!</strong> You have something to remember.
			<a href="#demo" data-toggle="collapse">See more...</a>
			<div id="demo" class="collapse"><br>
				<ul>
					<?php foreach ($returnYes as $item): ?>
						<li><a href="<?php echo Yii::app()->request->baseUrl . '/item/update/' . $item->id ?>" class="alert-link"><?php echo $item->name ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>

<?php endif; ?>