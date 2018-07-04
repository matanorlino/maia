$( document ).ready(function(){
	var body = $('body').attr('id');
	if (body == "teachnow") {
		console.log('teachnow');
		allModuleToday();
	}
}); //end of document.ready

function allModuleToday(){
	$.ajax({
		url : url + 'teacher/modToday',
		type: "POST",
		dataType: "JSON",
		success: function(msg)
		{
			if (msg.data != null) {
				if (msg.status == 1) {
					$('#all-mod-today').html('');
					for (var i = 0; i < msg.data.length; i++) {
						$('#all-mod-today').append('' +
							'<div class="col-md-55">'+
								'<div class="thumbnail">' +
									'<div class="image view view-first">' +	 
										'<img style="width: 100%; display: block;" src="'+ url + msg.data[i].path +'" alt="image not found" />' +
										'<div class="mask">' +
											'<a href="#" onClick="showModuleModal('+ msg.data[i].id +')"><p>'+ msg.data[i].desc +'</p></a>' +
											'<div class="tools tools-bottom">' +
												'<a href="#" id="'+ msg.data[i].id +'" onClick="editModule(this.id)"></i></a> ' +
												'<a href="#" id="'+ msg.data[i].id +'" onClick="deleteModule(this.id)"></i></a>' + 
											'</div>' +
										'</div>' + 
									'</div>' +
									'<div class="caption">' +
										'<a href="#" onClick="showModuleModal('+ msg.data[i].id +')">' + 
											'<p><b>'+ msg.data[i].name +'</b></p>' + 
										'</a>' +
									'</div>' +
								'</div>' +
							'</div>'
						);
					}
				}
			}else{
				$('#all-mod-today').html('');
				$('#all-mod-today').html('0 module found');
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log("allmod " + errorThrown);
			swal("Error!", "Please try again", "error");
		}
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