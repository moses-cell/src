$(document).ready(function() {


    $('#HRReportSectionGroup').show();

    $('#datatable').DataTable( {
        "processing": true,
        "serverSide": true,
        "searching" : true,
        "filter" : false,
        "pageLength": 25,
        "lengthChange": false,
        "scrollX": true,
        "autoWidth" : false,        
        "columnDefs" : [
                { "searchable" : true},
                { "ordering" : true, "targets" :0, "orderable" : true, "width" : 100, "order": []},
                { "ordering" : true, "targets" :1, "orderable" : true, "width" : 100, "order": []},
                { "ordering" : true, "targets" :2, "orderable" : true, "width" : 250, "order": []},
                { "ordering" : true, "targets" :3, "orderable" : true, "width" : 70, "order": []},
                { "ordering" : true, "targets" :4, "orderable" : true, "width" : 70, "order": []},
            ],
        "ajax": "library/page/b_l-pending-training-evaluation.php"
    } );
});

