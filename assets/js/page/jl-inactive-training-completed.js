$(document).ready(function() {


    $('#HRReportSectionGroup').show();

    $('.department_select').prop('disabled', true);
    $('.section_select').prop('disabled', true);
    $('.unit_select').prop('disabled', true);


    $('#division').change(function() {
        update_table();
    })

    $('#department').change(function() {
        update_table();
    })

    $('#section').change(function() {
        update_table();
    })

    $('#unit').change(function() {
        update_table();
    })

    $('#trainingcategory').change(function() {
        update_table();
    })

    $('#sdate').change(function() {

        update_table();
    })

    $('#edate').change(function() {
        update_table();
    })

    $('#trainingcategory').change(function() {
        update_table();
    })

    DateElement(true, getCurrentYear()-10, getCurrentYear(), 'sdate', '', '', '', true, false, '', new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate() -1), false)
    DateElement(true, getCurrentYear()-10, getCurrentYear(), 'edate', '', '', '', true, false, '', new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate() -1), false)


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


        dept  = $('#department').val();
        div  = $('#division').val()
        sec  = $('#section').val()
        unit  = $('#unit').val()
        cat  = $('#trainingcategory').val()


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
            { "ordering" : true, "targets" :1, "orderable" : true, "width" : 70,},
            { "ordering" : true, "targets" :2, "orderable" : true, "width" : 200, },
            { "ordering" : true, "targets" :3, "orderable" : true, "width" : 200, },
            { "ordering" : true, "targets" :4, "orderable" : true, "width" : 250,},
            { "ordering" : true, "targets" :5, "orderable" : true, "width" : 70,},
            { "ordering" : true, "targets" :6, "orderable" : true, "width" : 70, },
            { "ordering" : true, "targets" :7, "orderable" : true, "width" : 150, },
            { "ordering" : true, "targets" :8, "orderable" : true, "width" : 150, },
            { "ordering" : true, "targets" :9, "orderable" : true, "width" : 70, },
            { "ordering" : true, "targets" :10, "orderable" : true, "width" : 70, },
            { "targets" : 11, "orderable" : false, "searchable" : false, "width" : 30, "className" : "dt-body-right"},
        ],
        "ajax": "library/page/b_l-inactive-training-completed.php?div=" + div + "&dept=" + dept + "&sec=" + sec + "&unit=" + unit + "&tcat=" + cat + "&sdt=" + sdt + "&edt="+edt
    } );

}