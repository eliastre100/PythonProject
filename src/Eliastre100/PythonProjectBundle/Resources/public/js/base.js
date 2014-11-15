//List load
$(document).on("click", ".AjaxLoad", function (event){
	event.preventDefault();
	$.get($(this).attr('href'), {}, function(data){
		$('section').empty().append(data); 
	});
	return false;
});

//Actions Loads
function actionLoad(url){
	$.get(url, {}, function(data){
		$('.modal').empty().append(data); 
	});	
}
