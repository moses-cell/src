$(document).ready(function(){

	$('#submit').click(function(e) {

		//if (validate() == false)
		//	return;

		if ($("#frmSystemRoles").valid() == false) {
			return;
		}


		var form = $('#frmSystemRoles');
		
		var postForm = form.serialize();
		//var postForm = new Array(); //form.serializeArray();
		//postForm = UpdateSerializeArray(postForm)

			
		$.ajax({ //Process the form using $.ajax()
			type    : 'POST', //Method type
			url     : '/library/page/broles.php', //Your form processing file URL
			data    : postForm, //Forms name
			dataType: 'json',
			success	: function(data) {
				if (!data.success) { //If fails
					if (data.session == 'expired') {
						alert("Your session had expired. Please re-login")
						window.location.replace("/");

					} else {
						alert(data.error);
					}

					return;
				} else {
					//alert(data.session);
					location.href = '/roles/';
				}
							
			}, 
			
			error	: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr.status);
				console.log(xhr.responseText);
				console.log(thrownError);
				alert('There is unknown error occurs. Please contact administrator for system verification');
			}
				
		});
	});

		
	
	$.validator.setDefaults({
		submitHandler: function(form) {
			if (form.id == 'frmSystemRoles') {
				swal({ title:"Save successful", text: "", type: "warning", buttonsStyling: true, confirmButtonClass: "btn btn-success"})

			} else if(form.id == 'xxx') {
				alert('yyyy');
			}
		}
	})

	$("#frmSystemRoles").validate({
		rules: {
			rolesname: {
				required: true,
				minlength: 4
			},
			dashboard: "required",
			myapplication: "required"
		},
		messages: {
			rolesname: {
				required: "Please enter a roles name",
				minlength: "roles name must at least 4 characters"
			},
			dashboard: "Dashboard is a compulsory menu",
			myapplication: "My Application is a compulsory menu"
		}
			
	});




})


function UpdateSerializeArray(postForm) {
	
	postForm.push({name: 'username' , value: document.getElementById("frmlogin").elements['username'].value});
	postForm.push({name: 'password' , value: document.getElementById("frmlogin").elements['password'].value});
	
	return postForm;
	
}

