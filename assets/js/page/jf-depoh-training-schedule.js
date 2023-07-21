
$(document).ready(function(){

	$('#DepohSectionGroup').show();
	populate_data();

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

	$('#internal_participant').click(function() {
    
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
        url = 'f-hr-new-participant.php?id=' + $('#pageid').val() + '&eval=' + student_eval + '&trainer=' + trainer_eval + '&super=' + super_eval + '&target=' + selected;
        openDialog(url, 'max', 'max', 'Add New Participant')
    })

    $('#external_participant').click(function() {
    
        url = 'f-hr-external-participant.php?id=' + $('#pageid').val();
        openDialog(url, 650, 850, 'Add External Participant')
    })

	var hash = $(location).attr('hash');
	if (hash == '#training') {
		$('#training_tab').trigger('click')
	} else if (hash == '#participant') {
		$('#participant_tab').trigger('click')
	} 


	$('#enable_process').change(function() {
		if ($(this).is(':checked') == false) {
			danger ('Warning', 'This will automatically cancel all registered participant') 
		} 
	})

	var provider = $.parseJSON($('#provider_list').val());
	var provider_id;

	$( "#trainingprovidername" ).autocomplete({
		source: $.parseJSON($('#provider_list').val()),
		minLength: 0,
		select :  function (event, ui) {
			$(this).val(ui.item.label); // display the selected text
			$('#trainingprovider').val(ui.item.value); // save selected id to hidden input
			//$(this).focusout();
			return false;
		}, change: function( event, ui ) {
			$("#trainingprovider" ).val( ui.item? ui.item.value : "" );
			
			
			if ($(this).val() == "") {
				$( "#trainingprovider" ).val("");
				$( this ).val("");
			}				
		}, close : function( event, ui ) {
			populate_location();
			if ($(this).val() == "") {
				$( "#trainingprovider" ).val("");
			} 
			if ($('#trainingprovider').val() == "") {
				$( this ).val("");
			}

			if ($('#trainingprovider').val() == 'new') {
				$('#newtrainingprovider').prop('disabled',false);
			} else {
				$('#newtrainingprovider').val();
				$('#newtrainingprovider').prop('disabled',true);
			}

			if (provider_id != $('#trainingprovider').val()) {
				$('#traininglocationname').val('');
				$('#traininglocation').val('');
				$('#locationdetails').val('');	
			}
			provider_id = $('#trainingprovider').val();			


		}, response: function(event, ui) {
			if (!ui.content.length) {
				var noResult = { value:"",label:"No results found", disabled: true };
				ui.content.push(noResult);
			} 
		}, focus: function (event, ui) {
		    event.preventDefault();
		    $(this).val(ui.item.label);
		    $("#trainingprovider").val(ui.item.value);
		}
	}).focus(function(){
		$(this).autocomplete("search","");
	}).click (function() {
		$(this).autocomplete("search","");
	})

	if (!RegExp.escape) {
	  RegExp.escape = function(value) {
	    return value.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&")
	  };
	}

	$( "#traininglocationname" ).autocomplete({
		source:  function( request, response ) {

			data = $('#location_list').val();
			finaldata = $.parseJSON(data)
			
			if (!request.term.length)
				response(finaldata);
			else {
				var regex = new RegExp(RegExp.escape(request.term), "i");
			    var recs = $.grep(finaldata, function(obj) {
			      return regex.test(obj.label)
			    });

			    response($.map(recs, function(item) {
			      return {
			        label: item.label,
			        value: item.value,
			        details: item.details,
			      }
			    }));
			}

		},
		minLength: 0,
		select :  function (event, ui) {
			$(this).val(ui.item.label); // display the selected text
			$('#locationdetails').val(ui.item.details)
			//$(this).focusout();
			return false;
		}, change: function( event, ui ) {
			$( "#traininglocation" ).val( ui.item? ui.item.value : "" );
			$( "#locationdetails" ).val( ui.item? ui.item.details : "" );
			if ($(this).val() == "") {
				$( "#traininglocation" ).val("");
				$('#locationdetails').val("");
				$( this ).val("");
			}				
		}, close : function( event, ui ) {
			if ($(this).val() == "") {
				$( "#traininglocation" ).val("");
				$('#locationdetails').val("");
			} 
			if ($('#traininglocation').val() == "") {
				$( this ).val("");
				$('#locationdetails').val("");
			}

			if ($('#traininglocation').val() == 'new training location') {
	//			$('#location').show();
				$('#newmaintraininglocation').prop('disabled',false);
				$('#newsubtraininglocation').prop('disabled',false);
				$('#locationdetails').val();
				$('#locationdetails').prop('readonly', false);	
			}
			else if ($('#traininglocation').val() == 'new public location') {
				//$('#location').show();
				$('#newmaintraininglocation').prop('disabled',false);
				$('#newsubtraininglocation').prop('disabled',false);
				$('#locationdetails').val();
				$('#locationdetails').prop('readonly', false);	
			}
			else {
				//$('#location').hide();
				//populate_location_details($('#traininglocation').val());
				$('#newmaintraininglocation').prop('disabled',true);
				$('#newsubtraininglocation').prop('disabled',true);	
				$('#newmaintraininglocation').val();
				$('#newsubtraininglocation').val();
				
				$('#locationdetails').val();
				$('#locationdetails').prop('readonly', true);
			}

		}, response: function(event, ui) {
			if (!ui.content.length) {
				var noResult = { value:"",label:"No results found", disabled: true };
				ui.content.push(noResult);
			} 
		}, focus: function (event, ui) {
		    event.preventDefault();
		    $(this).val(ui.item.label);
		    $("#traininglocation").val(ui.item.value);
		    $("#locationdetails").val(ui.item.details);
		}
	}).focus(function(){
		//location = $.parseJSON($('#location_list').val())
		$('#traininglocationname').autocomplete("search",'');
	}).click (function() {
		//location = $.parseJSON($('#location_list').val())
		$('#traininglocationname').autocomplete("search",'');
	})


    $('#HRSectionGroup').show();

	//$('#provider').hide();
	$('#newtrainingprovider').prop('disabled',true);
	
	//$('#location').hide();
	$('#newmaintraininglocation').prop('disabled',true);
	$('#newsubtraininglocation').prop('disabled',true);
	$('#locationdetails').prop('readonly', true);

	

	$('.datetime').timepicker({
		minuteStep: 10,
        appendWidgetTo: 'body',
        showSeconds: false,
        showMeridian: true,
        defaultTime: false,
        showInputs: true,
        disableFocus: true,
        explicitMode : true
    })

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
								return;
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


	/*$('#trainingprovider').change(function() {
		populate_location();
		if ($('#trainingprovider').val() == 'new') {
			$('#newtrainingprovider').prop('disabled',false);

		}
		else {
			$('#newtrainingprovider').val();
			$('#newtrainingprovider').prop('disabled',true);

		}
	})	*/

	/*$('#traininglocation').change(function() {
		if ($('#traininglocation').val() == 'new training location') {
//			$('#location').show();
			$('#newmaintraininglocation').prop('disabled',false);
			$('#newsubtraininglocation').prop('disabled',false);
			$('#locationdetails').val();
			$('#locationdetails').prop('readonly', false);	
		}
		else if ($('#traininglocation').val() == 'new public location') {
			//$('#location').show();
			$('#newmaintraininglocation').prop('disabled',false);
			$('#newsubtraininglocation').prop('disabled',false);
			$('#locationdetails').val();
			$('#locationdetails').prop('readonly', false);	
		}
		else {
			//$('#location').hide();
			populate_location_details($('#traininglocation').val());
			$('#newmaintraininglocation').prop('disabled',true);
			$('#newsubtraininglocation').prop('disabled',true);	
			$('#newmaintraininglocation').val();
			$('#newsubtraininglocation').val();
			
			$('#locationdetails').val();
			$('#locationdetails').prop('readonly', true);
		}
	})	*/

    // Initialize Textarea
	//$('textarea.auto-size').textareaAutoSize();

	$('#close').click(function(e) {
		location.href = "l-hr-training-calendar.php";
	})


	$('.fileupload').bind('change', function() {
	  //this.files[0].size gets the size of your file.
		//2097152 = 2MB	  
	  	if (this.files[0].size > (1024*1024*2))  {
	  		alert('Please attach file below 2MB')
	  		this.value = "";
	  	}

	  	var ext = this.files[0].name.split('.').pop().toLowerCase();
	  	var fileExtension = ['jpeg', 'jpg', 'png', 'pjp', 'pjpeg', 'jfif', 'pdf', 'xls', 'xlsx', 'doc', 'docx', 'ppt', 'pptx' ];
	  	if ($.inArray(ext, fileExtension) == -1) {
	  		alert('Please upload allowable file type only');
			this.value = "";
	  		return false;
	  	}

		
	});

	$('#openfile').click(function() {
		if ($('#filename').val() == '') {
			warning('File Attachment', 'No file attach');			
		} else {
			//location.href = $('#filename').val();
			window.open($('#filename').val(),'_blank');
		}
	})


	$('[name="eligibility[]"]').change(function(e) {

		if (e.currentTarget.id != 'el_AllStaff') {
			$('#el_AllStaff').prop('checked',false)
		} else {

			if ($('#el_AllStaff').is(':checked')) {
				var $chk = $('[name="eligibility[]"]:checked');
				$chk.each(function(index, value){
					if(value.id != 'el_AllStaff') {
						$('#' + value.id).prop('checked',false)
					}
	    			// Do stuff here with this
				});
			}  
		} 

	});

	$('[name="target_audience[]"').change(function(e) {
		if (e.currentTarget.id != 'ta_AllStaff') {
			$('#ta_AllStaff').prop('checked',false)
		} else {
			if ($('#ta_AllStaff').is(':checked')) {
				var $chk = $('[name="target_audience[]"]:checked');
				$chk.each(function(index, value){
					if(value.id != 'ta_AllStaff') {
						$('#' + value.id).prop('checked',false)
					}
	    			// Do stuff here with this
				});
			}  
		}
	})		



	


	$('#save').click(function() {
		
		a = $('#training_status').val();
		if ($('#enable_process').is(':checked')) {
			b = true;
		} else {
			b = false;
		}

		if ($('#training_status').val() == '1' && $('#enable_process').is(':checked') == false) {
			$.confirm({
				title: 'Disabled Training',
				content: 'This will automatically cancel all registered participant!',
				useBootstrap: true,
				buttons: {
					confirm: {
						btnClass: 'btn-prasarana',
						action: function () {
							//cancel_participant(this.$target.attr('value'));
							save_training();
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
		} else {
			save_training();
		}
	})



})

function save_training() {

		form_data = new FormData($('form')[0]);

/*		if ($('#training_status').val() == '1' && $('#enable_process').is('checked') == false) {
			danger ('Warning', 'This will automatically cancel all registered participant') 
	
		}
*/
		if (validateSave(form_data) == false) {
			jump_to_error_field();
			//notify ('warning', 'Please correct all the errors before training module can be saved', '');    
			//notify ('success', 'Record successfully saved', '')
			warning('Validation Failed', 'Please correct all the errors before training schedule can be saved');
			return;
		}

		form_data.append('form_process' , 'Save');		

		$.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : 'library/page/process/p_f-hr-training-schedule.php', //Your form processing file URL
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
								//alert(data.errors);
								danger ('Process Error', data.errors) 
							} else {
								success ('Success', 'Record successfully saved');
								if ($('#enable_process').is(':checked'))
									redirect_delay('l-depoh-training.php');
								else
									redirect_delay('l-depoh-training-disable.php');
							}
							
						},
			error	: function (xhr, ajaxOptions, thrownError) {
							$("#loading-overlay").hide();
							danger ('Process Error', "There is unknown error occurs. Please contact administrator for system verification") 
							console.log(xhr.status);
							console.log(xhr.responseText);
							console.log(thrownError);
							console.log('There is unknown error occurs. Please contact administrator for system verification');
							console.log(xhr.responseText);
						}
			
        	});



}

function populate_location (location) {

	form_data = {
		'get_provider_location' : '1', 
		'trainingprovider' : $('#trainingprovider').val(),
		'editor_name' : $('#editor_name').val(),
		'id' : location,
	}

	//var final_data;
	$.ajax({ //Process the form using $.ajax()
        type    : 'POST', //Method type
        url     : 'library/page/process/p_f-hr-training-schedule.php', //Your form processing file URL
        data    : form_data, //Forms name
        success	: 
        	function(data) {
        		if (location == '')
            		$('#location_list').val(data);
            	else {
            		$('#location_list').val(data);
            		data = $.parseJSON(data);
            		$.each(data, function(index, value) {

            			if(value['value'] == location) {
            				$('#traininglocationname').val(value['label']);
            				$('#traininglocation').val(value['value']);
            				$('#locationdetails').val(value['details']);
            			}
            			//return false;


            		})


            	}
            	//final_data = data;
            	//$('#location_list').val($.parseJSON(data))
            	//return data;
            	//return $.parseJSON(data)
			},	
    });

    //return final_data;
}

function populate_location_details (id) {

	form_data = {
		'get_location_details' : '1', 
		'traininglocation' : id,
		'editor_name' : $('#editor_name').val()
	}

	$.ajax({ //Process the form using $.ajax()
        type    : 'POST', //Method type
        url     : 'library/page/process/p_f-hr-training-schedule.php', //Your form processing file URL
        data    : form_data, //Forms name
        success	: 
        	function(data) {
            	$('#locationdetails').html(data);
            	//return data;
			},	
    });
}

function populate_data() {

	var result = $.parseJSON($('#data').val());
	var provider = $.parseJSON($('#provider_list').val());
	dtStart = '';
	$.each(result.Data, function( key, value ) { 
		$('#coursecode').val(value['code']);
		$('#title').val(value['title']);
		$('#description').val(value['description']);
		//$('select[name=trainingprovider]').val(value['provider'])
		$('#trainingprovider').val(value['provider']);
		trainingProvider = get_data(value['provider'],provider);
		$('#trainingprovidername').val (trainingProvider['label']);
		checkbox_check('bonding', '1', value['bonding'])
		//if (value['location'])

		if (value['date_start'] !== undefined && value['date_start'] !== null) {
			
			$('#sdate').val(formatdate(value['date_start'], 1, 'date-only'));
			$('#edate').val(formatdate(value['date_end'], 1, 'date-only'));	
			$('#stime').val(formattime(value['time_start']));
			$('#etime').val(formattime(value['time_end']));	
			checkbox_check('enable_process', '1', value['enable_schedule'])
			$('#training_status').val(value['enable_schedule']);
			populate_location(value['location']);	

			
			var mySQLDate = value['date_start'];
			dtStart = new Date(Date.parse(mySQLDate.replace(/-/g, '/')));		
			//populate_location_details(value['location']);	
		} else {
			populate_location('');
		}

		$('#tdays').val(value['total_days']);
		$('#thours').val(value['total_hours']);
		$('#cost').val(value['cost']);
		$('select[name=trainingcategory]').val(value['category']);
		$('select[name=trainer]').val(value['trainer_id']);
		

		$('#max_sit').val(value['max_sit']);
		$('#remarks').val(value['remarks']);


		$('#filename').val(value['filename']);	
		if ($('#filename').val() != '') {
			var fname = $('#filename').val().split('/');			
			$('#fileattached').val(fname[fname.length-1]);
		}	

		checkbox_check('eval', '1', value['eval'])
		checkbox_check('trainer_eval', '1', value['trainer_eval'])
		checkbox_check('super_eval', '1', value['super_eval'])

		chk = $('[name="eligibility[]"')
		chk.each (function(index, obj){
			checkbox_check(obj.id, obj.value, value['eligibility'], true)
		})



		chk = $('[name="target_audience[]"')
		chk.each (function(index, obj){
			checkbox_check(obj.id, obj.value, value['audience'], true)
		})

		radio_check('require_approval', '1' , value['approval'])
		radio_check('pre_approval', '0' , value['approval'])
		
	})

	id = getUrlVars()['id'];
	if(typeof id != "undefined") {
		if (dtStart != '' && $('#enable_process').is(':checked')) {
			var today = new Date();
			if (dtStart <= today) {
				/*$('#sdate').prop('readonly', true);
				$('#edate').prop('readonly', true);
				$('#stime').prop('readonly', true);
				$('#etime').prop('readonly', true);
				$('#stime').removeClass('datetime');
				$('#etime').removeClass('datetime');
				return;*/
			}
		} 
		
	} 
	DateElement(false, getCurrentYear()-1, getCurrentYear()+1, 'sdate', 'edate','tdays')

}


function validateSave(form_data) {
	$('.error_field').remove();

	form = 'data_form';
	validateElement('text',form,'coursecode', 'Please enter course code');
	validateElement('text',form,'title', 'Please enter course title');

	if ($('#enable_process').is(':checked')) {
		validateElement('select',form,'trainingcategory', 'Please select training category');
		validateElement('select',form,'trainingprovider', 'Please select training provider');
		validateElement('number',form,'tdays', 'Please enter training total number of days (minimum 1 day)',1);
		validateElement('number',form, 'thours', 'Please enter training total number of hours (minimum 1 day)',1);
		validateElement('number',form, 'max_sit', 'Please enter maximum sit (minimum 1 day)',1);
		validateElement('check', form, 'eligibility[]', 'Please select at least one who can apply');
		validateElement('check', form, 'target_audience[]', 'Please select at least one target audience');
		//validateElement('date', form, 'sdate', 'Please enter start date later then today', 'today','','','dd/mm/yyyy')

		//validateElement('text',form,'sdate', 'Please enter training start date');
		validateElement('text',form,'edate', 'Please enter training end date');

		validateElement('select',form,'trainingprovider', 'Please select training provider');
		validateElement('select',form,'traininglocation', 'Please select training location');
		validateElement('number',form, 'cost', 'Please enter cost per head (minimum 0)',0);


	}

	if ($('.error_field').length > 0) {
		return false;
	}
	else
		return true;


}


