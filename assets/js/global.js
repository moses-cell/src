//import '../vendor/bootstrap-icons/bootstrap-icons.css'
root_page = '/prasarana3/'
page_path = $(location).attr('pathname');

$(document).ready(function(){

	$("input[type=text]").keyup(function () {
		$(this).val($(this).val().toUpperCase());
	});
	$("textarea").keyup(function () {
		if (this.id != 'remarks')
			$(this).val($(this).val().toUpperCase());
	});
	

	$('.menu-heading').each(function(index, obj) {
		id = obj.id;
		$('#'+id+'Group').hide();
		icon = $('#'+id+'Icon').removeClass('bi-chevron-up').addClass('bi-chevron-down')
		$('#'+id+'Group' + '-nav').removeClass('collapse');

	})

	$('.menu-heading').click(function() {

		//alert('jdjdj');
		this_id = this.id;
		$('#'+this_id+'Group').toggle(400);
		//alert(this_id);

		if ($('#'+this_id+'Icon').hasClass('bi-chevron-down')) {
			//alert('collapse')
			icon = $('#'+this_id+'Icon').removeClass('bi-chevron-down').addClass('bi-chevron-up')
			$('#'+this_id+'Group' + '-nav').addClass('collapse');
		}
		else {
			//alert('expand')
			icon = $('#'+this_id+'Icon').removeClass('bi-chevron-up').addClass('bi-chevron-down')
			$('#'+this_id+'Group' + '-nav').removeClass('collapse');
		}

		$('.menu-heading').each(function(index, obj) {
			id = obj.id;

			if (id != this_id) {
				//alert('expand2')
				$('#'+id+'Group').hide();
				icon = $('#'+id+'Icon').removeClass('bi-chevron-up').addClass('bi-chevron-down')
				$('#'+this_id+'Group' + '-nav').removeClass('collapse');
			}
		})

	})


	$(".allow_numeric").on("input", function(evt) {
	    var self = $(this);
	    self.val(self.val().replace(/\D/g, ""));
	    if ((evt.which < 48 || evt.which > 57)) 
	     {
		   evt.preventDefault();
	     }
	 });

	$(".allow_decimal").on("input", function(evt) {
		var self = $(this);
	   	self.val(self.val().replace(/[^0-9\.]/g, ''));
	   	if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
	   	{
	    	evt.preventDefault();
	   	}
	});

	$('.allow_decimal').keypress(function(event) {
      if ((event.which != 46 || $(this).val().indexOf('.') != -1) &&
        ((event.which < 48 || event.which > 57) &&
          (event.which != 0 && event.which != 8))) {
        event.preventDefault();
      }
  
      var text = $(this).val();
  
      if ((text.indexOf('.') != -1) &&
        (text.substring(text.indexOf('.')).length > 2) &&
        (event.which != 0 && event.which != 8) &&
        ($(this)[0].selectionStart >= text.length - 2)) {
        event.preventDefault();
      }
    });

     $('#excel').click(function() {
     	location.href = 'report.xls.php';
     })

      $('#hr_dashboard').click(function() {
     	location.href = 'dashboard-admin.php';
     })


      $('#reset').click(function() {
     	location.reload();
     })

});

function Convert_to_Date(dateString, dateformat) {

	if (dateString == '')
		return;

	var dateEntered = dateString
	if (dateformat == 'dd/mm/yyyy' || dateformat == 'dd-mm-yyyy') {
		var date = dateEntered.substring(0, 2);
		var month = dateEntered.substring(3, 5);
		var year = dateEntered.substring(6, 10);
	}
	else {
		var date = dateEntered.substring(8, 10);
		var month = dateEntered.substring(5, 7);
		var year = dateEntered.substring(0, 4);
	} 

	var newDate = new Date(year, month - 1, date);
	//var currentDate = new Date();

	//alert(newDate.dateString);
	return newDate;
	
}

