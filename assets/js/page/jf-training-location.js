$(document).ready(function(){

	$('#new_main_location').prop('disabled',true);
	populate_data();

	$('#main_location').change(function() {
		if ($('#main_location').val() == 'new') {
			$('#new_main_location').prop('disabled',false);	
			//$('#new').trigger('click');
		}
		else if ($('#main_location').val() == ''){
			$('#new_main_location').prop('disabled',true);
		}
		else {
			$('#new_main_location').prop('disabled',true);
			//id = $('#main_location option[value="' + $(this).val() + '"]').attr('id')
			//location.href = 'f-adm-training-location.php?prov_id=' + prov_id + '&id=' + id;
		}
	})	

	$('#close').click(function(e) {
		//CloseDialog();
		//window.parent.CloseDialog();
		//window.opener.reload;
		//window.opener.location.reload();
		//window.close();
		//HideModalWindow();
		window.parent.HideModalWindow();
	})

	$('#new').click(function() {
		prov_id = getUrlVars()['prov_id'];
		location.href = 'f-adm-training-location.php?prov_id=' + prov_id;
	})

	$('#save').click(function() {
		
		form_data = $("#data_form").serializeArray();
		if (validateSave(form_data) == false) {
			jump_to_error_field();
			//notify ('warning', 'Please correct all the errors before training module can be saved', '');    
			//notify ('success', 'Record successfully saved', '')
			warning('Validation Failed', 'Please correct all the errors before training module can be saved');
			return;
		}


		form_data.push({name: 'form_process' , value: 'Save'});

		$.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : 'library/page/process/p_f-adm-training-location.php', //Your form processing file URL
            data    : form_data, //Forms name
            dataType: 'json',
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
								prov_id = getUrlVars()['prov_id'];
								//location.href = 'f-adm-training-location.php?prov_id=' + prov_id;
								redirect_delay('f-adm-training-location.php?prov_id=' + prov_id);
								//window.parent.redirect_dialog();
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


		//console.log(form_data);
	})

	display_table();

})


function display_table() {
	prov_id = getUrlVars()['prov_id'];
	$('#datatable').DataTable( {
		"processing": true,
		"destroy" : true,
        "serverSide": true,
		"searching" : true,
		"filter" : false,
		"pageLength": 25,
		"lengthChange": true,
		"scrollX": true,
		"autoWidth" : false,  
		"columnDefs" : [
                    { "searchable" : true},
                    { "ordering" : true, "targets" :0, "orderable" : true, "width" : 100, "order": []},
                    { "ordering" : true, "targets" :1, "orderable" : true, "width" : 150, "order": []},
                    { "ordering" : true, "targets" :2, "orderable" : true, "width" : 300, "order": []},
                    { "ordering" : true, "targets" :3, "orderable" : true, "width" : 70, "order": []},
                    { "targets" : 4, "orderable" : false, "searchable" : false, "width" : 50, "className" : "dt-body-right"},
                ],
            "ajax": "library/page/b_l-training-location.php?prov_id=" + prov_id,
    } );   
}

function populate_data() {

	var result = $.parseJSON($('#data').val());

	id = getUrlVars()['id'];
	if (id === undefined) {
    	$('select[name=main_location]').val('new');
    	$('#new_main_location').prop('disabled',false);	

    }
	$.each(result.Data, function( key, value ) { 
		
		id = getUrlVars()['id'];

    	if (id === undefined) {
    		$('select[name=main_location]').val('new');
			$('#new_main_location').prop('disabled',false);	

    	} else {
    		$('select[name=main_location]').val(value['main_location']);
    	}
		
		//$("#main_location option[text='"+value['main_location'] +"']").attr('selected', 'selected'); 
		$('select[name="main_location"]').filter(function() {
			  //may want to use $.trim in here
			return $(this).text() == value['main_location'];
		}).prop('selected', true);

		//$("#main_location option[text=" + value['main_location'] +"]").prop("selected", true);*/
		//setSelectByText('main_location',value['main_location'] )
		//$('select[name=main_location]').val(value['main_location']);
		
		$('#sub_location').val(value['sub_location']);
		
		$('#details').val(value['details']);

		checkbox_check('enable', '1', value['status'])
		
		
	})
}


function validateSave(form_data) {
	$('.error_field').remove();

	if ($('#main_location').val() == '') {
		validateElement('select','data_form','main_location', 'Please select Training Provider Main Location');
	}

	if ($('#main_location').val() == 'new')
		validateElement('text','data_form','new_main_location', 'Please enter Training Provider New Main Location');


	if ($('.error_field').length > 0) {
		return false;
	}
	else
		return true;


}


