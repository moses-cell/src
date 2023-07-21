
$(document).ready(function() {


    $('#AdminSectionGroup').show();

    $('#new').click(function() {
    
        url = 'f-adm-training-provider.php';
        openDialog(url, 510, 600, 'Admin Parameter - Training Provider')
        
    })

    $('#newlocation').click(function() {
        url = 'f-adm-training-location.php';
        openDialog(url, 'max', 'max', 'Admin Parameter - Training Location')      
    })


    $('#datatable').DataTable( {
        "processing": true,
        "serverSide": true,
        "searching" : true,
        "filter" : false,
        "pageLength": 25,
        "lengthChange": true,
        "scrollX": true,
        "autoWidth" : false,
        "columnDefs" : [
                { "searchable" : true},
                { "ordering" : true, "targets" :0, "orderable" : true, "width" : 70, "order": []},
                { "ordering" : true, "targets" :1, "orderable" : true, "width" : 150, "order": []},
                { "ordering" : true, "targets" :2, "orderable" : true, "width" : 250, "order": []},
                { "ordering" : true, "targets" :3, "orderable" : true, "width" : 100, "order": []},
                { "targets" : 4, "orderable" : false, "searchable" : false, "width" : 100, "className" : "dt-body-right"},
            ],
        "ajax": "library/page/b_l-training-provider.php"
    } );


   
});

function editDialog (url) {
    openDialog(url, 510, 600, 'Admin Parameter - Training Provider')

}

function editDialogLocation (url) {
    bCloseOnly = true;
    openDialog(url, 'max', 'max', 'Admin Parameter - Training Location',bCloseOnly)

}
