$(document).ready(function(){

    $('#AdminSectionGroup').show();

    page_path = $(location).attr('pathname');
    if (page_path.indexOf("l-country.php") >= 0) {

        //form_data = [];
        form_data = {'process' : 'list_country'};

        $('#datatable').DataTable( {
            "processing": true,
            "serverSide": true,
            "searching" : true,
            "filter" : true,
            "pageLength": 50,
            "lengthChange": false,
            "columnDefs" : [
                {
                    "searchable" : true,
                },
                {
                    "ordering" : true,
                    "targets" :0,
                    "orderable" : true,
                    "order": [],
                    
                },
                {
                    "orderable" : true,
                    "targets" : [0, 1],
                    
                },
                {
                    "targets" : 2,
                    "orderable" : false,
                    "searchable" : false,
                },
                
            ],
            "ajax": {
                "url" : "library/page/b_country.php?list",
                "data" : form_data,
                "type" : "POST"
            }
        });
    }

    $('#reset').click(function() {
        location.reload();
    })

    $('#new').click(function() {
        location.href = 'f-country.php';
    })

    $('#save').click(function() {

        $('.error_field').remove();

        validateElement('text', 'fcountry' ,'countrycode', 'Please enter country code');
        validateElement('text', 'fcountry' ,'country', 'Please enter country name');


        if ($('.error_field').length > 0)
            return false;
        else {

            form_data = $("#fcountry").serializeArray();
            form_data.push({name: 'process' , value: 'save_country'});

            $.ajax({ //Process the form using $.ajax()
                type    : 'POST', //Method type
                url     : '/prasarana2/library/page/b_country.php', //Your form processing file URL
                data    : form_data, //Forms name
                dataType: 'json',
                success : function(data) {
                    if (!data.success) { //If fails
                        if (data.errors == 'Your session had expired') {
                            alert(data.errors);
                            location.href = root_page;
                            return;    
                        }
                        alert(data.errors);
                    } else {
                        alert('record saved.');
                        location.href = 'f-country.php';

                    }
                    
                }, error    : function (xhr, ajaxOptions, thrownError) {
                    $("#loading-overlay").hide();
                    console.log(xhr.status);
                    console.log(xhr.responseText);
                    console.log(thrownError);
                    console.log('There is unknown error occurs. Please contact administrator for system verification');
                    console.log(xhr.responseText);
                }
            })


        }

            //$('#setting').submit();



    })


    if (page_path.indexOf("f-country.php") >= 0) {

        if ($('#id').val() == '')
            return;

        form_data = [];
        form_data.push({name: 'process' , value: 'get_country'});
        form_data.push({name: 'id' , value: $('#id').val()});


        $.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : '/prasarana2/library/page/b_country.php', //Your form processing file URL
            data    : form_data, //Forms name
            dataType: 'json',
                success : function(data) {
                    if (!data.success) { //If fails
                        alert(data.errors);
                    } else {
                        rec = data.data[0];
                        //$('#id').val(rec.id);
                        $('#countrycode').val(rec.country_code);
                        $('#country').val(rec.country_name);
                    }
                    
                }, error    : function (xhr, ajaxOptions, thrownError) {
                    $("#loading-overlay").hide();
                    console.log(xhr.status);
                    console.log(xhr.responseText);
                    console.log(thrownError);
                    console.log('There is unknown error occurs. Please contact administrator for system verification');
                    console.log(xhr.responseText);
                }
        })

    }


})

