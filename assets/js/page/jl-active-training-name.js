$(document).ready(function() {


    $('#HRReportSectionGroup').show();


    update_table();

    $('.name_select').keyup(function() {
        
        width = $(this).innerWidth();
        select_name_click = false;
        if ($(this).val().length >= 1) {
            $.ajax({
                type: "POST",
                url: "library/page/b_global_parameter.php",
                data:'staff_name='+$(this).val(),
                success: function(data){
                    $("#staff_list").show();
                    $("#staff_list").html(data);
                    $("#staff_list").width(width);
                    $("#staff_list").css("background","#FFF");
                }
            });
        }
    }).focusout(function() {
        setTimeout(function () {
            /*if (select_name_click == false) {
                $('#staff_name').val('');
                display_staff_training();    
            }*/
            $('.staff_list').hide();
            update_table();
        },250)
    }).siblings().on('click','li', function() {
        
        select_name_click = true;
        id = $(this).parent().parent().attr('id');
        $('#staff_name').val($(this).html());
        
        $('.staff_list').hide()
        update_table();

    }).on('keydown',function() {
        if ($(this).val() == '') {
            update_table();
        }
    })

     $('#reset').click(function() {
        location.reload();
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

    DateElement(true, getCurrentYear(), getCurrentYear(), 'sdate', '', '', new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate()), true, false, '', '', false)
    DateElement(true, getCurrentYear(), getCurrentYear(), 'edate', '', '', new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate()), true, false, '', '', false)

});

function update_table() {

    staff_name  = $('#staff_name').val()
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
        "ajax": "library/page/b_l-active-training-name.php?staff_name=" + staff_name + "&sdt=" + sdt + "&edt="+edt
    } );

}
