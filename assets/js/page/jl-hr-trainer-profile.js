$(document).ready(function() {

    $('#HRSectionGroup').show();

    $('#new').click(function() {
        location.href = 'f-hr-trainer-profile.php'
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
                    "width" : 70,
                    "order": [],
                    
                },
                {
                    "orderable" : true,
                    "targets" : [2,3],
                    "width" : 200,                    
                },
                {
                    "orderable" : true,
                    "targets" : [4, 5],
                    "width" : 50,
                    "className" : "dt-body-right"
                    
                },
                
                

            ],
        "ajax": "library/page/b_l-trainer-profile.php"
    } );
});

//"ajax": "library/page/b_l-trainer-profile.php"
