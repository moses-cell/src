$(document).ready(function() {


    $('#StaffSectionGroup').show();

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
                { "targets" : 0, "orderable" : false, "searchable" : false, "width" : 30, "className" : "dt-body-left"},
                { "ordering" : true, "targets" :1, "orderable" : true, "width" : 150, "order": []},
                { "ordering" : true, "targets" :2, "orderable" : true, "width" : 160, "order": []},
                { "ordering" : true, "targets" :3, "orderable" : true, "width" : 70, "order": []},
                { "ordering" : true, "targets" :4, "orderable" : true, "width" : 70, "order": []},
                { "ordering" : true, "targets" :5, "orderable" : true, "width" : 70, "order": []},
                { "ordering" : true, "targets" :6, "orderable" : true, "width" : 150, "order": []},
                { "targets" : 7, "orderable" : false, "searchable" : false, "width" : 30, "className" : "dt-body-right"},
            ],
        "ajax": "library/page/b_l-my-trainer-assessment.php"
    } );
});

