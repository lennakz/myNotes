/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function() {

	$('.ajax-form').submit(function() {
		var $form = $(this);
		
		$.ajax({
			url: $form.attr('action'),
			method: $form.attr('method'),
			data: $form.serialize()
		}).done(function(html) {
			console.log(html)
			var id = $form.data('target');
			var $target = $(id);
			$target.html(html);
			console.log(id, $form, $target);
		}).fail(function( jqXHR, textStatus, errorThrown ) {
			console.log(textStatus);
		});
		
		
		return false;
	});
	
});