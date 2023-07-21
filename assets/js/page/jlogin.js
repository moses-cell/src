$(document).ready(function(){


	if (window.parent.location != window.location) {
		parent.location.href = location.href;
	}

	$('#login').click(function(e) {

		if (validate() == false)
			return;

		var form = $('#frmlogin');
		
		var postForm = new Array(); 
		postForm = UpdateSerializeArray(postForm)

			
		$.ajax({ 
			type    : 'POST', 
			url     : 'library/page/b_login.php', 
			data    : postForm, 
			dataType: 'json',
			success	: function(data) {
				
				if (!data.success) { //If fails
					if (data.external !== undefined) {
						$('#ErrorLogin').html('You can only login between ' + data.start + ' Days before training date and ' + data.end + ' Days after training date');
						return;
					}

					$('#ErrorLogin').html('Wrong username or password');
					return;
				} else {
					if (data.change_password) {
						location.href = 'change_password.php?key=' + data.key; 
					}
					else
						//alert(data.usertype)
						if (data.usertype == 'internal')
							location.href = 'dashboard.php'; 
						else
							location.href = 'l-my-task.php'; 
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
	
	postForm.push({name: 'username' , value: document.getElementById("frmlogin").elements['username'].value});
	postForm.push({name: 'password' , value: document.getElementById("frmlogin").elements['password'].value});
	
	return postForm;
	
}


function validate() {

	if ($('#username').val() == '') {
		$('#ErrorLogin').html('Please enter username');
		return false;
	}

	if ($('#password').val() == '') {
		$('#ErrorLogin').html('Please enter password');
		return false;
	}
	
	return true
}