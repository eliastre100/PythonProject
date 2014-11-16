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

function loadStep(num){

	var url = document.getElementById('step' + num).value;
	var place = parseInt(num)+1;
	alert(url);
	$.get(url, {}, function(data){
		$('#modal' + place).empty().append(data); 
	});
}