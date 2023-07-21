$(document).ready(function() {

//    $('#StaffSectionGroup').show();

   // alert(location.href)
    ref = location.href; 
    if (ref.indexOf('l-my-staff-unit.php') > 0) {
        $('#SecSectionGroup').show();

    } else if (ref.indexOf('l-my-staff-depoh.php') > 0) {
        $('#DepohSectionGroup').show();

    } else {
        $('#StaffSectionGroup').show();
        $('#MyStaffGroup-nav').addClass('show')     
    }


   
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
                { "ordering" : true, "targets" :1, "orderable" : true, "width" : 100, "order": []},
                { "ordering" : true, "targets" :2, "orderable" : true, "width" : 250, "order": []},
                { "ordering" : true, "targets" :3, "orderable" : true, "width" : 250, "order": []},
                { "ordering" : true, "targets" :4, "orderable" : true, "width" : 250, "order": []},
                { "ordering" : true, "targets" :5, "orderable" : true, "width" : 250, "order": []},
                { "ordering" : true, "targets" :6, "orderable" : true, "width" : 250, "order": []},
                { "ordering" : true, "targets" :7, "orderable" : true, "width" : 250, "order": []},
                { "ordering" : true, "targets" :8, "orderable" : true, "width" : 250, "order": []},
                { "ordering" : true, "targets" :9, "orderable" : true, "width" : 80, "order": []},
                { "ordering" : true, "targets" :10, "orderable" : true, "width" : 250, "order": []},
                { "ordering" : true, "targets" :11, "orderable" : true, "width" : 250, "order": []},
                { "ordering" : true, "targets" :12, "orderable" : true, "width" : 250, "order": []},
                { "ordering" : true, "targets" :13, "orderable" : true, "width" : 250, "order": []},
                { "ordering" : true, "targets" :14, "orderable" : true, "width" : 50, "order": []},
                { "targets" : 15, "orderable" : false, "searchable" : false, "width" : 30, "className" : "dt-body-right"},
            ],
        "ajax": "library/page/b_l-my-staff-profile.php"
    } );


    $('#add').click(function() {
        url = 'f-new-staff.php?id=' + $('#pageid').val();
        openDialog(url, 'max', 'max', 'Prasarana Employee - Add New')

    })
});

