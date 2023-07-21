$(document).ready(function() {

    $('#HRSectionGroup').show();

    $('#new').click(function() {
        location.href = 'f-hr-training-module.php'
    })

    $('#training_calendar').click(function() {
        location.href = 'l-hr-training-calendar.php'
    })

    $('#import').click(function() {
        url = 'f-upload-training-schedule.php';
        openDialog(url, 420, 600, 'Training Schedule - Data Upload')
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

    DateElement(true, getCurrentYear(), getCurrentYear()+1, 'sdate', '', '', Date.now(), true)
    DateElement(true, getCurrentYear(), getCurrentYear()+1, 'edate', '', '', Date.now(), true)

    update_table();
});

function update_table () {

        var sdt = '';
        var edt = '';
        var cat = '';
        if ($('#sdate').val() != '') {
            dt = Convert_to_Date($('#sdate').val(),"dd-mm-yyyy")
            sdt = +new Date(dt);

        }

        if ($('#edate').val() != '') {
            dt = Convert_to_Date($('#edate').val(),"dd-mm-yyyy")
            edt = +new Date(dt);
        }

        cat = $('#trainingcategory').val();

        $('#datatable').DataTable( {
        "processing": true,
        "destroy" : true,
        "serverSide": true,
        "searching" : true,
        "filter" : false,
        "pageLength": 25,
        "lengthChange": true,
        "scrollX": true,
        "autoWidth": true,
        "columnDefs" : [
            { "searchable" : true,},
            { "targets" :0, "orderable" : false, "searchable" : false, "width" : 30,},
            { "ordering" : true, "targets" :1, "orderable" : true, "width" : 100, "order": [],},
            { "orderable" : true, "targets" : [2], "width" : 250, },
            { "targets" : [3, 4], "orderable" : true, "searchable" : false,  "width" : 100, "className" : "dt-body-center" },
            { "orderable" : true, "targets" : [5, 6,7, 8], "width" : 50, "className" : "dt-body-right"},
            { "orderable" : true, "targets" : 9, "width" : 100,  },
            { "targets" : 10,  "visible" : false, },
            { "targets" : 11, "orderable" : false, "searchable" : false, "width" : 30, "className" : "dt-body-right",},
        ],
        /*rowCallback: function ( row, data ) {

            if (data[10] == '0') {
                $(row).css('background-color', ' rgba(255, 0, 0, 0)');
            } else {

                if (moment(data[3], 'DD-MM-YYYY') < moment()) {
                    //$(row).css('background-color', ' rgba(255, 0, 0, 0.2)');
                    $(row).css('background-color', ' rgba(255, 0, 0, 0)');
                } else if (data[3] == '') {
                    $(row).css('background-color', ' rgba(255, 0, 0, 0)');
                } 
                else {
                    $(row).css('background-color', '#012970');
                    $(row).css('color', '#fff');
                }
            }  
            
        }, */
        "ajax": "library/page/b_l-traininglist.php?sdt=" + sdt + "&edt="+edt + "&tcat=" + cat,
    } );

}