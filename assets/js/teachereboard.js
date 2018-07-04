$( document ).ready(function(){
	var body = $('body').attr('id');
	if (body == "teacheboard") {
		console.log('eboard');
		loadEboard('teacherboard');
	}
}); //document.ready