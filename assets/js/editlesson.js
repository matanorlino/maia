var lesname = '';
var lescode = ''
$( document ).ready(function(){
	// $('.select2').select2();
	var body = $('body').attr('id');
	if (body == "editlesson") {
		console.log('editlesson');
		var index = (url + 'teacher/editlesson/').length;
		var data = location.href.substring(index);
		specificLesson(data);

		Dropzone.autoDiscover = false;

		$('#btn-save-lesson').click(function(){
			//get the former name of lesson
			
			if ($('#edit-lesson-name').val().trim() == '') {
				swal('Empty!', "Lesson name cannot be empty.", "warning");
				$('#edit-lesson-name').focus();
			}
			else if($('#edit-lesson-desc').val().trim() == ''){
				swal('Empty!', "Lesson description cannot be empty.", "warning");
				$('#edit-lesson-desc').focus();
			}else{
				var data;
				if (lescode == $('#edit-lesson-code').val().trim()) {
					data = [ 
						$('.edit-les-name-head').html(),
						$('#edit-lesson-name').val().trim(),
						$('#edit-lesson-desc').val().trim(),
						$('#edit-lesson-img').val(),
					];
				} else {
					data = [ 
						$('.edit-les-name-head').html(),
						$('#edit-lesson-name').val().trim(),
						$('#edit-lesson-desc').val().trim(),
						$('#edit-lesson-img').val(),
						$('#edit-lesson-code').val().trim()
					];
				}
				lesname = $('#edit-lesson-name').val().trim();
				saveEdit(data);
			}
		});
	}
});

