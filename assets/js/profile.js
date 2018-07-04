var id, user, checkstate;

$( document ).ready(function(){
	var body = $('body').attr('id');
	if (body == "profile") {
		console.log('profile');
		getProfile();

		if ( $('#changepass').is(':checked')) {
			$('.changepass').prop('disabled', false);
			$('.pword').prop('disabled', true);
			checkstate = true;
		} else{
			$('.changepass').prop('disabled', true);
			$('.pword').prop('disabled', false);
			checkstate = false;
		}

		$('#changepass').change(function() {
			if ( $(this).is(':checked')) {
				$('.changepass').prop('disabled', false);
				$('.pword').prop('disabled', true);
				checkstate = true;
			} else{
				$('.changepass').prop('disabled', true);
				$('.pword').prop('disabled', false);
				checkstate = false;
			}
		});

		$('.btn-profile-save').click(function(){
			var firstname, middlename, lastname, username, oldpass, newpass, confirmpass;
			firstname = $('#prof-firstname');
			middlename = $('#prof-middlename');
			lastname = $('#prof-lastname');
			username = $('#prof-username');
			currentpass = $('#prof-curpassword');
			newpass = $('#prof-newpassword');
			oldpass = $('#prof-oldpassword');
			confirmpass = $('#prof-cpassword');

			if (checkstate) {
				if (firstname.val().trim() == "") {
					swal('Empty Field!', "Fill up the firstname field.", "warning");
					firstname.focus();
				} else if (lastname.val().trim() == "") {
					swal('Empty Field!', "Fill up the lastname field.", "warning");
					lastname.focus();
				} else if (username.val().trim() == "") {
					swal('Empty Field!', "Fill up the username field.", "warning");
					username.focus();
				} else if (oldpass.val().trim() == "") {
					swal('Empty Field!', "Fill up the old password field.", "warning");
					oldpass.focus();
				} else if (newpass.val().trim() == "") {
					swal('Empty Field!', "Fill up the new password field.", "warning");
					newpass.focus();
				} else if (confirmpass.val().trim() == "") {
					swal('Empty Field!', "Fill up the confirm password field.", "warning");
					confirmpass.focus();
				} else if (newpass.val().trim() != confirmpass.val().trim()) {
					swal('Invalid', "New password and confirm password did not match!", "warning");
					newpass.focus();
				}  else {
					var data = [
						user,
						firstname.val().trim(),
						middlename.val().trim(),
						lastname.val().trim(),
						username.val().trim(),
						oldpass.val().trim(),
						newpass.val().trim()
					];
					updateProfile(data);
				}
			} else {
				if (firstname.val().trim() == "") {
					swal('Empty Field!', "Fill up the firstname field.", "warning");
					firstname.focus();
				} else if (lastname.val().trim() == "") {
					swal('Empty Field!', "Fill up the lastname field.", "warning");
					lastname.focus();
				} else if (username.val().trim() == "") {
					swal('Empty Field!', "Fill up the username field.", "warning");
					username.focus();
				} else if (currentpass.val().trim() == "") {
					swal('Empty Field!', "Fill up the password field.", "warning");
					currentpass.focus();
				} else {
					var data = [
						user,
						firstname.val().trim(),
						middlename.val().trim(),
						lastname.val().trim(),
						username.val().trim(),
						currentpass.val().trim()
					];

					updateProfile(data);
				}
			}

		});

	}
}); //document.ready

function getProfile(){
	$.ajax({
		url : url + 'teacher/getProfile',
		type: "POST",
		dataType: "JSON",
		success: function(msg){
			console.log(msg);
			if(msg.data != null){
				id = msg.data[0].id;
				user = msg.data[0].username;
				$('#prof-firstname').val(msg.data[0].firstname);
				$('#prof-middlename').val(msg.data[0].middlename);
				$('#prof-lastname').val(msg.data[0].lastname);
				$('#prof-username').val(msg.data[0].username);
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			swal("Error!", "Please try again", "error");
		}
	});
}

function updateProfile(data){
	$.ajax({
		url : url + 'teacher/updateProfile',
		type: "POST",
		data: {x: data},
		dataType: "JSON",
		success: function(msg){
			console.log(msg);
			if (msg.data == "success") {
				swal({
					title: "Success!",
					text: "Profile successfully updated!",
					type: "success"
				}, 
				function(){
					location.reload();
				});
			} else if (msg.data == "existing username"){
				swal("Existing!", "Username is already existing!", "warning");
			} else if (msg.data == "invalid"){
				swal("Invalid!", "Incorrect username or password", "warning");
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			console.log(errorThrown);
			swal("Error!", "Please try again", "error");
		}
	});
}



