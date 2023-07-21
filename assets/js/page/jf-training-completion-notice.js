$(document).ready(function(){

	$('#notice').confirm({
		title: 'Training Completion Notice',
		content: 'Are you sure you want to send email for Training Completion Notice!',
		useBootstrap: true,
		buttons: {
			confirm: {
				btnClass: 'btn-prasarana',
				action: function () {
					send_notice();
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


function send_notice() {
	
	var postForm = new Array(); 
	postForm.push({name: 'process' , value: 'send_notice'});
	postForm.push({name: 'content' , value: $('#email_body').html()});
	postForm.push({name: 'id' , value: id = getUrlVars()['id']});

	$.ajax({ //Process the form using $.ajax()
	    type    : 'POST', //Method type
	    url     : 'library/page/process/p_f-training-completion-notice.php', //Your form processing file URL
	    dataType: 'json',
	    data    : postForm, //Forms name
	    beforeSend: function(){
	    	window.scrollTo(0, 0);
	       	$("#loading-overlay").show();
	   	},
	    success	: function(data) {
	    	$("#loading-overlay").hide();
			if (!data.success) { //If fails
				//alert(data.errors);
				danger ('Process Error', data.errors) 
				return;
			} else {
				success('Training Completion Notice', 'Email successfully send')
				window.parent.redirect_dialog();
			}	
		},
		error	: function (xhr, ajaxOptions, thrownError) {
			$("#loading-overlay").hide();
			$(this).prop('checked',false);
			danger ('Process Error', "There is unknown error occurs. Please contact administrator for system verification") 
			console.log(xhr.status);
			console.log(xhr.responseText);
			console.log(thrownError);
			console.log('There is unknown error occurs. Please contact administrator for system verification');
			console.log(xhr.responseText);
		}
				
	});





}



function populate_data() {

	var result = $.parseJSON($('#data').val());

	$.each(result.Data, function( key, value ) { 
		$('#coursecode').val(value['code']);
		$('#title').val(value['title']);
		$('#description').val(value['description']);
		//$('select[name=trainingprovider]').val(value['provider'])
		$('#trainingprovider').val(value['provider_name']);
		if (value['sub_location'] == '') {
			$('#traininglocation').val(value['main_location']);
		} else if(value['sub_location'] == null) {
			$('#traininglocation').val(value['main_location']);
		} else {
			$('#traininglocation').val(value['main_location'] + ' - ' + value['sub_location']);
		}
		$('#locationdetails').val (value['location_detail']);
		
		checkbox_check('trainer_eval', '1', value['trainer_eval'])
		$('#super_eval').val(value['super_eval']);

		$('#sdate').val(formatdate(value['date_start'], 1, 'date-only'));
		$('#edate').val(formatdate(value['date_end'], 1, 'date-only'));	
		$('#stime').val(formattime(value['time_start']));
		$('#etime').val(formattime(value['time_end']));	

		$('#tdays').val(value['total_days']);
		$('#thours').val(value['total_hours']);
		$('#trainingcategory').val(value['training_category']);
		$('#trainer').val(value['trainer_name']);

		$('#max_sit').val(value['max_sit']);
		$('#remarks').val(value['remarks']);


		$('#filename').val(value['filename']);	
		if ($('#filename').val() != '') {
			var fname = $('#filename').val().split('/');			
			$('#fileattached').val(fname[fname.length-1]);
		}	

		
	})
}



