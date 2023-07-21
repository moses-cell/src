
$(document).ready(function() {


    $('#AdminSectionGroup').show();

    $('#newlocation').click(function() {
        url = 'f-adm-training-location.php';
        openDialog(url, "max", "max", 'Admin Parameter - Training Location')      
    })



    prov_id = getUrlVars()['prov_id'];
    if (prov_id !== undefined) {
        $('#datatable').DataTable( {
            "processing": true,
            "serverSide": true,
            "searching" : true,
            "filter" : false,
            "pageLength": 25,
            "lengthChange": true,
            "scrollX": true,
            "columnDefs" : [
                    { "searchable" : true},
                    { "ordering" : true, "targets" :0, "orderable" : true, "width" : 100, "order": []},
                    { "ordering" : true, "targets" :1, "orderable" : true, "width" : 150, "order": []},
                    { "ordering" : true, "targets" :2, "orderable" : true, "width" : 300, "order": []},
                    { "ordering" : true, "targets" :3, "orderable" : true, "width" : 70, "order": []},
                    { "targets" : 4, "orderable" : false, "searchable" : false, "width" : 50, "className" : "dt-body-right"},
                ],
            "ajax": "library/page/b_l-training-location.php?prov_id=" + prov_id,
        } );    

    } else  {
        $('#datatable').DataTable( {
            "processing": true,
            "serverSide":  true,
            "searching" : true,
            "filter" : true,
            "pageLength": 25,
            "lengthChange": true,
            "scrollX": true,
            "autoWidth" : false,
            "columnDefs" : [
                    { "searchable" : true},
                    { "ordering" : true, "targets" :0, "orderable" : true, "width" : 70, "order": []},
                    { "ordering" : true, "targets" :1, "orderable" : true, "width" : 150, "order": []},
                    { "ordering" : true, "targets" :2, "orderable" : true, "width" : 70, "order": []},
                    { "ordering" : true, "targets" :3, "orderable" : true, "width" : 150, "order": []},
                    { "ordering" : true, "targets" :6, "orderable" : true, "width" : 70, "order": []},
                    { "targets" : 7, "orderable" : false, "searchable" : false, "width" : 50, "className" : "dt-body-right"},
                ],
            "ajax": "library/page/b_l-training-location.php",
        } );    

    }

   
    
});

function editDialog (url) {
    openDialog(url, "max", "max", 'Admin Parameter - Training Location')

}