function Convert_Date_to_String(dateString, dateformat, delimeter = '/') {

	var dateEntered = dateString
	if (dateformat == 'yyyy-mm-dd' || dateformat == 'yyyy/mm/dd') {
		var date = dateEntered.substring(8, 10);
		var month = dateEntered.substring(5, 7);
		var year = dateEntered.substring(0, 4);
	} 

	var newDate = date + delimeter + month + delimeter + year;
	//var currentDate = new Date();

	return newDate;
	
}


function formatdate(dt, type, option ='') {

	if (dt === null)
		return '';

	if (dt.trim().length = 0)
		return '';

	if (dt == 'today') {
		date_ob = new Date();
	} else {
		date_ob = new Date(dt);

	}

	// adjust 0 before single digit date
	date = ("0" + date_ob.getDate()).slice(-2);

	// current month
	month = ("0" + (date_ob.getMonth() + 1)).slice(-2);

	// current year
	year = date_ob.getFullYear();

	// current hours
	hours = ("0" + (date_ob.getHours() )).slice(-2);

	// current minutes
	minutes = ("0" + (date_ob.getMinutes() )).slice(-2);

	// current seconds
	seconds = ("0" + (date_ob.getSeconds() )).slice(-2);

	if (type == 1) {
		if (option == 'date-only') {
			return date + "-" + month + "-" +year;
		}
		return date + "-" + month + "-" +year + " " + hours + ":" + minutes + ":" + seconds
	} else if (type == 2) {
		if (option == 'date-only') {
			return year + "-" + month + "-" +date;
		}
		return year + "-" + month + "-" +date + " " + hours + ":" + minutes + ":" + seconds
	}


}



function formattime (dtime) {

	
	if (dtime === null)
		return '';

	if (dtime.trim().length = 0)
		return '';

	dt = dtime.split(':');
	hour = dt[0];
	hour = hour * 1;

	var suffix = hour >= 12 ? "PM":"AM";
	var hours = ((hour + 11) % 12 + 1) 

	return hours + ":" + dt[1] + " " + suffix
}


function print_error (id, message) {

	if ($('#' + id).next().is('label')) {
		$('#' + id).next().after('<div id="error' + id + '" class="error_field">' + message + '</div>');
	} else {
		$('#' + id).after('<div id="error' + id + '" class="error_field">' + message + '</div>');

	}

}

function trim_text(text) {
	
	text = text.replace(/\s+/g,' ').replace(/>(\s)</g,'>\n<');
	if (text == ' ')
		text = '';
	return text;
}

/*function notify (notify_type, txtMessage, url = '') {

	$.notify({
            // options
	            message: txtMessage,
	            icon: "glyphicon glyphicon-ok", 	            
            },
            {
                // settings
                
                type: notify_type,
                timer: 1000,
                z_index: 10000,
                delay : 2000,
                allow_dismiss: true,
                placement: {
                    from: "top",
                    align: "center"
                },
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
                onClosed: function(urlpath = url) {
                	if (urlpath != '') 
                		location.href = urlpath

                }
            }
        );

} */

function getActiveTab (tab_id) {

	const nav = document.querySelector('#'+tab_id);
	tab = nav.children[nav.activeIndex]
	id = tab.id;
	pane_id = $('#'+id).attr('aria-controls');

	pane = $('#'+pane_id).get(0);
	return pane;
}

function activateTabbyErrorClass() {

	field = $('.error_field').first();
	tab = field.closest('.tab-pane');
	tab.addClass('active');
	aria = tab.attr('aria-labelledby');
	$('#'+ aria).addClass('active');
	$('#'+ aria).attr('aria-selected',"true");


	const nav = document.querySelector('#formtab');
    nav.autofocus = true;
    $.each(nav.children, function(key, value){
    	if (value.id == aria) {
           	nav.activeIndex = key
    	}

    })

    setTimeout( function() { 
				
		field = $('.error_field').first();
		fieldname = field.prev().attr('id');
	    $('#' + fieldname).focus();

		$([document.documentElement, document.body]).animate({
		    scrollTop: $("#"+fieldname).offset().top - 100
		}, 500);
    		 
  	}  , 500 );

    /*btn = $('#'+ aria).find('button');
		$('#'+ aria).find('button').attr('aria-selected',"true")
		$('#'+ aria).find('button').attr('tabindex',"0")	
		$('#'+ aria).find('button').addClass('mdc-tab--active')*/

}

