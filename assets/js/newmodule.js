var newCreatedMod;
var editModData;
var modalPage;
$( document ).ready(function(){
	var body = $('body').attr('id');
	if (body == "allsubject" || body == "newsubject") {
	console.log('newmodulejs');
		allModule();
		$('#btn-new-mod').click(function(){
			if ($('#mod-name').val().trim() == "") {
				swal('Empty!', "Module name cannot be empty.", "warning");
				$('#mod-name').focus();
			}
			else if($('#mod-desc').val().trim() == ""){
				swal('Empty!', "Module description cannot be empty.", "warning");
				$('#mod-desc').focus();
			}else{
				var file_data = $('#mod-img').prop('files')[0];
				var data = [
					$('#mod-name').val(), 
					$('#mod-desc').val(), 
					$('#mod-img').val(),
					$('#weekdays').val()
				];
				newCreatedMod = $('#mod-name').val();
				createNewMod(data);
			}
		});

		$('#btn_add_to_module').click(function(){
			table = $('#tbl-allLesson');
			var ctr = 0;
			arrLessonChecked = new Array();
			$('input:checked', table.get()).each(function(){
				arrLessonChecked.push($(this).val());
				ctr++;
			});
			if (ctr != 0) {
				addLessonToMod([newCreatedMod, arrLessonChecked]);
			}
		});

		$('#btn_save_changes').click(function(){
			var ctr = 0;
			if ($('#edit-mod-name').val().trim() == "") {
				swal('Empty!', "Module name cannot be empty.", "warning");
				$('#edit-mod-name').focus();
			}
			else if($('#edit-mod-desc').val().trim() == ""){
				swal('Empty!', "Module description cannot be empty.", "warning");
				$('#edit-mod-desc').focus();
			}else{
				var finalEditData = new Array(4);
				if ($('#edit-mod-name').val() != editModData.data[0].mod_name) {
					finalEditData[0] = $('#edit-mod-name').val();
				}else{
					finalEditData[0] = null;
				}

				if ($('#edit-mod-desc').val() != editModData.data[0].mod_desc) {
					finalEditData[1] = $('#edit-mod-desc').val();
				}else{
					finalEditData[1] = $('#edit-mod-desc').val();
				}
				
				if ($('#edit-mod-img').val() != null){
					finalEditData[2] = $('#edit-mod-img').val();	
				}
				finalEditData[3] = $('#edit-weekdays').val();
				
				updateModule(editModData.data[0].mod_name, finalEditData);

				addLessonTbl = $('#edit-tbl-allLesson');
				arrLessonChecked = new Array();
				$('input:checked', addLessonTbl.get()).each(function(){
					arrLessonChecked.push($(this).val());
					ctr++;
				});
				if (ctr != 0) {
					saveChangesLessonMod([editModData.data[0].mod_name, arrLessonChecked]);
				}
			}
		});
	}
}); //end of document.ready

