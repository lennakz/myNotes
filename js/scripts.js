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
			data: $form.serialize(),
			dataType: 'json'
		}).done(function(response) {
			if (response.status === 'error') {
				var target = $form.data('error-target');
				$(target).html(response.errors.name[0]);
			}
			else {
				var target = $form.data('target');
				$(target).html(response.html);
			}
					
		}).fail(function( jqXHR, textStatus, errorThrown ) {
			console.log(textStatus);
		});

		return false;
	});
	
	$('body').on('click', '.button-delete', function() {
		if (confirm("Are you sure?") == true) {
			var $link = $(this);	
			$.ajax({
				url: $link.attr('href'),
				method: 'POST',
			}).done(function(response) {
				var target = $link.data('target');
				$(target).html(response);
				
			});
			
		}
		return false;
	})
	
});