function deActivateTab(obj) {
	//tab = obj.closest('.tab-pane');
	id = obj.id;
	$('#'+id).removeClass('active');

	aria = $('#'+id).attr('aria-labelledby');
	$('#'+ aria).removeClass('active');
	$('#'+ aria).attr('aria-selected',"false");
} 

function DateElement (b_singleDate, minYear, maxYear, sDate, eDate, tDay = '', minDate = '', isMin = true, isMinField = false, format = '', maxDate = '', isMaxField = false) {
         
    if (b_singleDate) {
    	const sd = document.getElementById(sDate);
		const picker = new Litepicker({ 
		    element: sd,
            singleMode: true,
            format: 'DD-MM-YYYY',
            numberOfMonths: 1,
            resetButton: true,
		    autoRefresh: true,
		    dropdowns: {
                minYear: minYear,
                maxYear: maxYear,
                months: true,
                years: true
            },
            resetButton: () => {
			   	let btn = document.createElement('button');
			   	btn.innerText = 'Reset';
			   	btn.addEventListener('click', (evt) => {
			    	evt.preventDefault();
			    	$('#'+sd.id).val('');
			    	$('#'+sd.id).trigger('change');
			   	});

			   	return btn;
			},
            setup: (picker) => {
		      	sd.addEventListener('input', (evt) => {
		        	if (sd.value === '') {
		          		picker.clearSelection();
		          		$('#'+sd.id).trigger('change');
		        	}
		        	$('#'+sd.id).trigger('change');

		      	});
			     picker.on('selected', (date1) => {
			     	d1 = date1.dateInstance.getDate()
	    			m1 = date1.dateInstance.getMonth()
	    			y1 = date1.dateInstance.getFullYear()

	    			if (minDate != '') {
	    				FieldName = '';
	    				if (isMinField) {
	    					if (FieldName == '')
	    						FieldName = minDate;
	    					minDate = Convert_to_Date($('#' + FieldName).val(),format)
	    				}
	    				d2 = new Date(minDate).getDate()
	    				m2 = new Date(minDate).getMonth()
	    				y2 = new Date(minDate).getFullYear()

	    				sdt = new Date(y1, m1, d1);
	    				edt = new Date(y2, m2, d2);

	    				if (isMin) {
		    				if (sdt < edt) {
		    					picker.clearSelection();
		    					warning('Date Selection Not Allowed','Date must be on this date ' + d2 + '-' + ((m2*1)+1) + '-' + y2 + ' or later')
		    				}
		    			} else {
		    				if (sdt > edt) {
		    					picker.clearSelection();
		    					warning('Data Selection Not Allowed','Date must be before this date ' + ((d2*1) + 1) + '-' + ((m2*1)+1) + '-' + y2)
		    				}
		    			}
		    			if (FieldName != '')
		    			minDate = FieldName;
	    			}

	    			if (maxDate != '') {
	    				FieldName2 = '';
	    				if (isMaxField) {
	    					if (FieldName2 == '')
	    						FieldName2 = maxDate;
	    					maxDate = Convert_to_Date($('#' + FieldName2).val(),format)
	    				}
				     	d1 = date1.dateInstance.getDate()
		    			m1 = date1.dateInstance.getMonth()
		    			y1 = date1.dateInstance.getFullYear()

	    				d2 = new Date(maxDate).getDate()
	    				m2 = new Date(maxDate).getMonth()
	    				y2 = new Date(maxDate).getFullYear()

	    				sdt = new Date(y1, m1, d1);
	    				edt = new Date(y2, m2, d2);

	    				if (sdt > edt) {
		    				picker.clearSelection();
		    				warning('Data Selection Not Allowed','Date must be on or before this date ' + ((d2*1)) + '-' + ((m2*1)+1) + '-' + y2)
		    			}
		    			if (FieldName2 != '')
		    				maxDate = FieldName2;
	    			}
	    			
			     	$('#'+ sd.id).trigger('change')
			     	//picker.clearSelection();
	  			});
		    }
        })

        //if ($('#' + sDate).val() != '')
        	
        
    } else {

    	const sd = document.getElementById(sDate);
    	const ed = document.getElementById(eDate);
		const picker = new Litepicker({ 
		    element: sd,
		    elementEnd: ed,
            singleMode: b_singleDate,
            format: 'DD-MM-YYYY',
            numberOfMonths: 2,
            resetButton: true,
	        numberOfColumns: 2,
		    autoRefresh: true,
		    dropdowns: {
                    minYear: minYear,
                    maxYear: maxYear,
                    months: true,
                    years: true
                },
		    setup: (picker) => {
		      	sd.addEventListener('input', (evt) => {
		        	if (sd.value === '') {
		          		picker.clearSelection();
		        	}
		        	$('#'+sd.id).trigger('change');
		      	});
			     picker.on('selected', (date1, date2) => {
	    			d1 = date1.dateInstance.getDate()
	    			m1 = date1.dateInstance.getMonth()
	    			y1 = date1.dateInstance.getFullYear()
	    					
	    			d2 = date2.dateInstance.getDate()
	    			m2 = date2.dateInstance.getMonth()
	    			y2 = date2.dateInstance.getFullYear()

	    			sdt = new Date(y1, m1, d1);
	    			edt = new Date(y2, m2, d2);

	    			if (tDay != '') {
	    				total = datediff(sdt, edt);
	    				$('#' + tDay).val(total);	
	    			}
	    			$('#'+sd.id).trigger('change');		

	  			});
		    }
		});

        /*window.addEventListener('DOMContentLoaded', event => {        
            new Litepicker({
                element: document.getElementById(sDate),
                elementEnd: document.getElementById(eDate),
                singleMode: b_singleDate,
                format: 'DD-MM-YYYY',
                numberOfMonths: 2,
                resetButton: true,
	            numberOfColumns: 2,
                dropdowns: {
                    minYear: minYear,
                    maxYear: maxYear,
                    months: true,
                    years: true
                },
                setup: (picker) => {
    				picker.on('selected', (date1, date2) => {
    					d1 = date1.dateInstance.getDate()
    					m1 = date1.dateInstance.getMonth()
    					y1 = date1.dateInstance.getFullYear()
    					
    					d2 = date2.dateInstance.getDate()
    					m2 = date2.dateInstance.getMonth()
    					y2 = date2.dateInstance.getFullYear()

    					sdt = new Date(y1, m1, d1);
    					edt = new Date(y2, m2, d2);

    					if (tDay != '') {
    						total = datediff(sdt, edt);
    						$('#' + tDay).val(total);	
    					}
    					

  					});
    			},

            });

        });*/


    }

}

