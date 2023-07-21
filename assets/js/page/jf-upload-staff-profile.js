$(document).ready(function(){
	
	$('.fileupload').bind('change', function() {
	  //this.files[0].size gets the size of your file.
		//2097152 = 2MB	  
	  	if (this.files[0].size > (1024*1024*2))  {
	  		alert('Please attach file below 2MB')
	  		this.value = "";
	  	}

	  	var ext = this.files[0].name.split('.').pop().toLowerCase();
	  	var fileExtension = ['xls', 'xlsx' ];
	  	if ($.inArray(ext, fileExtension) == -1) {
	  		alert('Please upload allowable file type only');
			this.value = "";
	  		return false;
	  	}
		
	});

    $('#download').click(function() {
    
        location.href = 'download_template.php'  
    })

	$('#close').click(function(e) {
		window.parent.CloseDialog();
	})

	$('#upload').click(function() {

		$.confirm({
			title: 'Staff Profile Upload',
			content: 'Are you sure you want to upload new staff profile. <span style="color:red; font-weight:bold">This process will overide existing staff profile and this process cannot be reverse</span>',
			useBootstrap: true,
			buttons: {
				yes: {
					btnClass: 'btn-prasarana',
					action: function () {
						upload();
			        }
			    },
				cancel: {
					btnClass: 'btn-prasarana',
					action: function () {
						return;
					}
				}
			}
		});

	})
})

function upload() {
	
		
		form_data = new FormData($('form')[0]);

		if (validateSave(form_data) == false) {
			jump_to_error_field();
			//notify ('warning', 'Please correct all the errors before training module can be saved', '');    
			//notify ('success', 'Record successfully saved', '')
			warning('Validation Failed', 'Please correct all the errors before staff profile can be uploaded');
			return;
		}

		form_data.append('form_process' , 'Staff Profile');
		$.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : 'library/page/process/p_f-data-upload.php', //Your form processing file URL
            data    : form_data, //Forms name
            dataType: 'json',
            contentType: false,
         	cache: false,
   			processData:false,  
            beforeSend: function(){
		    	window.scrollTo(0, 0);
            	$("#loading-overlay").show();
        	},
            success	: function(data) {
            				$("#loading-overlay").hide();
							if (!data.success) { //If fails
								danger ('Process Error', data.errors) 
							} else {
								success ('Success', 'Record successfully uploaded');	
								window.parent.DelayCloseDialog();
							}
							
						},
			error	: function (xhr, ajaxOptions, thrownError) {
							$("#loading-overlay").hide();
							danger ('Process Error', "Please use the provided template from this system and keep the first row as it is") 
							console.log(xhr.status);
							console.log(xhr.responseText);
							console.log(thrownError);
						}
			
        	});

}






function validateSave(form_data) {
	$('.error_field').remove();

	form = 'data_form';

	validateElement('text',form,'fileupload', 'Please enter file to upload');
	

	if ($('.error_field').length > 0) {
		return false;
	}
	else
		return true;


}

