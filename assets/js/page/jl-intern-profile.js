$(document).ready(function() {


    $('#InternSectionGroup').show();


    $('#datatable').DataTable( {
        "processing": true,
        "destroy" : true,
        "serverSide": true,
        "searching" : true,
        "filter" : false,
        "pageLength": 50,
        "lengthChange": false,
        "scrollX": true,
        "autoWidth" : false,       
        "columnDefs" : [
            { "searchable" : true},
            { "targets" : 0, "orderable" : false, "searchable" : false, "width" : 30, "className" : "dt-body-left"},
            { "ordering" : true, "targets" :1, "orderable" : true, "width" : 200,},
            { "ordering" : true, "targets" :2, "orderable" : true, "width" : 100, },
            { "ordering" : true, "targets" :3, "orderable" : true, "width" : 200, },
            { "ordering" : true, "targets" :4, "orderable" : true, "width" : 70,},
            { "ordering" : true, "targets" :5, "orderable" : true, "width" : 70,},
            { "targets" : 6, "orderable" : false, "searchable" : false, "width" : 30, "className" : "dt-body-right"},
        ],
        "ajax": "library/page/b_l-intern-profile.php"
    } );


    $('#new').click(function() {
        location.href = 'f-hr-intern-profile.php';
    })

});

