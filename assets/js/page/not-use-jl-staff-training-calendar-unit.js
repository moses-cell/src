$(document).ready(function() {

    $('#SecSectionGroup').show();


    get_calendar();

    $('#trainingcategory').change(function() {
        get_calendar();
    })

});


function get_calendar() {
    "use strict";

    var cat = $('#trainingcategory').val();
    var options = "";
    var list = $('#eventlist');
    list.html('');
    
    options = {                      
        events_source: 'library/page/b_c-staff-training-calendar.php?cat=' + cat,
        view: 'month',
        tmpl_path: "tmpls/",
        tmpl_cache: false,
        day: formatdate('today', 2, 'date-only'),
        onAfterEventsLoad: function(events) {
            if(!events) {
                return;
            }
            var list = $('#eventlist');
            list.html('');

            $.each(events, function(key, val) {
                
                $(document.createElement('li'))
                    .addClass('mb-4')
                    .html('<span style="color:red; ">' + val.start_date + ' - ' + val.end_date  + '&nbsp;<a href="' + val.url + '">' +  val.title + '</a></span>')
                    .appendTo(list);
            });
        },
        onAfterViewLoad: function(view) {
            $('.page-header h4').text(this.getTitle());
            $('.btn-group button').removeClass('active');
            $('button[data-calendar-view="' + view + '"]').addClass('active');
        },
        classes: {
            months: {
                general: 'label'
            }
        }
    };
    var calendar = $('#showEventCalendar').calendar(options);
    $('.btn-group button[data-calendar-nav]').each(function() {
        var $this = $(this);
        $this.click(function() {
            calendar.navigate($this.data('calendar-nav'));
        });
    });
    $('.btn-group button[data-calendar-view]').each(function() {
        var $this = $(this);
        $this.click(function() {
            calendar.view($this.data('calendar-view'));
        });
    });
    $('#first_day').change(function(){
        var value = $(this).val();
        value = value.length ? parseInt(value) : null;
        calendar.setOptions({first_day: value});
        calendar.view();
    });
    $('#language').change(function(){
        calendar.setLanguage($(this).val());
        calendar.view();
    });
    $('#events-in-modal').change(function(){
        var val = $(this).is(':checked') ? $(this).val() : null;
        calendar.setOptions({modal: val});
    });
    $('#format-12-hours').change(function(){
        var val = $(this).is(':checked') ? true : false;
        calendar.setOptions({format12: val});
        calendar.view();
    });
    $('#show_wbn').change(function(){
        var val = $(this).is(':checked') ? true : false;
        calendar.setOptions({display_week_numbers: val});
        calendar.view();
    });
    $('#show_wb').change(function(){
        var val = $(this).is(':checked') ? true : false;
        calendar.setOptions({weekbox: val});
        calendar.view();
    }); 
    $('#trainingcategory').change(function(){
         var cat = $('#trainingcategory').val();
        calendar.setOptions({events_source: 'library/page/b_c-staff-training-calendar.php?cat=' + cat})
        //var calendar = $('#showEventCalendar').calendar(options);
        //calendar._loadEvents();
        calendar.view();
    }); 

}