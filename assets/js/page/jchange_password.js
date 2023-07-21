$(document).ready(function(){


	if (window.parent.location != window.location) {
		parent.location.href = location.href;
	}




	$('#change_password').click(function(e) {

		if (validate() == false)
			return;

		var form = $('#frmchange_password');
		
		//var postForm = form.serialize();
		var postForm = new Array(); //form.serializeArray();
		postForm = UpdateSerializeArray(postForm)

			
		$.ajax({ //Process the form using $.ajax()
			type    : 'POST', //Method type
			url     : 'library/page/b_change_password.php', //Your form processing file URL
			data    : postForm, //Forms name
			dataType: 'json',
			success	: function(data) {
				if (!data.success) { //If fails
					if (data.errors == 'Error login') {
						$('#ErrorLogin').html('Wrong username or password');
						return;
					}
					if (data.errors == 'fail change password') {
						$('#ErrorLogin').html('System Error. Unable to update change password');
						return;
					}
					if (data.errors == 'Internal') {
						$('#ErrorLogin').html('You will be redirect to Prasarana Change Password');
						redirect_delay ('https://press.prasarana.com.my/Users/forgot',2);
					}

					
				} else {
					$('#ErrorLogin').html('Change Password Successful. You will be redirect to login page');
					$('#ErrorLogin').css('color','blue');
					redirect_delay ('login.php',2);
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
	
	postForm.push({name: 'username' , value: document.getElementById("frmchange_password").elements['username'].value});
	postForm.push({name: 'password' , value: document.getElementById("frmchange_password").elements['current_password'].value});
	postForm.push({name: 'new_password' , value: document.getElementById("frmchange_password").elements['new_password'].value});
	
	
	return postForm;
	
}


function validate() {

	if ($('#username').val() == '') {
		$('#ErrorLogin').html('Please enter username');
		return false;
	}

	if ($('#current_password').val() == '') {
		$('#ErrorLogin').html('Please enter current password');
		return false;
	}

	if ($('#new_password').val() == '') {
		$('#ErrorLogin').html('Please enter new password');
		return false;
	}

	if ($('#repeat_password').val() == '') {
		$('#ErrorLogin').html('Please enter confirm password');
		return false;
	}
	
	if ($('#new_password').val() != $('#repeat_password').val()) {
		$('#ErrorLogin').html('New password and confirm password does not match');
		return false;
	}

	if ($('#new_password').val() == $('#current_password').val()) {
		$('#ErrorLogin').html('Current password and new password cannot be same');
		return false;
	}


	if ($('#password-strength-status').html() != "Strong password" && $('#password-strength-status').html() != "Very strong password") {
		$('#ErrorLogin').html('New password do not meet complexity requirements');
		return false;		
	}

	return true
}

function checkPasswordStrength() {
    
    var number = /([0-9])/;
    var alphabets = /([a-zA-Z])/;
    var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
    
    if ($('#new_password').val().length < 8) {
        $('#password-strength-status').removeClass();
        $('#password-strength-status').addClass('weak-password');
        $('#password-strength-status').html("Weak (should be at least 8 characters.)");
    } else {
        if ($('#new_password').val().match(number) && $('#new_password').val().match(alphabets) && $('#new_password').val().match(special_characters)) {
        	$('#password-strength-status').removeClass();
            $('#password-strength-status').addClass('strong-password');
            $('#password-strength-status').html("Strong password");

            if ($('#new_password').val().length > 12) {
        		$('#password-strength-status').removeClass();
        		$('#password-strength-status').addClass('very-password');
        		$('#password-strength-status').html("Very strong password");
    		}

        } else {
            $('#password-strength-status').removeClass();
            $('#password-strength-status').addClass('medium-password');
            $('#password-strength-status').html("Medium (should include alphabets, numbers and special characters.)");
        }
    }
}