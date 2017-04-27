/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function() {

	// Adding new items to the list throught ajax
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
				$('.ajax-form .input-visible').val('');
			}
		}).fail(function( jqXHR, textStatus, errorThrown ) {
			console.log(textStatus);
		});
		
		return false;
	});
	
	// Delete items when clicked delete-button throught ajax
	$('body').on('click', '.button-delete', function() {
		var $link = $(this);	
		$.ajax({
			url: $link.attr('href'),
			method: 'POST'
		}).done(function(response) {
			var target = $link.data('target');
			$(target).html(response);
		});
		return false;
	});
	
	// Add a "checked" symbol when clicking on a list item
	$('body').on('click', '#item', function() {
		var $item = $(this);
		$.ajax({
			url: $item.attr('data-link')
		}).done(function(response) {
			console.log(response);
			var target = $item.data('target');
			$(target).html(response);
		});
		
		return false;
	});
	
	$('#menu-button').on('click', function() {
		$(this).toggleClass('change');
		if ($('#mySidenav').width() === 0)
			$('#mySidenav').css('width', '100%');
		else
			$('#mySidenav').css('width', '0');
	});

});
