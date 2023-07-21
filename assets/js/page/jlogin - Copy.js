$(document).ready(function(){

	$('#login').click(function(e) {

		if (validate() == false)
			return;


		var form = $('#frmlogin');
		
		//var postForm = form.serialize();
		var postForm = new Array(); //form.serializeArray();
		postForm = UpdateSerializeArray(postForm)

			
		$.ajax({ //Process the form using $.ajax()
			type    : 'POST', //Method type
			url     : 'library/page/blogin.php', //Your form processing file URL
			data    : postForm, //Forms name
			dataType: 'json',
			success	: function(data) {
				if (!data.success) { //If fails
					$('#ErrorLogin').html('Wrong username or password');
					return;
				} else {
					//alert(data.session);
					location.href = 'dashboard.php?pg='+ data.session;
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
		$('ErrorLogin').html('Please enter username');
		return false;
	}

	if ($('#password').val() == '') {
		$('ErrorLogin').html('Please enter password');
		return false;
	}
	
	return true
}