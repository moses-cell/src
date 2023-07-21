
$(document).ready(function() {


    $('#AdminSectionGroup').show();

    $('#new').click(function() {
    
        /*location.href = 'f-adm-emp-grade.php'
        email = $(this).attr('email');
        pg = $(this).attr('pg');
        sn = $(this).attr('sn');
        y = $(this).attr('y');*/

        url = 'f-adm-emp-grade.php';
        openDialog(url, 420, 400, 'Admin Parameter - Employee Grade')
        //location.href = url;
        //alert(url);

        //modalWin.ShowURL(url  ,420, 400,'Invoice & Bill Tracking - Account Detail : Budget Detail',CloseDialog,null);
        //url = 'competency.php?pg=E0RSNCtTQjuS8kS67BRwiVjbD_Jc1X2apdsZQOxt7jpsRxqM-wo6Zr8hELDWdieWEXZFyunmSjN9l43vMOO4Zeitgmky4Whe77Bta_tLnMo=&email=5ICashTeSfaweufZrANfzBVnC_WiJAPOrNzN2VTvQyogpVmHnKGE58M_96EaQdBM2gZh_DWXgcimGpzN4oCnS74vapqFHBlNIMJVC2NG-ok=&y=9Kr-qFOkBbYhDIsU9qaJd_aCT_3icUH9Obf5ImP5aU_0d_SDX5tqNkTl7cfnAtTZ09CxQ2KRCGv7N4pX3qQMjQ==&sn=Xs8jOIpNaMeEgcAq1nGo6L1BeQ4828ej0vE3L1G0aKptOTQtHTKDy941PIAjW1FHF6nb5aKvEZ6RwvM-AW_dDg=='
        //$('.modal-body').load(url,function(){
        //    $('#myModal').modal({show:true});
          //  $('#myModal').modal('show')
        //});
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
        "ajax": "library/page/b_l-emp-grade.php"
    } );
});

function editDialog (url) {
    openDialog(url, 420, 400, 'Admin Parameter - Employee Grade')

}
