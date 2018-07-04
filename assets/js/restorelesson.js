$( document ).ready(function(){
	var body = $('body').attr('id');
	if (body == "restorelesson") {
		console.log('restorelessonjs');
		allDeletedLesson();

		$('#btn-delete-all-les').click(function() {
			var all = $('#all-del-les').html();
			if (all != "0 deleted module") {
				swal({
					title: "Are you sure?",
					text: "This will delete all the temporary deleted lesson permanently!",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, confirm it!",
					closeOnConfirm: true
				}, 
				function(isConfirm){
					if (!isConfirm) return;
					delPermaLesson();
				});		
			}else{
				swal("No Record", "Lesson not found!", "warning")
			}
		});
	}
});


function allDeletedLesson(){
	$.ajax({
		url : url + 'teacher/alldeletedlesson',
		type: "POST",
		dataType: "JSON",
		success: function(msg)
		{
			if (msg.status == 1) {
				$('#all-del-les').html('');
				if (msg.data != null) {
					for (var i = 0; i < msg.data.length; i++) {
						$('#all-del-les').append('' +
							'<div class="col-md-55">'+
								'<div class="thumbnail">' +
									'<div class="image view view-first">' +	 
										'<img style="width: 100%; display: block;" src="'+ url + msg.data[i].path +'" alt="image not found" />' +
										'<div class="mask">' +
											'<a href="#"><p>'+ msg.data[i].desc +'</p></a>' +
											'<div class="tools tools-bottom">' +
												'<a href="#" id="'+ msg.data[i].id +'" onClick="resNowLes(this.id)" title="Click to restore module"><i class="fa fa-recycle"></i></a> ' +
												'<a href="#" id="'+ msg.data[i].id +'" onClick="deletePermaLes(this.id)" title="Click to delete permanently"><i class="fa fa-trash"></i></a> ' +
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
					$('#all-del-les').html('0 deleted module');
				}

			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log("alldeletemod "+ errorThrown);
			swal("Error!", "Please try again", "error");
		}
	});
}

function resNowLes(id){
	$.ajax({
		url : url + 'teacher/resNowLes',
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
			console.log("resNowLes "+ errorThrown);
			swal("Error!", "Please try again", "error");
		}
	});
}

function deletePermaLes(id){
	swal({
		title: "Are you sure?",
		text: "This will delete the lesson permanently!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, confirm it!",
		closeOnConfirm: true
	}, 
	function(isConfirm){
		if (!isConfirm) return;
		$.ajax({
			url : url + 'teacher/deletePermaLes',
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

function delPermaLesson(){
	$.ajax({
		url : url + 'teacher/delPermaLesson',
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
			console.log("delPermaLesson " + errorThrown);
			swal("Error!", "Please try again", "error");
		}
	});		
}