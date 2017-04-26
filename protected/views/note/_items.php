<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<ul>
	<?php foreach ($items as $m): ?>
		<li id="item" 
			class="<?php if ($m->completed == 0) echo 'unchecked'; else echo 'checked'; ?>"
			data-link="<?php echo Yii::app()->request->baseUrl ?>/item/ajaxCompleteUpdate/<?php echo $m->id ?>"
			data-target="#ajax-container" >
			<?php echo $m->name ?><?php if (!empty($m->type_id)) echo ' - ' . $m->Type->name ?>
			<a data-target="#ajax-container" 
			   href="<?php echo Yii::app()->request->baseUrl ?>/item/delete/<?php echo $m->id ?>?ajax" 
			   class="button-delete"><span class="close">&times;</span></a>
		</li>
	<?php endforeach; ?>
</ul>