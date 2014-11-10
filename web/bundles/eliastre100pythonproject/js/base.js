$(document).on("click", ".AjaxLoad", function (event){
	event.preventDefault();
	$.get($(this).attr('href'), {}, function(data){
		$('section').empty().append(data); 
	});
	return false;
});