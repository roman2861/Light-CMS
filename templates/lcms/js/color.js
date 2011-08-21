$(document).ready(function() {
	
	$('.changeHeaderColor').change(function() {
		
		setHeaderColor($(this).children(':selected').val());
		
	});
	
	$('.changeProgressBarColor').change(function() {
		setProgressFillColor($(this).children(':selected').val())
	});
	
});