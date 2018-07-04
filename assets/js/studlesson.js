console.log('lessoncode js');
var lessonid;
$(document).ready(function(){
	$('#btn-lesson-code').click(function(){
		var lessoncode =  $('#stud_lesson_code');

		if (lessoncode.val().trim() == "" || lessoncode.val().trim() == null) {
			swal("Please enter the lesson code!", "", "warning");
			lessoncode.focus();
		} else{
			getId(lessoncode.val().trim());
		}
	});
}); //document.ready

function getId(code){
	$.ajax({
		url : url + 'student/getLessonId',
		type: "POST",
		data: {x: code},
		dataType: "JSON",
		success: function(msg){
			console.log(msg);
			if (msg.id != null) {
				lessonid = msg.id[0].rowID;
				window.location = url + "student/lesson/" + lessonid;
			} else{
				swal("Not Found!", "Please get the lesson code from your teacher!", "warning");
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			swal("Error!", "Please try again", "error");
		}
	});	
}
