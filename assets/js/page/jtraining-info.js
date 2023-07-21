prosoft = {

  presentationAnimations: function() {
    $(function() {

      var $window = $(window),
        isTouch = Modernizr.touch;

      if (isTouch) {
        $('.add-animation').addClass('animated');
      }

      $window.on('scroll', revealAnimation);

      function revealAnimation() {
        // Showed...
        $(".add-animation:not(.animated)").each(function() {
          var $this = $(this),
            offsetTop = $this.offset().top,
            scrolled = $window.scrollTop(),
            win_height_padded = $window.height();
          if (scrolled + win_height_padded > offsetTop) {
            $this.addClass('animated');
          }
        });
        // Hidden...
        $(".add-animation.animated").each(function(index) {
          var $this = $(this),
            offsetTop = $this.offset().top;
          scrolled = $window.scrollTop(),
            windowHeight = $window.height();

          win_height_padded = windowHeight * 0.8;
          if (scrolled + win_height_padded < offsetTop) {
            $(this).removeClass('animated')
          }
        });
      }

      revealAnimation();
    });

  },

  initDateTimePicker: function() {
    $('.datetimepicker').datetimepicker({
      icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
      }
    });
  },


  initPickColor: function() {
    $('.pick-class-label').click(function() {
      var new_class = $(this).attr('new-class');
      var old_class = $('#display-buttons').attr('data-class');
      var display_div = $('#display-buttons');
      if (display_div.length) {
        var display_buttons = display_div.find('.btn');
        display_buttons.removeClass(old_class);
        display_buttons.addClass(new_class);
        display_div.attr('data-class', new_class);
      }
    });
  },

  initFormWizard: function() {
    
    // Code for the Validator
    /*var $validator = $('.card-wizard form').validate({

      rules: {
       /* firstname: {
          required: true,
          minlength: 3
        },
        lastname: {
          required: true,
          minlength: 3
        },
        email: {
          required: true,
          minlength: 3,
        },
        title: {
          required: true,
          minlength: 3,
        }
      }, messages: {
        title: {
          required: "Please enter a roles name",
          minlength: "roles name must at least 3 characters"
        },
      },

      highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
      },
      success: function(element) {
        $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
      },
      errorPlacement: function(error, element) {
        $(element).append(error);
      }
    });   */ 

    // Wizard Initialization
    $('.card-wizard').bootstrapWizard({
      'tabClass': 'nav nav-pills',
      'nextSelector': '.btn-next',
      'previousSelector': '.btn-previous',

      onNext: function(tab, navigation, index) {
        var $valid = $('.card-wizard form').valid();
        if (!$valid) {
          //$validator.focusInvalid();
          //validator.focusInvalid();
          return false;
        }
      },
      onPrevious: function(tab, navigation, index) {
        var $valid = $('.card-wizard form').valid();
        if (!$valid) {
          return false;
        }
      },

      onInit: function(tab, navigation, index) {
        //check number of tabs and fill the entire row
        var $total = navigation.find('li').length;
        var $wizard = navigation.closest('.card-wizard');

        $first_li = navigation.find('li:first-child a').html();
        $moving_div = $('<div class="moving-tab">' + $first_li + '</div>');
        $('.card-wizard .wizard-navigation').append($moving_div);

        refreshAnimation($wizard, index);

        $('.moving-tab').css('transition', 'transform 0s');
      },

      onTabClick: function(tab, navigation, index) {
        var $valid = $('.card-wizard form').valid();
        if (!$valid) {
          return false;
        } else {
          return true;
        }
      },

      onTabShow: function(tab, navigation, index) {
        var $total = navigation.find('li').length;
        var $current = index + 1;
        var $wizard = navigation.closest('.card-wizard');

        // If it's the last tab then hide the last button and show the finish instead
        if ($current >= $total) {
          $($wizard).find('.btn-next').hide();
          $($wizard).find('.btn-finish').show();
        } else {
          $($wizard).find('.btn-next').show();
          $($wizard).find('.btn-finish').hide();
        }

        button_text = navigation.find('li:nth-child(' + $current + ') a').html();

        setTimeout(function() {
          $('.moving-tab').text(button_text);
        }, 150);

        var checkbox = $('.footer-checkbox');

        if (!index == 0) {
          $(checkbox).css({
            'opacity': '0',
            'visibility': 'hidden',
            'position': 'absolute'
          });
        } else {
          $(checkbox).css({
            'opacity': '1',
            'visibility': 'visible'
          });
        }
        refreshAnimation($wizard, index);
      }
    });


    // Prepare the preview for profile picture
    $("#wizard-picture").change(function() {
      readURL(this);
    });

    $('[data-toggle="wizard-radio"]').click(function() {
      wizard = $(this).closest('.card-wizard');
      wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
      $(this).addClass('active');
      $(wizard).find('[type="radio"]').removeAttr('checked');
      $(this).find('[type="radio"]').attr('checked', 'true');
    });

    $('[data-toggle="wizard-checkbox"]').click(function() {
      if ($(this).hasClass('active')) {
        $(this).removeClass('active');
        $(this).find('[type="checkbox"]').removeAttr('checked');
      } else {
        $(this).addClass('active');
        $(this).find('[type="checkbox"]').attr('checked', 'true');
      }
    });

    $('.set-full-height').css('height', 'auto');

    //Function to show image before upload

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    $(window).resize(function() {
      $('.card-wizard').each(function() {
        $wizard = $(this);

        index = $wizard.bootstrapWizard('currentIndex');
        refreshAnimation($wizard, index);

        $('.moving-tab').css({
          'transition': 'transform 0s'
        });
      });
    });

    function refreshAnimation($wizard, index) {
      $total = $wizard.find('.nav li').length;
      $li_width = 100 / $total;

      total_steps = $wizard.find('.nav li').length;
      move_distance = $wizard.width() / total_steps;
      index_temp = index;
      vertical_level = 0;

      mobile_device = $(document).width() < 600 && $total > 3;

      if (mobile_device) {
        move_distance = $wizard.width() / 2;
        index_temp = index % 2;
        $li_width = 50;
      }

      $wizard.find('.nav li').css('width', $li_width + '%');

      step_width = move_distance;
      move_distance = move_distance * index_temp;

      $current = index + 1;

      if ($current == 1 || (mobile_device == true && (index % 2 == 0))) {
        move_distance -= 8;
      } else if ($current == total_steps || (mobile_device == true && (index % 2 == 1))) {
        move_distance += 8;
      }

      if (mobile_device) {
        vertical_level = parseInt(index / 2);
        vertical_level = vertical_level * 38;
      }

      $wizard.find('.moving-tab').css('width', step_width);
      $('.moving-tab').css({
        'transform': 'translate3d(' + move_distance + 'px, ' + vertical_level + 'px, 0)',
        'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'

      });
    }
  }

}




