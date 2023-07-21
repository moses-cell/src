$(document).ready(function(){


 	$('#StaffSectionGroup').hide();
 	$('#SecSectionGroup').show();
 	$('#SecTraining-nav').addClass('show')


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

	$('#add_participant').click(function() {
    
		student_eval = $('#eval').val();
		trainer_eval = $('#trainer_eval').val();
		super_eval = $('#super_eval').val();

		var selected = '';
		var delim = '';
		$('.target_audience input:checked').each(function() {
		    selected = selected + delim +  $(this).val();
		    delim = ',';
		});
		//alert(selected);
        url = 'f-hr-new-participant.php?id=' + $('#sch_id').val() + '&eval=' + student_eval + '&trainer=' + trainer_eval + '&super=' + super_eval + '&target=' + selected;
        openDialog(url, 'max', 'max', 'Add New Participant')
    })

    $('.cancel_participant').on('click',function() {
		val = $(this).val();

		$.confirm({
		    title: 'Participant Training Cancellation',
		    content: '' +
		    '<form action="" class="formName">' +
		    '<div class="form-group">' +
		    '<label>Reason for participant training cancellation</label>' +
		    '<input type="text" placeholder="Cancellation Reason" class="cancel_reason form-control" required />' +
		    '</div>' +
		    '</form>',
		    buttons: {
		        formSubmit: {
		            text: 'Confirm Cancellation',
		            btnClass: 'btn-prasarana',
		            action: function () {
		                var reason = this.$content.find('.cancel_reason').val();
		                if(!reason){
		                    $.alert('provide a valid reason for participant cancellation');
		                    return false;
		                }

		                cancel_participant_training(reason, val);
		            }
		        },
		        cancel: {
		        	text: 'Cancel Process',
					btnClass: 'btn-prasarana',
					action: function () {
						return;
					}
				}
		    },
		    onContentReady: function () {
		        // bind to events
		        var jc = this;
		        this.$content.find('form').on('submit', function (e) {
		            // if the user submits the form by pressing enter in the field.
		            e.preventDefault();
		            jc.$$formSubmit.trigger('click'); // reference the button and click it
		        });
		    }
		});

	})

})


function cancel_participant_training(reason, val) {
		
	form_data = new FormData($('form')[0]);

	form_data.append('form_process' , 'Cancel_Participant');
	form_data.append('reason' , reason);	
	form_data.append('id' , val);		

	$.ajax({ //Process the form using $.ajax()
    	type    : 'POST', //Method type
        url     : 'library/page/process/p_f-cancel-participant-registration.php', //Your form processing file URL
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
				success ('Success', 'Participant training registration successfully cancelled');
				url = location.href;
				redirect_delay(url);
				location.reload();
			}
							
		},
		error	: function (xhr, ajaxOptions, thrownError) {
			$("#loading-overlay").hide();
			danger ('Process Error', "There is unknown error occurs. Please contact administrator for system verification") 
			console.log(xhr.status);
			console.log(xhr.responseText);
			console.log(thrownError);
			console.log('There is unknown error occurs. Please contact administrator for system verification');
		}
   	});

}
