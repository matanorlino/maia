var qCodeToSave;
$( document ).ready(function(){
	// swal("hello	!_!");
	/**********Login Page***********/
	var qCode;
	var qName;
	if($('#ansKeyList').hasClass('ansKeyList') == true){
		loadQuiz();				
	}
	
	$('#btn-login').click(function(){
		var data = [ $('#username').val(), $('#password').val()];
		validateUser(data);
	});

	$('#btn_register').click(function() {
		var data = [
			$('#fname').val(),
			$('#mname').val(),
			$('#lname').val(),
			$('#reg_username').val(),
			$('#reg_password').val(),
			$('#reg_cpassword').val()
		];
		// console.log(data);
		validateRegister(data);
	});
	/**********Login Page***********/

	/**********Quiz Page***********/
		$('#btn-quiz').click(function(){
		});
		
		$('#btn-quizCode').click(function(){
			qCode = $('#txt-quizCode').val().trim();
			qName = $('#txt-quizName').val().trim();
			$('#ans_head').html('<i class="fa fa-edit"/>');
			$('#ans_head').append(' Create Answer Key');
			
			if (qName == null || qName == ""){
				swal("Invalid", "Please enter your quiz name.", "warning");	
			}
			else if(qCode == null || qCode == ""){
				swal("Invalid", "Please enter your quiz code. This is for the reference of the students.", "warning");
			}
			else {
				validateQCode(qCode);

			}
		});

		$('#addQuizItem').click(function() {
			var rowCounts = document.getElementById("finalanswerkey").getElementsByTagName("tr").length;
			$('#finalanswerkey').append('<tr id="tr-'+ (rowCounts + 1) +'">' + 
					'<td class="txt-center" id="ctr-'+ (rowCounts + 1) +'">'+ (rowCounts + 1) +'</td>' + 
					'<td><select class="form-control select2" id="fa'+ (rowCounts + 1) +'">' +  
					'<option selected disabled="true"></option>' +
					'<option value="A">A</option>' +
					'<option value="B">B</option>' +
					'<option value="C">C</option>' +
					'<option value="D">D</option>' +
					'<option value="True">True</option>' +
					'<option value="False">False</option></td>' +
					'<td> <a class="btn btn-danger" id="btn-del-'+ (rowCounts + 1) +'" onClick="removeItem(this.id)"><i class="fa fa-trash"></i></a></td>' +
					'</tr>' +
					'<script type="text/javascript">$(".select2").select2();</script>'
					);
		});

		$('#saveQuiz').click(function() {
			var rowCounts = document.getElementById("finalanswerkey").getElementsByTagName("tr").length;
			let ansArr = new Array;
			for (var i = 1; i <= rowCounts; i++) {
				var selectVal = "#fa" + i;
				if($(selectVal).val() == null || $(selectVal).val() == ""){
					swal("No answer", "Item # " + i + " has no answer.", "warning");
				}
				else {
					ansArr.push($(selectVal).val());
				}
			}

			if (ansArr.length == rowCounts) {
				var qDetail = [qName, qCode];
				insertNewQuiz(qDetail, ansArr);
			}
		});
		$(".tbl-answerkey").on('click', '#btn-cancel-edit', function () {
			location.reload();
		});

		$(".tbl-answerkey").on('click', '#btn-save-edit', function () {
			var rowCounts = document.getElementById("finalanswerkey").getElementsByTagName("tr").length;
			let ansArr = new Array;
			for (var i = 1; i <= rowCounts; i++) {
				var selectVal = "#fa" + i;
				if($(selectVal).val() == null || $(selectVal).val() == ""){
					swal("No answer", "Item # " + i + " has no answer.", "warning");
				}
				else {
					ansArr.push($(selectVal).val());
				}
			}
			updateQuiz(qCodeToSave, ansArr);
		});
	/**********Quiz Page***********/
}); //document.ready


/**********Login Page***********/
function validateUser(x){
	$.ajax({
		type: "POST",
		url: url + "teacher/validate_user",
		dataType: "json",
		data: {x: x},
		cache: false,

		beforeSend: function() {},
		success: function(msg) {
			if (msg.status == true) {
				window.location.replace(url + 'teacher/dashboard');
			}
			
		},
		error: function(xhr, ajaxOptions, thrownError) { swal("Oops", thrownError, "error"); }
	});
}

