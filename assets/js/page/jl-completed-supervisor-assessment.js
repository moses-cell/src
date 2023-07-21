$(document).ready(function() {


    $('#HRReportSectionGroup').show();

    $('#excel').attr('disabled', true);

    $('#sdate').on('change', function() {
        $('#excel').attr('disabled', true);
        $('#trainingtitle').html('');
        form_data = new FormData($('form')[0]);

        form_data.append('get_training_title' , 'GetTrainingTitle'); 
        form_data.append('sdate' , $('#sdate').val()); 
        form_data.append('edate' , $('#edate').val());        


        $.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : 'library/page/b_global_parameter.php?', //Your form processing file URL
            dataType: 'json',
            data    : form_data, //Forms name
            contentType: false,
            cache: false,
            processData:false,   
            beforeSend: function(){
                window.scrollTo(0, 0);
                $("#loading-overlay").show();
            },
            success : function(data) {
                $("#loading-overlay").hide();
                if (!data.success) { //If fails
                    //alert(data.errors);
                    danger ('Process Error', data.errors) 
                    $(this).prop('checked',false);
                } else {
                    $('#trainingtitle').html(data.trainingtitle);
                }
                            
            },
            error   : function (xhr, ajaxOptions, thrownError) {
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
    })



    DateElement(false, getCurrentYear()-10, getCurrentYear(), 'sdate', 'edate'); //, '', '', true, false, '', new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate() -1), false)


    $('#trainingtitle').on('change',function() {
        if ($(this).val() != '')
            $('#excel').attr('disabled', false);
        else
            $('#excel').attr('disabled', true);
        
         update_table();
    })

     update_table();

});



function update_table () {

        var sdt = '';
        var edt = '';
        var title = '';

        if ($('#sdate').val() != '') {
            dt = Convert_to_Date($('#sdate').val(),"dd-mm-yyyy")
            sdt = +new Date(dt);

        }

        if ($('#edate').val() != '') {
            dt = Convert_to_Date($('#edate').val(),"dd-mm-yyyy")
            edt = +new Date(dt);
        }

        title  = $("#trainingtitle option:selected").val(); //$('#trainingtitle').val()
        //alert(title);
	title = encodeURIComponent(title);



    $('#datatable').DataTable( {
        "processing": true,
        "destroy" : true,
        "serverSide": true,
        "searching" : true,
        "filter" : false,
        "pageLength": 50,
        "lengthChange": false,
        "scrollX": true,
        "autoWidth" : false,       
        "columnDefs" : [
                { "searchable" : true},
                { "targets" : 0, "orderable" : false, "searchable" : false, "width" : 30, "className" : "dt-body-left"},
                { "ordering" : true, "targets" :1, "orderable" : true, "width" : 70,},
                { "ordering" : true, "targets" :2, "orderable" : true, "width" : 250, },
                { "ordering" : true, "targets" :3, "orderable" : true, "width" : 250, },
                { "ordering" : true, "targets" :4, "orderable" : true, "width" : 130, },
                { "ordering" : true, "targets" :5, "orderable" : true, "width" : 130, },
                { "ordering" : true, "targets" :6, "orderable" : true, "width" : 200, },
                { "ordering" : true, "targets" :7, "orderable" : true, "width" : 130, },
                { "ordering" : true, "targets" :8, "orderable" : true, "width" : 30,  "className" : "dt-body-right"},
                
            ],
        "ajax": "library/page/b_l-completed-supervisor-assessment.php?sdt=" + sdt + "&edt="+edt + '&title=' + title
    } );

}