function specificLesson(data){
	$.ajax({
		url : url + 'teacher/specificLesson',
		type: "POST",
		data: {x: data},
		dataType: "JSON",
		success: function(msg)
		{
			// console.log(msg)
			var fileList = new Array;
			var i, j, k = 0;
			if (msg.data != null) {
				if (msg.status == 1) {
					$('.edit-les-name-head').html('');
					$('.edit-les-name-head').html(msg.data[0].name);
					$('#edit-id').val(msg.data[0].id);
					$('#edit-lesson-name').val(msg.data[0].name);
					$('#edit-lesson-desc').val(msg.data[0].desc);
					$('#edit-lesson-code').val(msg.data[0].code);
					lescode = msg.data[0].code;
					// console.log($('.edit-les-name-head').html());
					$("#edit-dzppt").dropzone({
						addRemoveLinks: true,
						acceptedFiles: ".pdf",
						url: url + 'teacher/upload_ppt/' + msg.data[0].name,
						init: function () {
							this.on("addedfile", function(file){
								var _i, _len;
								for (_i = 0, _len = this.files.length; _i < _len - 1; _i++){
									if(this.files[_i].name === file.name && this.files[_i].size === file.size && this.files[_i].lastModifiedDate.toString() === file.lastModifiedDate.toString()){
										this.removeFile(file);
									}
								}
							});
							var r = $.parseJSON(retrieve_ppt());
							var arr = $.map(r, function(el) { return el });
							if(arr != null && arr.length > 0){
								for (var i = 0; i < arr.length ; i++) {
									var mockFile = { name: arr[i].name, size: arr[i].size };
									this.options.addedfile.call(this, mockFile);

									mockFile.previewElement.classList.add('dz-success');
									mockFile.previewElement.classList.add('dz-complete');
								}
							}

							$(this.element).addClass("dropzone");
							

							this.on("success", function(file, serverFileName) {
								fileList[i] = {"serverFileName" : serverFileName, "fileName" : file.name,"fileId" : i };
								i++;
							});

							this.on("removedfile", function(file) {
								$.ajax({
									url: url + 'teacher/removePpt/' + msg.data[0].name,
									type: "POST",
									data: { "filename" : file.name }
								});
							});
						}
					});

					$("#edit-dzpdf").dropzone({
						addRemoveLinks: true,
						acceptedFiles: ".pdf",
						url: url + 'teacher/upload_pdf/' + msg.data[0].name,
						init: function () {
							this.on("addedfile", function(file){
								var _i, _len;
								for (_i = 0, _len = this.files.length; _i < _len - 1; _i++){
									if(this.files[_i].name === file.name && this.files[_i].size === file.size && this.files[_i].lastModifiedDate.toString() === file.lastModifiedDate.toString()){
										this.removeFile(file);
									}
								}
							});
							var r = $.parseJSON(retrieve_pdf());
							var arr = $.map(r, function(el) { return el });
							if(arr != null && arr.length > 0){
								for (var i = 0; i < arr.length ; i++) {
									var mockFile = { name: arr[i].name, size: arr[i].size };
									this.options.addedfile.call(this, mockFile);

									mockFile.previewElement.classList.add('dz-success');
									mockFile.previewElement.classList.add('dz-complete');
								}
							}

							$(this.element).addClass("dropzone");
							

							this.on("success", function(file, serverFileName) {
								fileList[i] = {"serverFileName" : serverFileName, "fileName" : file.name,"fileId" : i };
								i++;
							});

							this.on("removedfile", function(file) {
								$.ajax({
									url: url + 'teacher/removePdf/' + msg.data[0].name,
									type: "POST",
									data: { "filename" : file.name }
								});
							});
						}
					});

					$("#edit-dzvid").dropzone({
						addRemoveLinks: true,
						acceptedFiles: "video/*",
						url: url + 'teacher/upload_video/' + msg.data[0].name,
						init: function () {
							this.on("addedfile", function(file){
								var _i, _len;
								for (_i = 0, _len = this.files.length; _i < _len - 1; _i++){
									if(this.files[_i].name === file.name && this.files[_i].size === file.size && this.files[_i].lastModifiedDate.toString() === file.lastModifiedDate.toString()){
										this.removeFile(file);
									}
								}
							});
							var r = $.parseJSON(retrieve_video());
							var arr = $.map(r, function(el) { return el });
							if(arr != null && arr.length > 0){
								for (var i = 0; i < arr.length ; i++) {
									var mockFile = { name: arr[i].name, size: arr[i].size };
									this.options.addedfile.call(this, mockFile);

									mockFile.previewElement.classList.add('dz-success');
									mockFile.previewElement.classList.add('dz-complete');
								}
							}

							$(this.element).addClass("dropzone");
							

							this.on("success", function(file, serverFileName) {
								fileList[i] = {"serverFileName" : serverFileName, "fileName" : file.name,"fileId" : i };
								i++;
							});

							this.on("removedfile", function(file) {
								$.ajax({
									url: url + 'teacher/removeVideo/' + msg.data[0].name,
									type: "POST",
									data: { "filename" : file.name }
								});
							});
						}
					});
				}
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log("editLesson " + errorThrown);
			swal("Error!", "Please try again", "error");
		}
	});
}




function retrieve_pdf(){
	var index = (url + 'teacher/editlesson/').length;
	var id = location.href.substring(index);
	var jqxhr = $.ajax({
		type: "POST",       
		url: url + 'teacher/retrievePdf',
		data: {id:id},
		dataType: "JSON",
		global: false,
		async:false,
		success: function(data) {
			return data;
		}
	}).responseText;
	return jqxhr;
}

function retrieve_ppt(){
	var index = (url + 'teacher/editlesson/').length;
	var id = location.href.substring(index);
	var jqxhr = $.ajax({
		type: "POST",       
		url: url + 'teacher/retrievePpt',
		data: {id:id},
		dataType: "JSON",
		global: false,
		async:false,
		success: function(data) {
			return data;
		}
	}).responseText;
	return jqxhr;
}

function retrieve_video(){
	var index = (url + 'teacher/editlesson/').length;
	var id = location.href.substring(index);
	var jqxhr = $.ajax({
		type: "POST",       
		url: url + 'teacher/retrieveVideo',
		data: {id:id},
		dataType: "JSON",
		global: false,
		async:false,
		success: function(data) {
			console.log(data);
			return data;
		}
	}).responseText;
	return jqxhr;
}

function saveEdit(data){
	$.ajax({
		url : url + 'teacher/updateLesson',
		type: "POST",
		data: {x: data},
		dataType: "JSON",
		success: function(msg)
		{
			if (msg.status == "success") {
				swal({
					title: "Success!",
					type: "success",
				}, 
				function(){
					location.reload();
				});
			}
			else if (msg.status == "duplicate"){
				swal({
					title: "Duplicate!",
					type: "warning",
				}, function(){});
			} else if (msg.status == "code existing") {
				swal({
					title: "Code Existing!",
					type: "warning",
				}, function(){});
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log('update ' + errorThrown);
			swal("Error!", "Please try again", "error");
		}
	});
}