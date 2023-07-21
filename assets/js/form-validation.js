function validateElement(type, formname, id, message, min = '' , max = '', error_id_location = '', dateformat = '', dateCurrentToFuture = true ) {

	if (error_id_location == '') {
		error_id_location = id;
	}

	if (type == 'radio') {	
		bolradio = false
		$('[name="'+ id + '"]').each(function(index, element) {	
        	radio_id = ($(element).attr('id'));
        	if ($('#'+radio_id).is(":checked")) {
				bolradio = true
			}
   	 	});

		if (bolradio == false) {
			//$('[name="'+ id + '"]').parent().siblings().after('<div id="error' + id + '" class="error_field">' + message + '</div>');
			if (error_id_location == id)
				$('<div id="error' + id + '" class="error_field">' + message + '</div>').insertAfter($('[name="'+ error_id_location + '"]').parent().last());
			else
				$('#' + error_id_location).append('<div id="error' + id + '" class="error_field">' + message + '</div>')
		}

	} else if (type == 'check') {	
		bolradio = false
		$('[name="'+ id + '"]').each(function(index, element) {	
        	radio_id = ($(element).attr('id'));
        	if ($('#'+radio_id).is(":checked")) {
				bolradio = true
			}
   	});

		if (bolradio == false) {
			//$('[name="'+ id + '"]').parent().siblings().after('<div id="error' + id + '" class="error_field">' + message + '</div>');
			if (error_id_location == id) {
				obj = id.split('[');
				id = obj[0];
				$('<div id="error' + id + '" class="error_field">' + message + '</div>').insertAfter($('[name="'+ error_id_location + '"]').parent().last());
			} else
				$('#' + error_id_location).append('<div id="error' + id + '" class="error_field">' + message + '</div>')
		}

	} else if (type == 'select') {
			//alert($('#'+id).parent().id);
		if ($('#'+id).val() == null) {
			if (error_id_location == id)
				$('#' + id).parent().append('<div id="error' + id + '" class="error_field">' + message + '</div>');
			else
				$('#' + error_id_location).append('<div id="error' + id + '" class="error_field">' + message + '</div>')
			
		}
		else if ($('#'+id).val() == 'Please select') {
			if (error_id_location == id)
				$('#' + id).parent().append('<div id="error' + id + '" class="error_field">' + message + '</div>');
			else
				$('#' + error_id_location).append('<div id="error' + id + '" class="error_field">' + message + '</div>')
		}
		else if ($('#'+id).val() == '') {
			if (error_id_location == id)
				$('#' + id).parent().append('<div id="error' + id + '" class="error_field">' + message + '</div>');
			else
				$('#' + error_id_location).append('<div id="error' + id + '" class="error_field">' + message + '</div>')
		}

	} else if (type == 'text') {
			//alert($('#'+id).parent().id);
		if ($('#'+id).val() == null) {
			if (error_id_location == id)
				$('#' + id).parent().after('<div id="error' + id + '" class="error_field">' + message + '</div>');
			else
				$('#' + error_id_location).append('<div id="error' + id + '" class="error_field">' + message + '</div>')
		}
		else if ($('#'+id).val() == '') {
			if (error_id_location == id)
				$('#' + id).parent().after('<div id="error' + id + '" class="error_field">' + message + '</div>');
			else
				$('#' + error_id_location).append('<div id="error' + id + '" class="error_field">' + message + '</div>')
		}
	} else if (type == 'email') { 

		if ($('#'+id).val() == null) {
			if (error_id_location == id)
				$('#' + id).parent().after('<div id="error' + id + '" class="error_field">' + message + '</div>');
			else
				$('#' + error_id_location).append('<div id="error' + id + '" class="error_field">' + message + '</div>')
		}
		else if ($('#'+id).val() == '') {
			if (error_id_location == id)
				$('#' + id).parent().after('<div id="error' + id + '" class="error_field">' + message + '</div>');
			else
				$('#' + error_id_location).append('<div id="error' + id + '" class="error_field">' + message + '</div>')
		} else {
			if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($('#'+id).val())) {
				return true;
  			} else {
	    		if (error_id_location == id)
					$('#' + id).parent().after('<div id="error' + id + '" class="error_field">' + message + '</div>');
				else
					$('#' + error_id_location).append('<div id="error' + id + '" class="error_field">' + message + '</div>')
			}
		}
	} else {
		if ($('#'+id).length > 0) {
			if (type == 'textarea') {
				text_val = document.getElementById(formname).elements[id].value
				text_val = trim_text(text_val);

				if (text_val == '') {
					//$('#' + id).parent().after('<div id="error' + id + '" class="error_field">' + message + '</div>');
					if (error_id_location == id)
						$('#' + id).parent().after('<div id="error' + id + '" class="error_field">' + message + '</div>');
					else
						$('#' + error_id_location).append('<div id="error' + id + '" class="error_field">' + message + '</div>')
				}		
			} else if (type == 'number') {
				if ($('#'+id).val() == '') {
					if (error_id_location == id)
						$('#' + id).parent().after('<div id="error' + id + '" class="error_field">' + message + '</div>');
					else
						$('#' + error_id_location).append('<div id="error' + id + '" class="error_field">' + message + '</div>')
				} else {

					if (min != '') {
						if ($('#'+id).val() < min ) {
							$('#error' + id).remove();
							$('#error' + error_id_location).remove
							if (error_id_location == id)
								$('#' + id).parent().after('<div id="error' + id + '" class="error_field">' + message + '</div>');
							else
								$('#' + error_id_location).append('<div id="error' + id + '" class="error_field">' + message + '</div>')
						}
					}
					
					if (max != '') {
						if ($('#'+id).val() > max ) {
							$('#error' + id).remove();
							$('#error' + error_id_location).remove
							if (error_id_location == id)
								$('#' + id).parent().after('<div id="error' + id + '" class="error_field">' + message + '</div>');
							else
								$('#' + error_id_location).append('<div id="error' + id + '" class="error_field">' + message + '</div>')
						}

					}
				}
			} //numbers	
			else if (type == 'date') {

				if ($('#'+id).val() == '') {
					if (error_id_location == id)
						$('#' + id).parent().after('<div id="error' + id + '" class="error_field">' + message + '</div>');
					else
						$('#' + error_id_location).append('<div id="error' + id + '" class="error_field">' + message + '</div>')
				} else {

					dateToCompare = Convert_to_Date($('#'+id).val(), dateformat)
					bol_min = false;

					if (dateCurrentToFuture == true) {
						today = new Date();
						min_dt = new Date(new Date().setHours(0,0,0,0))
						min_dt.setDate(today.getDate() + 0);

						if (dateToCompare < min_dt ) {

							message = "Please enter current and future date only";

							if (error_id_location == id)
								$('#' + id).parent().after('<div id="error' + id + '" class="error_field">' + message + '</div>');
							else
								$('#' + error_id_location).append('<div id="error' + id + '" class="error_field">' + message + '</div>')

							return;
						}
					}


					if (min != '') {

						if (min == 'today') {
							min_dt = new Date();
							min_dt.setHours(0,0,0,0);
							bol_min = true;
						} else if (min == 'tomorrow') {
							today = new Date();
							min_dt = new Date(today)
							min_dt.setDate(today.getDate() + 1)
							bol_min = true;
						} else {
							if (isNaN(min)) {
								bol_min = false;
							} else {
								today = new Date();
								min_dt = new Date(today)
								min_dt.setDate(today.getDate() + parseInt(min));
								bol_min = true;
							}
						}

						//alert(min_dt);
						if (dateToCompare < min_dt ) {
							$('#error' + id).remove();
							$('#error' + error_id_location).remove
							if (error_id_location == id)
								$('#' + id).parent().after('<div id="error' + id + '" class="error_field">' + message + '</div>');
							else
								$('#' + error_id_location).append('<div id="error' + id + '" class="error_field">' + message + '</div>')
						}
					}
					
					if (max != '') {

						if (max == 'today') {
							max_dt = new Date();
							bol_max = true;
						} else if (min == 'tomorrow') {
							today = new Date();
							max_dt = new Date(today)
							max_dt.setDate(today.getDate() + 1)
							bol_max = true;
						} else {
							if (isNaN(min)) {
								bol_max = false;
							} else {
								today = new Date();
								max_dt = new Date(today)
								max_dt.setDate(today.getDate() + min);
								bol_max = true;
							}
						}
						
						if (dateToCompare > max_dt ) {
							$('#error' + id).remove();
							$('#error' + error_id_location).remove
							if (error_id_location == id)
								$('#' + id).parent().after('<div id="error' + id + '" class="error_field">' + message + '</div>');
							else
								$('#' + error_id_location).append('<div id="error' + id + '" class="error_field">' + message + '</div>')
						}

					}
				}
			}
		} // field exist

	} // else

	if (message == '') {
		if ($('#error'+id).length > 0) {
			return true;			
		} else
			return false;
	}

} 
