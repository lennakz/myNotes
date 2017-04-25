<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<ul id="myUL">
	<?php foreach ($items as $m): ?>
		<li><?php echo $m->name ?></li>
	<?php endforeach; ?>
</ul>