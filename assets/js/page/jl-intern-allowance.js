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
            { "ordering" : true, "targets" :6, "orderable" : true, "width" : 70,},
            { "ordering" : true, "targets" :7, "orderable" : true, "width" : 70,},
            { "ordering" : true, "targets" :8, "orderable" : true, "width" : 70,},
            { "targets" : 9, "orderable" : false, "searchable" : false, "width" : 30, "className" : "dt-body-right"},
        ],
        "ajax": "library/page/b_l-intern-allowance.php"
    } );


    $('#new').click(function() {
        url = 'f-hr-intern-allowance.php';
        openDialog(url, "max", "max", 'Internship - Internship Allowance')      


    })

    $('#report').click(function() {
        url = 'f-report-intern-allowance.php';
        openDialog(url, "400", "500", 'Internship - Internship Allowance')      


    })

   
});

function editDialog (url) {
    openDialog(url, "max", "max", 'Internship - Internship Allowance')   
}
