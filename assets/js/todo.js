$( document ).ready(function(){
	var body = $('body').attr('id');
	if (body == "todo" || body == "dashboard") {
		console.log('todojs');
		allToDo();
		toDoWithButton();

		$('#btn-todo').click(function() {
			var todo = $('#txt-todo');
			if (todo.val().trim() == "") {
				swal("Empty!", "Please enter your to do item.", "warning");
				todo.focus();
			}else{
				insertNewTodo(todo.val().trim());
			}
		});

		$('#btn-todo-save').click(function() {
			var todo = $('#txt-todo');
			if (todo.val().trim() == "") {
				swal("Empty!", "Please enter your to do item.", "warning");
				todo.focus();
			}else{
				saveToDo([$('#hid-id').val(), todo.val().trim()]);
			}
		});

		$('#todo_body, #to_do_dash').on('change', 'input[type="checkbox"]',function(){
			if($(this).is(':checked')){
				checkUncheck([$(this).attr('id'), 1]);
				// alert($(this).attr('id'));
			}else{
				checkUncheck([$(this).attr('id'), 0]);
			}

		});
	}
}); //document.ready

function allToDo(){
	$.ajax({
		url : url + 'teacher/allToDo',
		type: "POST",
		dataType: "JSON",
		success: function(msg)
		{
			var isChecked;
			if (msg.status == "1") {
				if (msg.data != null) {
					$('#to_do_dash').html('');
					for (var i = 0; i < msg.data.length; i++) {
						(msg.data[i].isChecked == 1 ? isChecked = 'checked' : isChecked = '')
						$(document).ready(function(){
							$('#to_do_dash').append('<li><p>'+
								'<input id="'+msg.data[i].rowID+'" type="checkbox" '+ isChecked +' class="flat"> '+ msg.data[i].todo_desc +
								'</p></li>'  );
						});
					}
					// $('input[type="checkbox"]').iCheck({
					// 	checkboxClass: 'icheckbox_flat-green'
					// });
				}
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			swal("Error!", "Please try again", "error");
		}
	});
}

function toDoWithButton(){
	$.ajax({
		url : url + 'teacher/allToDo',
		type: "POST",
		dataType: "JSON",
		success: function(msg)
		{
			var isChecked;
			// console.log(msg.data);
			if (msg.status == "1") {
				if (msg.data != null) {
					$('#todo_body').html('');
					for (var i = 0; i < msg.data.length; i++) {
						(msg.data[i].isChecked == 1 ? isChecked = 'checked' : isChecked = '')
						$(document).ready(function(){
							$('#todo_body').append('<tr>' + 
								'<td class="txt-center"><input id="'+msg.data[i].rowID+'" type="checkbox" '+ isChecked +' class="flat"> </td>' + 
								'<td class="txt-center">' + msg.data[i].todo_desc + '</td>' + 
								'<td class="txt-center"><a id="' + msg.data[i].rowID + '" onClick="deleteToDo(this.id)" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a>'+
								'<a id="' + msg.data[i].rowID + '" onClick="editToDo(this.id)" href="javascript:;" class="btn btn-warning"><i class="fa fa-pencil"></i></a></td>' +
								'</tr>');
							// $('input[type="checkbox"]').iCheck({
							// 	checkboxClass: 'icheckbox_flat-green'
							// });
						});
					}
				}
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			swal("Error!", "Please try again", "error");
		}
	});	
}


function insertNewTodo(todo){
	$.ajax({
	url : url + 'teacher/insertNewTodo',
	type: "POST",
	data: {x: todo},
	dataType: "JSON",
	success: function(msg)
	{
		console.log(msg);
		if (msg.status == "1") {
			swal("Duplicate", msg.data, "warning");
		}
		else if(msg.status == "2"){
			swal({
				title: "Success!",
				text: msg.data,
				type: "success",
			}, function (){
				$('#txt-todo').val('');
				toDoWithButton();
			});
		}
	},
	error: function (jqXHR, textStatus, errorThrown){
		swal("Error!", "Please try again", "error");
	}
});
}

function deleteToDo(todoID){
	$.ajax({
		url : url + 'teacher/deleteToDo',
		type: "POST",
		data: {x: todoID},
		dataType: "JSON",
		success: function(msg)
		{
			if (msg.status == 1) {
				swal({
					title: "Success!",
					text: msg.data,
					type: "success",
				}, function (){
					toDoWithButton();
				});
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			swal("Error!", "Please try again", "error");
		}
	});		
}

function editToDo(todoID){
	$.ajax({
		url : url + 'teacher/toDoById',
		type: "POST",
		data: {x: todoID},
		dataType: "JSON",
		success: function(msg)
		{
			console.log(msg);
			if (msg.status == '1') {
				$('#todo-title').html('');
				$('#todo-title').html('Edit To Do');
				$('#btn-todo').hide();
				$('#btn-todo-save').show();
				$('#txt-todo').val(msg.data[0].todo_desc);
				$('#hid-id').val(msg.data[0].rowID);
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			swal("Error!", "Please try again", "error");
		}
	});		
}

function saveToDo(data){
	$.ajax({
		url : url + 'teacher/saveTodo',
		type: "POST",
		data: {x: data},
		dataType: "JSON",
		success: function(msg)
		{
			console.log(msg);
			if (msg.status == '1') {
				swal({
					title: "Success!",
					text: msg.data,
					type: "success",
				}, function (){
					location.reload();
				});
			}
			else if (msg.status == "2"){
				swal({
					title: "Warning",
					text: msg.data,
					type: "warning",
				}, function (){
					$('#txt-todo').focus();
				});
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			swal("Error!", "Please try again", "error");
		}
	});		
}

function checkUncheck(data){
	$.ajax({
		url : url + 'teacher/checkUncheck',
		type: "POST",
		data: {x: data},
		dataType: "JSON",
		success: function(msg)
		{
			// allToDo();
			// toDoWithButton();
		},
		error: function (jqXHR, textStatus, errorThrown){
			swal("Error!", "Please try again", "error");
		}
	});
}
