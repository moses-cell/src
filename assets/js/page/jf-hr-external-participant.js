$(document).ready(function() {

    $('#close_dialog').click(function(e) {
        //CloseDialog();
        window.parent.HideModalWindow()
        //window.parent.CloseDialog();
        //window.opener.location.reload();
    })

    $("#update_external").click(function(){

        form_data = $("#external_participant").serializeArray();

        if (validateSave(form_data) == false) {
            jump_to_error_field();
            //notify ('warning', 'Please correct all the errors before training module can be saved', '');    
            //notify ('success', 'Record successfully saved', '')
            warning('Validation Failed', 'Please correct all the errors before training module can be saved');
            //window.location.reload();
            return;
        }
        form_data.push ({name: 'form_process' , value: "Save"});


        $.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : 'library/page/process/p_f-hr-external-participant.php', //Your form processing file URL
            data    : form_data, //Forms name
            dataType: 'json',
            beforeSend: function(){
                window.scrollTo(0, 0);
                $("#loading-overlay").show();
            },
            success : function(data) {
                $("#loading-overlay").hide();
                if (!data.success) { //If fails
                    danger ('Process Error', data.errors) 
                } else {
                    success ('Success', 'Record successfully saved');
                    redirect_delay(window.location.href)
                }
            },
            error   : function (xhr, ajaxOptions, thrownError) {
                $("#loading-overlay").hide();
                danger ('Process Error', "There is unknown error occurs. Please contact administrator for system verification") 
                console.log(xhr.status);
                console.log(xhr.responseText);
                console.log(thrownError);
                console.log('There is unknown error occurs. Please contact administrator for system verification');
                console.log(xhr.responseText);
            }
            
        });
    })
});

function validateSave(form_data) {
    $('.error_field').remove();

    validateElement('email','external_participant','email', 'Please enter correct format for participant email');
    validateElement('text','external_participant','name', 'Please enter participant name');
    validateElement('text','external_participant','company', 'Please enter participant company');
    validateElement('text','external_participant','department', 'Please enter participant department');

    if ($('.error_field').length > 0) {
        return false;
    }
    else
        return true;


}