function datediff(startDate, endDate) {
    // Take the difference between the dates and divide by milliseconds per day.
    // Round to nearest whole number to deal with DST.

    a = Math.round((endDate-startDate)/(1000*60*60*24)) + 1;
    return a;
}



function getCurrentYear() {
	return new Date().getFullYear();
}

function checkbox_check(FieldName, expectedValue, dataValue, bolArray = false) {

	if (bolArray) {
		if(dataValue == null)
			$('#' + FieldName).prop( "checked", false);
		else {

			arrDataValue = dataValue.split(', ')

			if  (arrDataValue.indexOf(expectedValue) >= 0)
				$('#' + FieldName).prop( "checked", true );
			else
				$('#' + FieldName).prop( "checked", false );
		}
		
	} else {
		if(dataValue == null)
			$('#' + FieldName).prop( "checked", false );
		else if (dataValue == expectedValue) 
			$('#' + FieldName).prop( "checked", true );
		else
			$('#' + FieldName).prop( "checked", false );
	}


}

function radio_check(FieldName, expectedValue, dataValue) {

	
	if (dataValue == expectedValue) 
		$('input[type="radio"][id="' + FieldName + '"]').prop( "checked", true ).trigger('change');
	else
			$('input[type="radio"][id="' + FieldName + '"]').prop( "checked", false ).trigger('change');
	


}

