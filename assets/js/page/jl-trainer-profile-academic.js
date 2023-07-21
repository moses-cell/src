$(document).ready(function() {

    if ($('#pageid').val() != '')
	   load_academic_history();

})

function delete_academic_record (id) {
    if (confirm('Are you you want to delete this record!')) {

        form_data = new Array();
        form_data.push({name: 'form_process' , value: 'delete-academic'});
        form_data.push({name: 'id' , value: id});
        form_data.push({name: 'editor_name' , value: $('#editor_name').val()});
        

        $.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : 'library/page/process/p_f-hr-trainer-profile.php', //Your form processing file URL
            data    : form_data, //Forms name
            dataType: 'json',
            beforeSend: function(){
                window.scrollTo(0, 0);
                $("#loading-overlay").show();
            },
            success : function(data) {
                            $("#loading-overlay").hide();
                            if (!data.success) { //If fails
                                //alert(data.errors);
                                danger ('Process Error', data.errors) 
                            } else {
                                success ('Success', 'Record successfully deleted');
                                load_academic_history();
                                //redirect_delay(location.href);

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


        //console.log(form_data);

    }
}

function load_academic_history() {
	id = ""
	id = getUrlVars()['id'];	

	$('#academic_datatable').DataTable( {
        "processing": true,
        "destroy" : true,
        "serverSide": true,
        "searching" : true,
        "filter" : false,
        "pageLength": 25,
        "lengthChange": true,
        "scrollX": true,
        "columnDefs" : [
            { "searchable" : true},
            { "ordering" : true, "targets" :0, "orderable" : true, "width" : 50, "order": []},
            { "ordering" : true, "targets" :1, "orderable" : true, "width" : 50, "order": []},
            { "ordering" : true, "targets" :2, "orderable" : true, "width" : 150, "order": []},
            { "ordering" : true, "targets" :3, "orderable" : true, "width" : 150, "order": []},
            { "targets" : 4, "orderable" : false, "searchable" : false, "width" : 50, "className" : "dt-body-right"},
        ],
        "ajax": "library/page/b_l-trainer-profile.php?id=" + id + '&academic',
    });

}