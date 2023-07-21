$(document).ready(function() {

    query = window.location.search;

    $('#datatable').DataTable( {
        "processing": true,
        "serverSide": true,
        "searching" : true,
        "filter" : false,
        "pageLength": 10,
        "lengthChange": false,
        "scrollX": true,
        "columnDefs" : [
            {"searchable" : true,},
            {"orderable" : false, "targets" : 0, "width" : 100, "className" : "dt-body-center", "searchable" : false,},
            {"targets" :1, "orderable" : false, "width" : 70, "searchable" : true,},
            {"orderable" : true, "targets" : [2,3,4,5,6,], "width" : 120,},
            {"orderable" : true, "targets" : [7,8], "width" : 120, "searchable" : true,},
            {"orderable" : false, "targets" : 9, "width" : 100, "className" : "dt-body-center", "searchable" : false,},
        ],
        "ajax": "library/page/b_l-hr-new-participant-list.php" + query
    });

    $("#datatable").on("click", ".add_participant", function(){

        postform = new Array();

        postform.push ({name: 'form_process' , value: "Save"});
        postform.push ({name: 'pageid' , value: $('#pageid').val()});
        postform.push ({name: 'editor_name' , value: $('#editor_name').val()});
        postform.push ({name: 'staff_no' , value: $(this).val()});

        $.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : 'library/page/process/p_f-hr-new-participant.php', //Your form processing file URL
            data    : postform, //Forms name
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
                    success ('Success', 'Training successfully register / submit for approval');
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

    $("#datatable").on("click", ".update_profile", function(){
        supervisor = $(this).attr('super');

        location.href='f-hr-update-staff-profile.php?id='+$(this).val() + '&pageid=' + $('#pageid').val() + '&super='+ supervisor;
    })

    $('#close_dialog').click(function(e) {
            window.parent.HideModalWindow();

    })

});

//"ajax": "library/page/b_l-trainer-profile.php"
