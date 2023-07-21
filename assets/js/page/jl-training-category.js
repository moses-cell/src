$(document).ready(function() {


    $('#AdminSectionGroup').show();

    $('#new').click(function() {
    
        url = 'f-adm-training-category.php';
        openDialog(url, 350, 600, 'Admin Parameter - Training Category')
        
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
                { "ordering" : true, "targets" :0, "orderable" : true, "width" : 50, "order": []},
                { "ordering" : true, "targets" :1, "orderable" : true, "width" : 250, "order": []},
                { "ordering" : true, "targets" :2, "orderable" : true, "width" : 100, "order": []},
                { "targets" : 3, "orderable" : false, "searchable" : false, "width" : 100, "className" : "dt-body-right"},
            ],
        "ajax": "library/page/b_l-training-category.php",

    } );

   
});

function editDialog (url) {
    openDialog(url, 510, 600, 'Admin Parameter - Training Category')

}

