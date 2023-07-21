$(document).ready(function() {

    $('#DepohSectionGroup').show();

    $('#new').click(function() {
        location.href = 'f-hr-training-module.php'
    })

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
                    "targets" :0,
                    "orderable" : false,
                    "width" : 40,
                    "searchable" : false,
                    
                },
                {
                    "ordering" : true,
                    "targets" :1,
                    "orderable" : true,
                    "width" : 100,
                    "order": [],
                    
                },
                {
                    "orderable" : true,
                    "targets" : 2,
                    "width" : 300,                    
                },
                {
                    "orderable" : true,
                    "targets" : [3, 4, 5, 6],
                    "width" : 50,
                    "className" : "dt-body-right"
                    
                },
                {
                    "orderable" : true,
                    "targets" : 7,
                    "width" : 200,
                    "targets" : 6,
                },
                {
                    "targets" : 8,
                    "orderable" : false,
                    "searchable" : false,
                    "width" : 40,
                    "className" : "dt-body-right"

                },
                

            ],
        "ajax": "library/page/b_l-training-module.php"
    } );
});