$(document).ready(function() {


  // Initialise Form
  prosoft.initFormWizard();
  setTimeout(function() {
    $('.card.card-wizard').addClass('active');
  }, 600);

  md.initFormExtendedDatetimepickers();
  if ($('.slider').length != 0) {
    md.initSliders();
  }


  $('#submit').click(function(e) {

    //if (validate() == false)
    //  return;

    if ($("#frmTrainingInfo").valid() == false) {
      return;
    }


    var form = $('#frmTrainingInfo');
    
    var postForm = form.serialize();
    //var postForm = new Array(); //form.serializeArray();
    //postForm = UpdateSerializeArray(postForm)

      
    $.ajax({ //Process the form using $.ajax()
      type    : 'POST', //Method type
      url     : '/library/page/btraining-info.php', //Your form processing file URL
      data    : postForm, //Forms name
      dataType: 'json',
      success : function(data) {
        if (!data.success) { //If fails
          if (data.session == 'expired') {
            alert("Your session had expired. Please re-login")
            window.location.replace("/");

          } else {
            alert(data.error);
          }

          return;
        } else {
          //alert(data.session);
          location.href = '/training-info';
        }
              
      }, 
      
      error : function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(xhr.responseText);
        console.log(thrownError);
        alert('There is unknown error occurs. Please contact administrator for system verification');
      }
        
    });
  });


  $.validator.setDefaults({
    submitHandler: function(form) {
      if (form.id == 'frmTrainingInfo') {
        swal({ title:"Save successful", text: "", type: "warning", buttonsStyling: true, confirmButtonClass: "btn btn-success"})

      } else if(form.id == 'xxx') {
        alert('yyyy');
      }
    }
  })



  $("#frmTrainingInfo").validate({
    onfocusout: false,
    invalidHandler: function(form, validator) {
        var errors = validator.numberOfInvalids();
        if (errors) {                    
            validator.errorList[0].element.focus();
        }
    },
    rules: {
      title: {
        required: true,
        minlength: 4
      },
      dashboard: "required",
      myapplication: "required"
    },
    messages: {
      title: {
        required: "Please enter a training title",
        minlength: "training title must at least 4 characters"
      },
      dashboard: "Dashboard is a compulsory menu",
      myapplication: "My Application is a compulsory menu"
    }
      
  });

});