function validateRegister(x){
	$.ajax({
		type: "POST",
		url: url + "teacher/register",
		dataType: "json",
		data: {x: x},
		cache: false,

		beforeSend: function() {},
		success: function(msg) {
			
		},
		error: function(xhr, ajaxOptions, thrownError) { swal("Oops", thrownError, "error"); }
	});	
}
/**********Login Page***********/

/**********Quiz Page***********/
function validateQCode(x){
	$.ajax({
		type: "POST",
		url: url + "teacher/validateQCode",
		dataType: "json",
		data: {x: x},
		cache: false,

		beforeSend: function() {},
		success: function(msg) {
			if (msg == "duplicate") {
				swal("Duplicate", "Quiz code '" + x +"' is already existing", "warning");
				
			}else if (msg == "no-duplicate"){
				$('#btn-quizCode').hide();
				$('.tbl-answerkey').show();
				$('.button-quiz').show();
				$('.txt-quiz').prop('disabled', true);

				$('#finalanswerkey').append('<tr id="tr-1">' + 
					'<td class="txt-center" id="ctr-1">1</td>' + 
					'<td><select class="form-control select2" id="fa1">' +  
					'<option selected disabled="true"></option>' +
					'<option value="A">A</option>' +
					'<option value="B">B</option>' +
					'<option value="C">C</option>' +
					'<option value="D">D</option>' +
					'<option value="True">True</option>' +
					'<option value="False">False</option></td>' +
					'<td> <a class="btn btn-danger" id="btn-del-1" onClick="removeItem(this.id)"><i class="fa fa-trash"></i></a></td>' +
					'</tr>' +
					'<script type="text/javascript">$(".select2").select2();</script>'
					);

			}else{
				// console.log(msg);
				swal("Oops", "error", "error");
			}
		},
		error: function(xhr, ajaxOptions, thrownError) { swal("Oops", thrownError, "error"); }
	});	
}
function insertNewQuiz(quizDetails, quizAnswers){
	$.ajax({
		type: "POST",
		url: url + "teacher/insertQuiz",
		dataType: "json",
		data: {
			x: quizDetails,
			y: quizAnswers
		},
		cache: false,

		beforeSend: function() {},
		success: function(msg) {
			if (msg == "1") {
				swal({
					title: "Success",
					text: "New quiz has been created!",
					type: "success",
				}, 
				function(){
					location.reload();
				});
			}
		},
		error: function(xhr, ajaxOptions, thrownError) { swal("Oops", thrownError, "error"); }
	});	
}

function loadQuiz(){
	$('#ansKeyList').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax":{
	    	"url": url + "teacher/loadquizzes",
	    	"type": "POST"
	    },
    	"columns": [
	          { "data": "quiz_name" },
	          { "data": "quiz_code" },
	          { "data": "date_created" },
	          { "data": "action"}
      	],
      	"columnDefs": [
        { 
            "targets": [ -1 ],
            "orderable": false,
        },
        ],

	});
}

function deleteQuiz(code){
	swal({
		title: "Are you sure?",
		text: "Delete quiz with a code " + code + "?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, confirm it!",
		closeOnConfirm: false
	}, 
	function(isConfirm){
		if (!isConfirm) return;
		$.ajax({
			url : url + 'teacher/deleteQuiz',
			type: "POST",
			data: {x: code.trim()},
			dataType: "JSON",
			success: function(data)
			{
				console.log(data);
				if (data == "1") {
					swal({
						title: "Success",
						text: code + " is successfully deleted!",
						type: "success",
					}, 
					function(){
						location.reload();
					});
				}
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				swal("Error!", "Please try again", "error");
			}
		});
	});
		
}

