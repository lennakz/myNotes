<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php $this->beginContent('//layouts/main'); ?>

	<div class="container">

		<!-- Reminder -->
		<?php $this->widget('Reminder'); ?>
		
		<?php echo $content; ?>

	</div>

<?php $this->endContent(); ?>