function jump_to_error_field() {
	setTimeout( function() { 
				
		field = $('.error_field').first();
		error_id = field.attr('id');
		fname = error_id.substring(5)
		//fieldname = field.prev().attr('id');
		objname = fname.split('[');
		fieldname = objname[0];


		if ( $( "#" + fieldname ).length ) {
			$( "#" + fieldname ).focus();
 		} else if ($('[name="'+ fieldname + '"]').length) {
	    	$('[name="'+ fieldname + '"]').focus();
 		}

		$([document.documentElement, document.body]).animate({
		    scrollTop: $("#"+error_id).offset().top - 150
		}, 500);
    		 
  	}  , 500 );

}

function redirect_delay (url, timer = 1) {
	setTimeout(function() {
  		window.location.href = url;
	}, 2000 * timer);
}

function openDialog(url, height, width, title, bCloseOnly = false, bDelay = false) {

	if (height == 'max') {
		height = $(window).innerHeight() - 50;
		if (height < 600)
			height = 600
	}
	if (width == 'max') {
		width = $(window).innerWidth() - 100;
		if (width < 500)
			width = 500;
	}

	if (bDelay == false) {
		if (bCloseOnly)
			modalWin.ShowURL(url  ,height, width,title);
		else
			modalWin.ShowURL(url  ,height, width,title,CloseDialog,null);

	} else  {
		setTimeout(function() {
			if (bCloseOnly)
				modalWin.ShowURL(url  ,height, width,title);
			else
				modalWin.ShowURL(url  ,height, width,title,CloseDialog,null);
		}, 2000);
		
	}

}

function redirect_dialog () {
	setTimeout(function() {
  		url = window.location.href;
    	window.location.href  = url;
    	modalWin.HideModalPopUp();
    	location.reload();
	}, 4000);

}

function CloseDialog() {
	//alert('parent');

    url = window.location.href;
    window.location.href  = url;
    location.reload();

    
}

function DelayCloseDialog() {
	//alert('parent');
	setTimeout(function() {
	    url = window.location.href;
	    window.location.href  = url;
	    location.reload();
	}, 4000);
    
}

function HideModalWindow() {
    modalWin.HideModalPopUp();
}

function CloseDialogOnly() {
	//alert('parent');
	//$('#bailwal_td_overlay').html('');
	modalWin.HideModalPopUp();
	//window.close();
    //window.close();
    //window.open("", '_self').window.close();
    //$('#bailwal_div_overlay').remove()
    //$('#bailwal_div_frame_parent').remove();
}

function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function get_data(val_id, source) {

	data = null;
	$.each(source, function( index, key ) { 
		if(key['value'] == val_id) {
			data = key;
			return false;
		}
	})
	return data;
}

function get_data_id(val_data, source) {

	val_data = val_data.trim().toUpperCase();
	data = null;
	$.each(source, function( index, key ) { 

		label = key['label'].toUpperCase();
		if(label == val_data) {
			data = key;
			return false;
		}

	})
	return data;
}

function is_number_value (val) {

	if (val == '')
		return 0;

	if (isNaN(val))
		return 0;

	return val;


}

function setSelectByValue(eID,val)
{ //Loop through sequentially//
  var ele=document.getElementById(eID);
  for(var ii=0; ii<ele.length; ii++)
    if(ele.options[ii].value==val) { //Found!
      ele.options[ii].selected=true;
      return true;
    }
  return false;
}

function setSelectByText(eID,text)
{ //Loop through sequentially//
  var ele=document.getElementById(eID);
  for(var ii=0; ii<ele.length; ii++)
    if(ele.options[ii].text==text) { //Found!
      ele.options[ii].selected=true;
      return true;
    }
  return false;
}