function showModal(code){
	$.ajax({
		url : url + 'teacher/getQuizByCode',
		type: "POST",
		data: {x: code.trim()},
		dataType: "JSON",
		success: function(msg)
		{
			if (msg.status == "1") {
				console.log(msg);
				$("#qzname, #qzcode, #dcreated, .modal-body").html('');
				$("#qzname").html('Quiz Name: ' + msg.data[0]);
				$("#qzcode").html('Quiz Code: ' + msg.data[1]);
				$("#dcreated").html(msg.data[3]);
				for (var i = 0; i < msg.data[2].length; i++) {
					$('.modal-body').append('<p><label>'+ (i + 1)+'. </label><span> '+msg.data[2][i]+'</span></p>');	
				}
				$('#quiz-mod').modal('show');
			}else{
				swal("Oops", "Error", "error");
			}
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			swal("Error!", "Please try again", "error");
		}
	});
}

function editQuiz(code){
	$.ajax({
		url : url + 'teacher/getQuizByCode',
		type: "POST",
		data: {x: code.trim()},
		dataType: "JSON",
		success: function(msg)
		{
			console.log(msg);
			if (msg.status == "1") {
				qCodeToSave = msg.data[1];
				$('#ans_head').html('<i class="fa fa-edit"/>');
				$('#finalanswerkey').html('');
				$('#ans_head').append(' Edit Answer Key');
				$('#btn-quizCode').hide();

				$('#txt-quizName').val(msg.data[0]);
				$('#txt-quizName').prop('disabled', true);
				$('#txt-quizCode').val(msg.data[1]);
				$('#txt-quizCode').prop('disabled', true);

				$('#btn-cancel-edit, #btn-save-edit').remove();
				$('.tbl-answerkey').show();

				for (var i = 0; i < msg.data[2].length; i++) {
					var id = "fa" + (i + 1);
					$('#finalanswerkey').append('<tr>' + 
					'<td class="txt-center">'+ (i + 1) +'</td>' + 
					'<td><select class="form-control select2" id="'+id+'">' +  
					'<option selected disabled="true"></option>' +
					'<option value="A">A</option>' +
					'<option value="B">B</option>' +
					'<option value="C">C</option>' +
					'<option value="D">D</option>' +
					'<option value="True">True</option>' +
					'<option value="False">False</option></td>' +
					'<td> <a class="btn btn-danger" id="btn-del-'+ (msg.data[2].length + 1) +'" onClick="removeItem(this.id)"><i class="fa fa-trash"></i></a></td>' +
					'</tr>' +
					'<script type="text/javascript">$(".select2").select2();</script>'
					);	
					$("#" + id).val(msg.data[2][i]).change();
				}
				$('.tbl-answerkey').append('<input type="submit" class="btn btn-danger" value="Cancel" id="btn-cancel-edit">' + 
					'<input type="submit" class="btn btn-success" value="Save" id="btn-save-edit">');
			}
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			swal("Error!", "Please try again", "error");
		}
	});
}

function updateQuiz(code, answer){
	$.ajax({
		url : url + 'teacher/updateQuiz',
		type: "POST",
		data: {
			x: code.trim(),
			y: answer
		},
		dataType: "JSON",
		success: function(msg)
		{
			if(msg == true){
				swal({
					title: "Success!",
					text: code + " is successfully updated!",
					type: "success",
				}, 
				function(){
					location.reload();
				});
			}
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			swal("Error!", "Please try again", "error");
		}
	});
}

function removeItem(id){
	swal({
		title: "Are you sure?",
		text: "Delete quiz item?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, confirm it!",
		closeOnConfirm: true
	}, 
	function(isConfirm){
		if (!isConfirm) return;
		
		data = id.split('-');
		idToRemove = "#tr-" + data[2];
		$(idToRemove).remove();

		var rows = $("#finalanswerkey tr");
		
		for (var i = 0; i < rows.length; i++) {
			var x = $(rows).find('tr').each();
			x.prevObject[i].id = "tr-" + (i + 1);
		}

		for (var i = 1; i <= rows.length; i++) {
			var trId = "#tr-" + (i);
			var tdId = "#ctr-" + (i);

			$(trId).children()[0].id = "ctr-" + i;
			$(trId).children()[0].innerHTML = i;
			$(trId).children()[2].lastChild.id = "btn-del-" + i;
			$(tdId).change();


			// console.log($(trId).children());
		}
	});
}
/**********Quiz Page***********/