$( document ).ready(function(){
	var body = $('body').attr('id');
	if (body == "studeboard") {
		console.log('eboard');
		loadEboard('main-board');
	}
}); //document.ready