var lesname = '';
$( document ).ready(function(){
	// $('.select2').select2();
	var body = $('body').attr('id');


	if (body == "alllesson" || body == "newlesson") {
		console.log('lessonjs');
		
		Dropzone.autoDiscover = false;
		var fileList = new Array;
		var i = 0;
		
		allActiveLesson();
		
		$('#btn-add-lesson').click(function(){
			if ($('#lesson-name').val().trim() == '') {
				swal('Empty!', "Lesson name cannot be empty.", "warning");
				$('#lesson-name').focus();
			}
			else if($('#lesson-desc').val().trim() == ''){
				swal('Empty!', "Lesson description cannot be empty.", "warning");
				$('#lesson-desc').focus();
			}
			else if($('#lesson-code').val().trim() == ''){
				swal('Empty!', "Lesson code cannot be empty.", "warning");
				$('#lesson-code').focus();	
			}
			else{
				var data = [ 
					$('#lesson-name').val().trim(),
					$('#lesson-desc').val().trim(),
					$('#lesson-img').val(),
					$('#lesson-code').val().trim()
				];
				lesname = $('#lesson-name').val().trim();
				createNewLesson(data);
			}
		});

		$('#btn-con-lesson').click(function	() {
			table = $('#tbl-all-lesson');
			var ctr = 0;
			arrModChecked = new Array();
			$('input:checked', table.get()).each(function(){
				arrModChecked.push($(this).val());
				ctr++;
			});
			if (ctr != 0) {
				conLessonToMod([lesname, arrModChecked]);
			}
		});

		$('#btn-con-mod').click(function (){
			$('.create-lesson').hide();
			$('.add-mod-to-lesson').show();

			$('.con-les-name').html('');
			$('.con-les-name').html(lesname);
			loadAllModule('#tbl-all-lesson');
		});
	}
});

