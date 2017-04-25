<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<ul id="myUL">
	<?php foreach ($items as $m): ?>
		<li><?php echo $m->name ?> - <?php echo $m->type_id ?>
			<a data-target="#ajax-container" href="<?php echo Yii::app()->request->baseUrl ?>/item/delete/<?php echo $m->id ?>?ajax" class="btn button-delete btn-danger pull-right">Delete</a>
		</li>
		
	<?php endforeach; ?>
</ul>