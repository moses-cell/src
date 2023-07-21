$(document).ready(function() {


    $('#TrainerSectionGroup').show();

    $('#datatable').DataTable( {
        "processing": true,
        "serverSide": true,
        "searching" : true,
        "filter" : false,
        "pageLength": 25,
        "lengthChange": false,
        "scrollX": true,
        "autoWidth" : false, 
        "order": [],       
        "columnDefs" : [
                { "searchable" : true},
                {  "targets" :0, "orderable" : false, "width" : 30, },
                { "ordering" : true, "targets" :1, "orderable" : true, "width" : 70, },
                { "ordering" : true, "targets" :2, "orderable" : true, "width" : 200, },
                { "ordering" : true, "targets" :3, "orderable" : true, "width" : 250, },
                { "ordering" : true, "targets" :4, "orderable" : true, "width" : 70, },
                { "ordering" : true, "targets" :5, "orderable" : true, "width" : 70, },
                { "targets" :6, "orderable" : false, "width" : 30, },
               
            ],
        "ajax": "library/page/b_l-trainer-pending-trainer-assessment.php"
    } );
});

function editDialog (url) {
    openDialog(url, 600, 800, 'Admin Parameter - Employee Grade')

}
