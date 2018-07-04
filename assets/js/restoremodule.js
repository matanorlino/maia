$( document ).ready(function(){
	var body = $('body').attr('id');
	if (body == "restoremodule") {
	console.log('restoremodulejs');
		allDeletedModule();

		$('#btn-delete-all').click(function() {
			swal({
				title: "Are you sure?",
				text: "This will delete all the temporary deleted modules permanently!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes, confirm it!",
				closeOnConfirm: true
			}, 
			function(isConfirm){
				if (!isConfirm) return;
				allDeletePerma();
			});		
		});
	}
});


function allDeletedModule(){
	$.ajax({
		url : url + 'teacher/alldeletedmod',
		type: "POST",
		dataType: "JSON",
		success: function(msg)
		{
			if (msg.status == 1) {
				$('#all-del-mod').html('');
				if (msg.data != null) {
					for (var i = 0; i < msg.data.length; i++) {
						$('#all-del-mod').append('' +
							'<div class="col-md-55">'+
								'<div class="thumbnail">' +
									'<div class="image view view-first">' +	 
										'<img style="width: 100%; display: block;" src="'+ url + msg.data[i].path +'" alt="image not found" />' +
										'<div class="mask">' +
											'<a href="#"><p>'+ msg.data[i].desc +'</p></a>' +
											'<div class="tools tools-bottom">' +
												'<a href="#" id="'+ msg.data[i].id +'" onClick="restoreNow(this.id)" title="Click to restore module"><i class="fa fa-recycle"></i></a> ' +
												'<a href="#" id="'+ msg.data[i].id +'" onClick="deletePerma(this.id)" title="Click to delete permanently"><i class="fa fa-trash"></i></a> ' +
											'</div>' +
										'</div>' + 
									'</div>' +
									'<div class="caption">' +
										'<a href="#display-all-lesson-of-this-module" target="_blank">' + 
											'<p><b>'+ msg.data[i].name +'</b></p>' + 
										'</a>' +
									'</div>' +
								'</div>' +
							'</div>'
						);
					}
				}else{
					$('#all-del-mod').html('0 deleted module');
				}

			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log("alldeletemod "+ errorThrown);
			swal("Error!", "Please try again", "error");
		}
	});
}

function restoreNow(id){
	$.ajax({
		url : url + 'teacher/restoreNow',
		type: "POST",
		data: {x: id},
		dataType: "JSON",
		success: function(msg){
			swal({
				title: "Success",
				type: "success"
			}, function () {
				location.reload();
			});
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log("resnow "+ errorThrown);
			swal("Error!", "Please try again", "error");
		}
	});
}

function deletePerma(id){
	swal({
		title: "Are you sure?",
		text: "This will delete the module permanently!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, confirm it!",
		closeOnConfirm: true
	}, 
	function(isConfirm){
		if (!isConfirm) return;
		$.ajax({
			url : url + 'teacher/deletePerma',
			type: "POST",
			data: {x: id},
			dataType: "JSON",
			success: function(msg){
				swal({
					title: "Delete Success!",
					type: "success"
				},function(){
					location.reload();
				});
			},
			error: function (jqXHR, textStatus, errorThrown){
				console.log("delPerma " + errorThrown);
				swal("Error!", "Please try again", "error");
			}
		});	
	});
}

function allDeletePerma(){
	$.ajax({
		url : url + 'teacher/allDeletePerma',
		type: "POST",
		dataType: "JSON",
		success: function(msg){
			swal({
					title: "Delete Success!",
					type: "success"
				},function(){
					location.reload();
				});
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log("alldelPerma " + errorThrown);
			swal("Error!", "Please try again", "error");
		}
	});		
}