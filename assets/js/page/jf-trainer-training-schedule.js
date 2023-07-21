$(document).ready(function(){

	populate_data();

    $('#TrainerSectionGroup').show();


	$('#close').click(function(e) {
		location.href = "l-hr-training-calendar.php";
	})

    $('#add_participan').click(function() {
    
        url = 'f-trainer-new-participant.php?id=' + $('#pageid').val();
        openDialog(url, 390, 650, 'Trainer - Add New Participant')
    })


	$('#openfile').click(function() {
		if ($('#filename').val() == '') {
			warning('File Attachment', 'No file attach');			
		} else {
			//location.href = $('#filename').val();
			window.open($('#filename').val(),'_blank');
		}
	})

	$('#training_complete').click(function() {
		url = 'f-training-completion-notice.php?id=' + $('#pageid').val();
		openDialog(url, 'max', 'max', 'Trainer - Training Completion Notice')
	})

	$('#training_tab').click(function() {
		
		$('#participant_tab').removeClass('tab-link-active');
		$('#training_tab').addClass('tab-link-active');
		$('#participant_list').hide();
		$('#training_form').show();

	})

	$('#participant_tab').click(function() {
		
		$('#participant_tab').addClass('tab-link-active');
		$('#training_tab').removeClass('tab-link-active');
		$('#participant_list').show();
		$('#training_form').hide();

	})


	var hash = $(location).attr('hash');
	if (hash == '#training') {
		$('#training_tab').trigger('click')
	} else if (hash == '#participant') {
		$('#participant_tab').trigger('click')
	} 

	$('.cancel').confirm({
		title: 'Cancel Participant Registration!',
		content: 'Are you sure to remove this newly registered participant from the list!',
		useBootstrap: true,
		buttons: {
			confirm: {
				btnClass: 'btn-prasarana',
				action: function () {
					cancel_participant(this.$target.attr('value'));
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

	$('.replace').confirm({
		title: 'Replace Participant Registration!',
		content: 'Are you sure to replace the registered participant with other participant!',
		useBootstrap: true,
		buttons: {
			confirm: {
				btnClass: 'btn-prasarana',
				action: function () {
					if ($('#super_eval').val() == '1')
						url = 'f-trainer-new-participant.php?id=' + $('#pageid').val() + '&key=' + this.$target.attr('value') + '&super=1';
					else
						url = 'f-trainer-new-participant.php?id=' + $('#pageid').val() + '&key=' + this.$target.attr('value');
					
        			openDialog(url, 'max', 'max', 'Trainer - Add New Participant')
        			return;
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



	$('.attendance_check').on('change',function() {
		id = $(this).attr('id');

		data = id.split('_');
		param = $(this).val();

		if ($(this).is(':checked')) {
			param = param + '&checked=1';
		} else {
			param = param + '&checked=0';
		}

		if (data.length == 3) {

			$.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : 'library/page/process/p_f-update-attendance.php?'+ param, //Your form processing file URL
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
								//alert(data.errors);
								danger ('Process Error', data.errors) 
								$(this).prop('checked',false);
							} else {
								return
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

	})

})


function cancel_participant(id) {
	
	param = 'id=' + $('#pageid').val() + '&key=' + id;

	

	$.ajax({ //Process the form using $.ajax()
	    type    : 'POST', //Method type
	    url     : 'library/page/process/p_f-cancel-participant.php?'+ param, //Your form processing file URL
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
				//alert(data.errors);
				danger ('Process Error', data.errors) 
				return;
			} else {
				location.reload();
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



