$(document).ready(function() {


    $('#HRReportSectionGroup').show();

    $('#sdate').change(function() {

        update_table();
    })

    $('#edate').change(function() {
        update_table();
    })

    $('#trainingcategory').change(function() {
        update_table();
    })

    DateElement(true, getCurrentYear(), getCurrentYear(), 'sdate', '', '', new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate()), true, false, '', '', false)
    DateElement(true, getCurrentYear(), getCurrentYear(), 'edate', '', '', new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate()), true, false, '', '', false)


    update_table();


});

function update_table () {

        var sdt = '';
        var edt = '';
        var cat = '';
        var div = '';
        var dept = '';
        var sec = '';
        var unit = '';

        if ($('#sdate').val() != '') {
            dt = Convert_to_Date($('#sdate').val(),"dd-mm-yyyy")
            sdt = +new Date(dt);

        }

        if ($('#edate').val() != '') {
            dt = Convert_to_Date($('#edate').val(),"dd-mm-yyyy")
            edt = +new Date(dt);
        }

    $('#datatable').DataTable( {
        "processing": true,
        "destroy" : true,
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
            { "ordering" : true, "targets" :1, "orderable" : true, "width" : 150,},
            { "ordering" : true, "targets" :2, "orderable" : true, "width" : 150, },
            { "ordering" : true, "targets" :3, "orderable" : true, "width" : 150, },
            { "ordering" : true, "targets" :4, "orderable" : true, "width" : 150,},
            { "ordering" : true, "targets" :5, "orderable" : true, "width" : 70,},
            { "ordering" : true, "targets" :6, "orderable" : true, "width" : 70, },
            { "ordering" : true, "targets" :7, "orderable" : true, "width" : 150, },
            { "targets" : 8, "orderable" : false, "searchable" : false, "width" : 30, "className" : "dt-body-right"},
        ],
        "ajax": "library/page/b_l-active-training-external.php"+ "?sdt=" + sdt + "&edt="+edt
    } );


}
