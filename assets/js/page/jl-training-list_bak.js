$(document).ready(function() {

    $('#HRSectionGroup').show();

    $('#datatable').DataTable( {
        "processing": true,
        "serverSide": true,
        "searching" : true,
        "filter" : false,
        "pageLength": 25,
        "lengthChange": true,
        "scrollX": true,
        "autoWidth": false,
        "columnDefs" : [
            { "searchable" : true},
            { "ordering" : true, "targets" :0, "orderable" : true, "width" : 100, "order": []},
            { "ordering" : true, "targets" :1, "orderable" : true, "width" : 150, "order": []},
            { "ordering" : true, "targets" :2, "orderable" : true, "width" : 50, "order": []},
            { "ordering" : true, "targets" :3, "orderable" : true, "width" : 70, "order": []},
            { "targets" : 9, "orderable" : false, "searchable" : false, "width" : 50, "className" : "dt-body-right"},
        ],
        
        "ajax": "library/page/b_l-traininglist.php"
    } );


   

});