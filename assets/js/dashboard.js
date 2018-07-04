$( document ).ready(function(){
	var body = $('body').attr('id');
	if (body == "dashboard") {
		console.log("dashboard");
		
		allCount();
	}
});

function allCount(){
	$.ajax({
		url : url + 'teacher/allCount',
		type: "POST",
		dataType: "JSON",
		success: function(msg){
			console.log(msg);
			$('.count').html('');
			$('#totsubj').html(msg.data.module);
			$('#totlesson').html(msg.data.lesson);
		},
		error: function (jqXHR, textStatus, errorThrown){
			swal("Error!", "Please try again", "error");
		}
	});	
}