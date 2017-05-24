/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function() {

	// Adding new items to the list throught ajax
	$('.ajax-form').submit(function() {
		var $form = $(this);
		var formdata = false;
		if (window.FormData){
			formdata = new FormData($form[0]);
		}
		$.ajax({
			url: $form.attr('action'),
			method: $form.attr('method'),
			data: formdata ? formdata : $form.serialize(),
			contentType : false,
			processData : false,
			dataType: 'json'
		}).done(function(response) {
			if (response.status === 'error') {
				var target = $form.data('error-target');
				$(target).html(response.errors.name[0]);
				$(target).addClass('alert alert-danger');
			}
			else {
				var target = $form.data('target');
				$(target).html(response.html);
				$($form.data('error-target')).text('');
				$($form.data('error-target')).removeClass('alert alert-danger');
				$('.ajax-form .input-visible').val('');
			}
			$('#add-picture-form').val('');
			$('#file-name').html('');
			$('#picture-loaded').html('0');
		}).fail(function( jqXHR, textStatus, errorThrown ) {
			console.log(jqXHR);
			console.log(textStatus);
			console.log(errorThrown);
		});
		
		return false;
	});
	
	// Delete items when clicked delete-button throught ajax
	$('body').on('click', '#button-delete', function() {
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
	$('body').on('click', '#item-check', function() {
		var $item = $(this).parent();
		$.ajax({
			url: $item.attr('data-link')
		}).done(function(response) {
			var target = $item.data('target');
			$(target).html(response);
		});
		
		return false;
	});
	
	// Add a "exclamation" background when clicking on a exclamation button
	$('body').on('click', '#button-exclamation', function() {
		var $item = $(this).parent().next();
		$.ajax({
			url: $item.attr('data-add-exclamation')
		}).done(function(response) {
			var target = $item.data('target');
			$(target).html(response);
		});
		
		return false;
	});
	
	// Add a new picture to database
	$('body').on('click', '#add-file-button', function() {
		$('#hidden-add-file').trigger('click');
		
		$('#hidden-add-file').change(function(e) {
			$('#hidden-add-image').val('');

			var file = e.target.files[0];
			
			canvasResize(file, {
				width: 500,
				height: 0,
				crop: false,
				quality: 90,
				//rotate: 90,
				callback: function(data, width, height) {
					$('#hidden-add-file').val('');
					$('#hidden-add-image').val(data);
				}
			});
			$('#hidden-add-form').trigger('submit');
		});
			
		$('#hidden-add-form').submit(function() {
			var $form = $(this);
			var formdata = false;
			if (window.FormData){
				formdata = new FormData($form[0]);
			}
			$.ajax({
				url: $form.attr('action'),
				method: $form.attr('method'),
				data: formdata ? formdata : $form.serialize(),
				contentType : false,
				processData : false
			}).done(function(response) {
				var target = $form.data('target');
				$(target).html(response);
			});

		return false;

		});
		
	});
	
	// Show and hide navigation menu for mobile
	$('#menu-button').on('click', function() {
		$(this).toggleClass('change');
		if ($('#mySidenav').width() === 0)
			$('#mySidenav').css('width', '100%');
		else
			$('#mySidenav').css('width', '0');
	});

});
