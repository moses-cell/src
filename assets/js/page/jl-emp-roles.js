
$(document).ready(function() {


    $('#AdminSectionGroup').show();

    $('#new').click(function() {
    
        url = 'f-adm-emp-roles.php';
        openDialog(url, 450, 600, 'Admin Employee Roles - Employee Ssytem Roles')
    })


    $('.openCompetency').on('click',function(){

        email = $(this).attr('email');
        pg = $(this).attr('pg');
        sn = $(this).attr('sn');
        y = $(this).attr('y');

        url = 'competency.php?pg=' + pg + '&email=' + email + '&y=' + y + '&sn=' + sn;
        //alert(url);

        //url = 'competency.php?pg=E0RSNCtTQjuS8kS67BRwiVjbD_Jc1X2apdsZQOxt7jpsRxqM-wo6Zr8hELDWdieWEXZFyunmSjN9l43vMOO4Zeitgmky4Whe77Bta_tLnMo=&email=5ICashTeSfaweufZrANfzBVnC_WiJAPOrNzN2VTvQyogpVmHnKGE58M_96EaQdBM2gZh_DWXgcimGpzN4oCnS74vapqFHBlNIMJVC2NG-ok=&y=9Kr-qFOkBbYhDIsU9qaJd_aCT_3icUH9Obf5ImP5aU_0d_SDX5tqNkTl7cfnAtTZ09CxQ2KRCGv7N4pX3qQMjQ==&sn=Xs8jOIpNaMeEgcAq1nGo6L1BeQ4828ej0vE3L1G0aKptOTQtHTKDy941PIAjW1FHF6nb5aKvEZ6RwvM-AW_dDg=='
        $('.modal-body').load(url,function(){
            $('#myModal').modal({show:true});
        });

       
    });

    $('#datatable').DataTable( {
        "processing": true,
        "serverSide": true,
        "searching" : true,
        "filter" : false,
        "pageLength": 25,
        "lengthChange": true,
        "scrollX": true,
        "columnDefs" : [
                {
                    "searchable" : true,
                },
                {
                    "ordering" : true,
                    "targets" :0,
                    "orderable" : true,
                    "width" : 100,
                    "order": [],
                    
                },
                {
                    "ordering" : true,
                    "targets" :2,
                    "orderable" : true,
                    "width" : 150,
                    "order": [],
                    
                },
                {
                    "targets" : 3,
                    "orderable" : false,
                    "searchable" : false,
                    "width" : 100,
                    "className" : "dt-body-right"

                },
                

            ],
        "ajax": "library/page/b_l-emp-roles.php"
    } );
});

function editDialog (url) {
    openDialog(url, 450, 600, 'Admin Employee Roles - Employee System Roles')

}

function deleterecord (id) {
    if (confirm('Are you you want to delete this record!')) {

        form_data = new Array();
        form_data.push({name: 'form_process' , value: 'delete'});
        form_data.push({name: 'id' , value: id});
        form_data.push({name: 'editor_name' , value: id});
        

        $.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url     : 'library/page/process/p_f-adm-emp-roles.php', //Your form processing file URL
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
                                redirect_delay(location.href);
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