function allModule(){
	$.ajax({
		url : url + 'teacher/allModule',
		type: "POST",
		dataType: "JSON",
		success: function(msg)
		{
			if (msg.data != null) {
				if (msg.status == 1) {
					$('#all-mod').html('');
					for (var i = 0; i < msg.data.length; i++) {
						$('#all-mod').append('' +
							'<div class="col-md-55">'+
								'<div class="thumbnail">' +
									'<div class="image view view-first">' +	 
										'<img style="width: 100%; display: block;" src="'+ url + msg.data[i].path +'" alt="image not found" />' +
										'<div class="mask">' +
											'<a href="#" onClick="showModuleModal('+ msg.data[i].id +')"><p>'+ msg.data[i].desc +'</p></a>' +
											'<div class="tools tools-bottom">' +
												'<a href="#" id="'+ msg.data[i].id +'" onClick="editModule(this.id)"><i class="fa fa-pencil"></i></a> ' +
												'<a href="#" id="'+ msg.data[i].id +'" onClick="deleteModule(this.id)"><i class="fa fa-times"></i></a>' + 
											'</div>' +
										'</div>' + 
									'</div>' +
									'<div class="caption">' +
										'<a href="javascript:;" onClick="showModuleModal('+ msg.data[i].id +')">' + 
											'<p><b>'+ msg.data[i].name +'</b></p>' + 
										'</a>' +
									'</div>' +
								'</div>' +
							'</div>'
						);
					}
				}
			}else{
				$('#all-mod').html('');
				$('#all-mod').html('0 module found');
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log("allmod " + errorThrown);
			swal("Error!", "Please try again", "error");
		}
	});
}
function createNewMod(data){
	$.ajax({
		url : url + 'teacher/createNewMod',
		type: "POST",
		data: {x: data},
		dataType: "JSON",
		success: function(msg)
		{
			// console.log(msg);
			if (msg.status == "success") {
				swal({
					title: "Add Lesson?",
					text: "Would you like add lesson to the Module, " + data[0] + "?", 
					type: "success",
					showCancelButton: true,
					cancelButtonText: "Skip",
					confirmButtonColor: "#26B99A",
					confirmButtonText: "Yes, confirm it!",
					closeOnConfirm: true
				}, function(isConfirm){
					if (!isConfirm) location.reload();

					$('.spn-new-mod').html('');
					$('.spn-new-mod').html(data[0]);
					$('.add-les-div').show();
					$('.add-mod-div').hide();
					loadAllLesson('#tbl-allLesson');
				});
			}
			else if (msg.status == "duplicate"){
				swal("Duplicate", msg.data, "warning");
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log("cnewmod " + errorThrown);
			swal("Error!", "Please try again", "error");
		}
	});	
}

function deleteModule(id){
	swal({
		title: "Are you sure?",
		text: "You want to delete a module?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, confirm it!",
		closeOnConfirm: true
	}, 
	function(isConfirm){
		if (!isConfirm) return;
		$.ajax({
			url : url + 'teacher/deleteModule',
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

function loadAllLesson(tablename){
	//tbl-allLesson
	$(tablename).DataTable({
        "processing": true,
        "serverSide": true,
        "ajax":{
	    	"url": url + "teacher/loadAllLesson",
	    	"type": "POST"
	    },
    	"columns": [
	          { "data": "rowID" },
	          { "data": "lesson_name" },
	          { "data": "lesson_desc" },
	          { "data": "date_created"}
      	],
	});
}

function showModuleModal(id){
	$.ajax({
		url : url + 'teacher/getModuleById',
		type: "POST",
		data: {x: id},
		dataType: "JSON",
		success: function(msg)
		{
			console.log(msg);
			if (msg.status == "1") {
				modalPage = "modalview";
				// console.log(msg);
				$('#mod-les-tbl').DataTable().clear().destroy();
				$('#mod-name-head, #lbl-weekday').html('');
				$('#mod-name-head').html(msg.data[0].mod_name);
				$('#lbl-weekday').html(msg.data[0].mod_day.join(', '));
				$('#mod-les-tbl').DataTable({
					"processing": true,
					"serverSide": true,
					"bAutoWidth" : false,
					"ajax":{
					"url": url + "teacher/getDTModuleById/" + id,
					"type": "POST"
				},
					"columns": [
					{ "data": "lesson_name" },
					{ "data": "lesson_desc" },
					{ "data": "action" }

					],
				});				
				$('#module-les-mod').modal('show');
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log("smodmodal " + errorThrown);
			swal("Error!", "Please try again", "error");
		}
	});
}

function editModule(id){
	$.ajax({
		url : url + 'teacher/getModuleById',
		type: "POST",
		data: {x: id},
		dataType: "JSON",
		success: function(msg)
		{
			// console.log(msg);	
			if (msg.status == "1") {
				modalPage = "modaledit";
				// console.log(msg);
				$('#edit-mod-les-tbl, #edit-tbl-allLesson').DataTable().clear().destroy();
				$('#edit-mod-name-head, .spn-edit-mod').html('');
				$('#edit-mod-name-head, .spn-edit-mod').html(msg.data[0].mod_name);
				$('#edit-mod-name').val(msg.data[0].mod_name);
				$('#edit-mod-desc').val(msg.data[0].mod_desc);
				$('#edit-weekdays').val(msg.data[0].mod_day).change();
				$('.edit-add-more-lesson, #edit-module-main').show();
				
				$('#edit-mod-les-tbl').DataTable({
					"processing": true,
					"serverSide": true,
					"bAutoWidth" : false,
					"ajax":{
					"url": url + "teacher/getDTModuleById/" + id,
					"type": "POST"
				},
					"columns": [
					{ "data": "lesson_name" },
					{ "data": "lesson_desc" },
					{ "data": "action" }

					],
				});
				editModData = msg;
				loadAllLesson('#edit-tbl-allLesson');				
				$('#edit-module-les-mod').modal('show');
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log("editmod " + errorThrown);
			swal("Error!", "Please try again", "error");
		}
	});
}

function removeLink(id){
	swal({
		title: "Are you sure?",
		text: "",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, confirm it!",
		closeOnConfirm: true
	}, function(isConfirm){
		if (!isConfirm) return;
		$.ajax({
			url : url + 'teacher/removeLink',
			type: "POST",
			data: {x: id},
			dataType: "JSON",
			success: function(msg)
			{
				console.log(msg);
				if (msg.status == "1") {
					if (modalPage == 'modalview') {
						swal({
							title:"Success!", 
							text: msg.data, 
							type: "success"
						}, function() {
							console.log(id);
							$('#mod-les-tbl').DataTable().ajax.reload();
						});
					}
					else if(modalPage == 'modaledit'){
						lessonTbl = $('#edit-mod-les-tbl').DataTable();
						lessonTbl.ajax.reload();	
					}
				}else{
					swal("Failed!", msg.data, "error");
				}
			},
			error: function (jqXHR, textStatus, errorThrown){
				console.log("removLnk " + errorThrown);
				swal("Error!", "Please try again", "error");
			}
		});
	});
}

function addLessonToMod(data){
	console.log(data);
	$.ajax({
		url : url + 'teacher/addLessonToMod',
		type: "POST",
		data: {x: data},
		dataType: "JSON",
		success: function(msg)
		{

			if (msg.status == 1) {
				var texts;
				(data[1].length >= 2 ? texts = data[1].length + ' lessons' : texts = ' a lesson')

				swal({
					title: "Success!",
					text: "Success adding " + texts,
					type: "success"
				}, function(){
					location.reload();
				});
			}else{
				swal({
					title: "Error!",
					text: "Error adding lesson to module, " + data[0],
					type: "error"
				}, function(){
					location.reload();
				});
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log("add lesson to mod " + errorThrown);
			swal("Error!", "Please try again", "error");
		}
	});	
}

function saveChangesLessonMod(data){
	console.log(data);
	$.ajax({
		url : url + 'teacher/addLessonToMod',
		type: "POST",
		data: {x: data},
		dataType: "JSON",
		success: function(msg)
		{
			if (msg.status == 1) {
				lessonTbl = $('#edit-mod-les-tbl').DataTable();
				lessonTbl.ajax.reload();
			}else{

			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log("savchngeslesmod " + errorThrown);
			swal("Error!", "Please try again", "error");
		}
	});	
}

function updateModule(formerName, data){
	$.ajax({
		url : url + 'teacher/updateModule',
		type: "POST",
		data: {
			x: data,
			y: formerName
		},
		dataType: "JSON",
		success: function(msg)
		{
			console.log(msg);
			swal({
				title: "Reload Page?",
				text: formerName + " succefully updated! Reload the page to view the update.",
				type: "success",
				showCancelButton: true,
				confirmButtonColor: "#26B99A",
				confirmButtonText: "Yes",
				closeOnConfirm: true
			},function (isConfirm){
				if (!isConfirm) return;
				location.reload();
			});
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log("updateModule " + errorThrown);
			swal("Error!", "Please try again", "error");
		}
	});		
}