function createNewLesson(data){
	$.ajax({
		url : url + 'teacher/createNewLesson',
		type: "POST",
		data: {x: data},
		dataType: "JSON",
		success: function(msg)
		{
			// console.log(msg);
			if (msg.status == 1) {
				$('#lesson-name, #lesson-desc, #lesson-img').prop('disabled', true);
				$('.dropzones, #btn-con-mod').show();
				$('.showfirst').hide();

				$('#dzppt').dropzone({
					addRemoveLinks: true,
					maxFilesize: 300,
					acceptedFiles: ".pdf",
					url: url + 'teacher/upload_ppt/' + data[0],
					init: function () {
						$(this.element).addClass("dropzone");
						this.on("removedfile", function(file) {
							$.ajax({
								url: url + 'teacher/removePpt/' + data[0],
								type: "POST",
								data: { "filename" : file.name }
							});
						});

						this.on("addedfile", function(file){
							var _i, _len;
							for (_i = 0, _len = this.files.length; _i < _len - 1; _i++){
								if(this.files[_i].name === file.name && this.files[_i].size === file.size && this.files[_i].lastModifiedDate.toString() === file.lastModifiedDate.toString()){
									this.removeFile(file);
								}
							}
						});
					}
				});

				$('#dzpdf').dropzone({
					addRemoveLinks: true,
				 	maxFilesize: 300,
					acceptedFiles: ".pdf",
					url: url + 'teacher/upload_pdf/' + data[0],
					init: function () {
						$(this.element).addClass("dropzone");
						this.on("removedfile", function(file) {
							$.ajax({
								url: url + 'teacher/removePdf/' + data[0],
								type: "POST",
								data: { "filename" : file.name }
							});
						});

						this.on("addedfile", function(file){
							var _i, _len;
							for (_i = 0, _len = this.files.length; _i < _len - 1; _i++){
								if(this.files[_i].name === file.name && this.files[_i].size === file.size && this.files[_i].lastModifiedDate.toString() === file.lastModifiedDate.toString()){
									this.removeFile(file);
								}
							}
						});
					},


				});	

				$('#dzvideo').dropzone({
					addRemoveLinks: true,
				 	maxFilesize: 500,
					acceptedFiles: "video/*",
					url: url + 'teacher/upload_video/' + data[0],
					init: function () {
						
						$(this.element).addClass("dropzone");
						this.on("removedfile", function(file) {
							$.ajax({
								url: url + 'teacher/removeVideo/' + data[0],
								type: "POST",
								data: { "filename" : file.name }
							});
						});

						this.on("addedfile", function(file){
							var _i, _len;
							for (_i = 0, _len = this.files.length; _i < _len - 1; _i++){
								if(this.files[_i].name === file.name && this.files[_i].size === file.size && this.files[_i].lastModifiedDate.toString() === file.lastModifiedDate.toString()){
									this.removeFile(file);
								}
							}
						});
					}
				});				
			}
			else if(msg.status == 2){
				swal("Duplicate!", msg.data, "warning");	
			}
			else if (msg.status == 3) {
				swal("Existing!", msg.data, "warning");
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log("newLesson " + errorThrown);
			swal("Error!", "Please try again", "error");
		}
	});
}

function loadAllModule(tablename){
	//tbl-allLesson
	$(tablename).DataTable({
        "processing": true,
        "serverSide": true,
        "ajax":{
	    	"url": url + "teacher/loadAllModules",
	    	"type": "POST"
	    },
    	"columns": [
	          { "data": "rowID" },
	          { "data": "mod_name" },
	          { "data": "mod_desc" }
      	],
	});
}

function conLessonToMod(data){
	$.ajax({
		url : url + 'teacher/conLessonToMod',
		type: "POST",
		data: {x: data},
		dataType: "JSON",
		success: function(msg)
		{
			if (msg.status == 1) {
				var texts;
				(data[1].length >= 2 ? texts = data[1].length + ' modules' : texts = ' a module')

				swal({
					title: "Success!",
					text: "Success connecting " + texts,
					type: "success"
				}, function(){
					location.reload();
				});
			}else{
				swal({
					title: "Error!",
					text: "Error connecting module to lesson, " + data[0],
					type: "error"
				}, function(){
					location.reload();
				});
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log("con les mod " + errorThrown);
			swal("Error!", "Please try again", "error");
		}
	});
}

function allActiveLesson(){
	$.ajax({
		url : url + 'teacher/allActiveLesson',
		type: "POST",
		dataType: "JSON",
		success: function(msg)
		{
			if (msg.data != null) {
				$('#all-less').html('');
				if (msg.status == 1) {
					for (var i = 0; i < msg.data.length; i++) {
						$('#all-less').append('' +
							'<div class="col-md-55">'+
								'<div class="thumbnail">' +
									'<div class="image view view-first">' +	 
										'<img style="width: 100%; display: block;" src="'+ url + msg.data[i].path +'" alt="image not found" />' +
										'<div class="mask">' +
											'<a href="lesson/' + msg.data[i].id + '"><p>'+ msg.data[i].lessoncode +'</p></a>' +
											'<div class="tools tools-bottom">' +
												'<a href="editlesson/' + msg.data[i].id + '" id="'+ msg.data[i].id +'" ><i class="fa fa-pencil"></i></a> ' +
												'<a href="#" id="'+ msg.data[i].id +'" onClick="deleteLesson(this.id)"><i class="fa fa-times"></i></a>' + 
											'</div>' +
										'</div>' + 
									'</div>' +
									'<div class="caption">' +
										'<a href="lesson/' + msg.data[i].id + '" >' + 
											'<p><b>'+ msg.data[i].name +'</b></p>' + 
										'</a>' +
									'</div>' +
								'</div>' +
							'</div>'
						);
					}
				}
			}else{
				$('#all-less').html('');
				$('#all-less').html('0 lesson found');
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log("allmod " + errorThrown);
			swal("Error!", "Please try again", "error");
		}
	});
}

function deleteLesson(id){
	swal({
		title: "Are you sure?",
		text: "You want to delete this lesson?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, confirm it!",
		closeOnConfirm: true
	}, 
	function(isConfirm){
		if (!isConfirm) return;
		$.ajax({
			url : url + 'teacher/deleteLesson',
			type: "POST",
			data: {x: id},
			dataType: "JSON",
			success: function(msg)
			{
				if (msg.status == 1) {
					swal({
						title:"Success!", 
						text: msg.data, 
						type: "success"
					}, function() {
						location.reload();
					});
				}else{
					swal("Failed!", msg.data, "error");
				}
			},
			error: function (jqXHR, textStatus, errorThrown){
				console.log("delmod " + errorThrown);
				swal("Error!", "Please try again", "error");
			}
		});	
	});	
}