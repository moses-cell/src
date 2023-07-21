$(document).ready(function(){


	if (window.parent.location != window.location) {
		parent.location.href = location.href;
	}


	$('#reset_password').click(function(e) {


		if (validate() == false)
			return;

		var form = $('#frmchange_password');
		
		//var postForm = form.serialize();
		var postForm = new Array(); //form.serializeArray();
		postForm = UpdateSerializeArray(postForm)

			
		$.ajax({ //Process the form using $.ajax()
			type    : 'POST', //Method type
			url     : 'library/page/process/p_forget_password.php', //Your form processing file URL
			data    : postForm, //Forms name
			dataType: 'json',
			success	: function(data) {
				if (!data.success) { //If fails
					$('#ErrorLogin').html('System Error. Unable to reset your password');
					return;
				} else {
					$('#ErrorLogin').css('color', 'blue');
					if (data.status == 'External User') {
						$('#ErrorLogin').html('Reset Password Successful. <br>Please check your email inbox or junk/spam folder for your new password. <br>You will be redirect to login page');
						redirect_delay ('login.php', 4);
					}
					else if (data.status == 'Check Internal Email') {
						$('#ErrorLogin').html('Reset Password Successful. <br>Please check your email inbox or junk/spam folder for your new password. <br>You will be redirect to login page');
						redirect_delay ('login.php', 4);
					}
					else if (data.status == 'Check External Email') {
						$('#ErrorLogin').html('Reset Password Successful. <br>Please check your external email registered in the system inbox or junk/spam folder for your new password. <br>You will be redirect to login page');
						redirect_delay ('login.php', 4);
					}
					else if (data.status == 'Check Secretary Email') {
						$('#ErrorLogin').html('Reset Password Successful. <br>Please check your Unit Secretary / Admin email inbox or junk/spam folder for your new password. <br>You will be redirect to login page');
						redirect_delay ('login.php', 4);
					} 
					else if (data.status == 'internal') {
						$('#ErrorLogin').html('You will redirected to Prasarana Forget Password Page');
						redirect_delay('https://press.prasarana.com.my/Users/forgot',3);
					}

					
					
					//location.href = 'login.php'; //?pg='+ data.session;
				}
							
			}, 
			
			error	: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr.status);
				console.log(xhr.responseText);
				console.log(thrownError);
				alert('There is unknown error occurs. Please contact administrator for system verification');
				console.log(xhr.responseText)
			}
				
		});
	});

		
	



})


function UpdateSerializeArray(postForm) {
	
	postForm.push({name: 'form_process' , value: "reset_password"});
	postForm.push({name: 'username' , value: document.getElementById("frmchange_password").elements['username'].value});

	
	return postForm;
	
}


function validate() {

	if ($('#username').val() == '') {
		$('#ErrorLogin').html('Please enter username');
		return false;
	}


	return true
}

