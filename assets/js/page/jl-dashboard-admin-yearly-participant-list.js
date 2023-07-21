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

    $('#sdate').change(function() {
        update_table();
    })

    $('#edate').change(function() {
        update_table();
    })

    $('#trainingcategory').change(function() {
        update_table();
    })

    DateElement(true, getCurrentYear(), getCurrentYear(), 'sdate', '', '', new Date(new Date().getFullYear(), 0, 1), true, false, '', new Date(new Date().getFullYear(), 11, 31), false)
    DateElement(true, getCurrentYear(), getCurrentYear(), 'edate', '', '', new Date(new Date().getFullYear(), 0, 1), true, false, '', new Date(new Date().getFullYear(), 11, 31), false)

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

        dept  = $('#department').val();
        div  = $('#division').val()
        sec  = $('#section').val()
        unit  = $('#unit').val()
        cat  = $('#trainingcategory').val()

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
            "lengthChange": true,
            "scrollX": true,
            "autoWidth" : false,       
            "columnDefs" : [
                    { "searchable" : true},
                    { "targets" : 0, "orderable" : false, "searchable" : false, "width" : 30, "className" : "dt-body-left"},
                    { "ordering" : true, "targets" :1, "orderable" : true, "width" : 70,}, //Staff No
                    { "ordering" : true, "targets" :2, "orderable" : true, "width" : 150, }, //Staff Name
                    { "ordering" : true, "targets" :3, "orderable" : true, "width" : 150, }, //Division
                    { "ordering" : true, "targets" :4, "orderable" : true, "width" : 150,}, //Department
                    { "ordering" : true, "targets" :5, "orderable" : true, "width" : 150,}, //Section
                    { "ordering" : true, "targets" :6, "orderable" : true, "width" : 150, }, //Unit
                    { "ordering" : true, "targets" :7, "orderable" : true, "width" : 70, },  //Course Code
                    { "ordering" : true, "targets" :8, "orderable" : true, "width" : 150, }, //CourseName
                    { "ordering" : true, "targets" :9, "orderable" : true, "width" : 70, }, //Start Date
                    { "ordering" : true, "targets" :10, "orderable" : true, "width" : 70, }, //End Date
                    { "ordering" : true, "targets" :11, "orderable" : true, "width" : 120, }, //Training Provider
                    { "ordering" : true, "targets" :12, "orderable" : true, "width" : 70, }, //Status
                    { "ordering" : true, "targets" :13, "orderable" : true, "width" : 70, }, //Bonding
                    { "targets" : 14, "orderable" : false, "searchable" : false, "width" : 30, "className" : "dt-body-right"},
                ],
            "ajax": "library/page/b_dashboard-admin-yearly-participant-list.php?div=" + div + "&dept=" + dept + "&sec=" + sec + "&unit=" + unit + "&sdt=" + sdt + "&edt=" + edt + "&tcat=" + cat
        } );

}