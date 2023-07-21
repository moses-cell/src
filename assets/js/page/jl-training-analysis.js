$(document).ready(function() {


    $('#HRReportSectionGroup').show();

    $('#year').change(function() {
        if ($(this).val() == '') {
            $('.division_select').prop('disabled', true);
            $('.department_select').prop('disabled', true);
            $('.section_select').prop('disabled', true);
            $('.unit_select').prop('disabled', true);
        } else {
            $('.division_select').prop('disabled', false);
            $('.department_select').prop('disabled', true);
            $('.section_select').prop('disabled', true);
            $('.unit_select').prop('disabled', true);
        }
    })

    $('#generate_excel').click(function() {

        $('.error_field').remove();

        validateElement('select','','year', 'Please select year for TNA report');
        validateElement('text','','division', 'Please select division for TNA report');
        if ($('.error_field').length > 0) {
            return false;
        }

        var cat = '';
        var div = '';
        var dept = '';
        var sec = '';
        var unit = '';
        var year = '';

        dept  = $('#department').val();
        div  = $('#division').val()
        sec  = $('#section').val()
        unit  = $('#unit').val()
        cat  = $('#trainingcategory').val()
        y = $('#year').val();

    
        //location.href = 'report.xls.php?y=' + y + "&div=" + div + "&dept=" + dept + "&sec=" + sec + "&unit=" + unit + "&tcat=" + cat ;

        form_data = $("#data_form").serializeArray();
        form_data.push({name: 'form_process' , value: 'tna report'});

        $.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : 'library/page/b_tna-report.php', //Your form processing file URL
            data    : form_data, //Forms name
            dataType: 'json',
            cache: false,
            beforeSend: function(){
                window.scrollTo(0, 0);
                $("#loading-overlay").show();
            },
            success : function(data) {
                $("#loading-overlay").hide();
                if (!data.success) { //If fails
                    //alert(data.errors);
                    danger ('Process Error', "There is unknown error occurs. Please contact administrator for system verification");
                } else {
                    location.href = 'report.xls.php?y=' + y + "&div=" + div + "&dept=" + dept + "&sec=" + sec + "&unit=" + unit + "&tcat=" + cat ;
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


    $('.division_select').prop('disabled', true);
    $('.department_select').prop('disabled', true);
    $('.section_select').prop('disabled', true);
    $('.unit_select').prop('disabled', true);


    $('#division').change(function() {
        get_Position();
    })

    $('#department').change(function() {
    })

    $('#section').change(function() {
    })

    $('#unit').change(function() {
    })

    $('#trainingcategory').change(function() {
    })



   
});

function get_Position() {

    form_data = $("#data_form").serializeArray();
    form_data.push({name: 'get_position_tna_division' , value: true});

    $.ajax({ //Process the form using $.ajax()
        type    : 'POST', //Method type
        url     : 'library/page/b_global_parameter.php', //Your form processing file URL
        data    : form_data, //Forms name
        dataType: 'json',
        cache: false,
        beforeSend: function(){
            window.scrollTo(0, 0);
            $("#loading-overlay").show();
        },
        success : function(data) {
            $("#loading-overlay").hide();
            if (!data.success) { //If fails
                //alert(data.errors);
                danger ('Process Error', "There is unknown error occurs. Please contact administrator for system verification");
                $('#Position').html('');
            } else {
                $('#Position').html(data.div)
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




}