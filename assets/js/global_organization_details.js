$(document).ready( function() {
	
	$('.division_select').keyup(function() {
		width = $(this).innerWidth();
		select_div_click = false;
		id = 'division_list';
		if ($(this).val().length >= 0) {
			$.ajax({
				type: "POST",
				url: "library/page/b_global_parameter.php",
				data:{'get_division':true,'division':$(this).val()},
				success: function(data){
					$("#"+id).show();
					$("#"+id).html(data);
					$(".division_list").width(width);
					$("#"+id).css("background","#FFF");
				}
			});
		}
	}).focusin(function() {
		width = $(this).innerWidth();
		select_div_click = false;
		id = 'division_list';
		$.ajax({
			type: "POST",
			url: "library/page/b_global_parameter.php",
			data:{'get_division':true,'division':''},
			success: function(data){
				$("#"+id).show();
				$("#"+id).html(data);
				$(".division_list").width(width);
				$("#"+id).css("background","#FFF");
			}
		});
		
	}).focusout(function() {
		id = this.id;
		setTimeout(function () {
			if (select_div_click == false) {				
				$('.section_select').val('');
				$('.unit_select').val('');	
				$('.department_select').val('');
				$('.department_select').prop('disabled', true);
				$('.section_select').prop('disabled', true);
				$('.unit_select').prop('disabled', true);

			}	

			$('.division_list').hide()
			$('.division_select').trigger('change');
		},250);

	}).siblings().on('click','li', function() {
		select_div_click = true;
		//id = $(this).parent().parent().attr('id');

		if ($(this).attr('value') == '') {
			select_div_click = false
		}
		$('.division_select').val($(this).attr('value'));
		$('.department_select').val('');
		$('.section_select').val('');
		$('.unit_select').val('');	
		$('.department_select').prop('disabled', false);
		//$('.section_select').prop('disabled', false);
		//$('.unit_select').prop('disabled', false);
		$('.division_list').hide();
		//$('.division_select').trigger('change');

	})

//----------------------------------------------------------------------------------

	$('.department_select').keyup(function() {

		width = $(this).innerWidth();
		select_dept_click = false;
		id = 'department_list';
		if ($(this).val().length >= 0) {
			$.ajax({
				type: "POST",
				url: "library/page/b_global_parameter.php",
				data:{'get_department':true, 'department':$(this).val(), 'division': $('.division_select').val()},
				success: function(data){
					$("#"+id).show();
					$("#"+id).html(data);
					$(".department_list").width(width);
					$("#"+id).css("background","#FFF");
				}
			});
		}
	}).focusin(function() {
		width = $(this).innerWidth();
		select_dept_click = false;
		id = 'department_list';
		$.ajax({
			type: "POST",
			url: "library/page/b_global_parameter.php",
			data:{'get_department':true, 'department':'', 'division': $('.division_select').val()},
			success: function(data){
				$("#"+id).show();
				$("#"+id).html(data);
				$(".department_list").width(width);
				$("#"+id).css("background","#FFF");
			}
		});
		
	}).focusout(function() {
		id = this.id;
		setTimeout(function () {
			if (select_dept_click == false) {				
				$('.section_select').val('');
				$('.unit_select').val('');	
				$('.section_select').prop('disabled', true);
				$('.unit_select').prop('disabled', true);
			}	

			$('.department_list').hide()
			$('.department_select').trigger('change');
		},250);

	}).siblings().on('click','li', function() {
		select_dept_click = true;
		if ($(this).attr('value') == '') {
			select_dept_click = false
		}
		$('.department_select').val($(this).attr('value'));
		$('.section_select').val('');
		$('.unit_select').val('');	
		$('.section_select').prop('disabled', false);
		$('.department_list').hide();
		$('.department_select').trigger('change');

	})
//-------------------------------------------------------------------------------------------------------------

	$('.section_select').keyup(function() {
		width = $(this).innerWidth();
		select_section_click = false;
		id = 'section_list';
		if ($(this).val().length >= 0) {
			$.ajax({
				type: "POST",
				url: "library/page/b_global_parameter.php",
				data:{'get_section':true, 'section':$(this).val(), 'division': $('.division_select').val(),'department': $('.department_select').val()},
				success: function(data){
					$("#"+id).show();
					$("#"+id).html(data);
					$(".section_list").width(width);
					$("#"+id).css("background","#FFF");
				}
			});
		}
	}).focusin(function() {
		width = $(this).innerWidth();
		select_section_click = false;
		id = 'section_list';
		$.ajax({
			type: "POST",
			url: "library/page/b_global_parameter.php",
			data:{'get_section':true, 'section':'', 'division': $('.division_select').val(),'department': $('.department_select').val()},
			success: function(data){
				$("#"+id).show();
				$("#"+id).html(data);
				$(".section_list").width(width);
				$("#"+id).css("background","#FFF");
			}
		});
		
	}).focusout(function() {
		id = this.id;
		setTimeout(function () {
			if (select_section_click == false) {				
				$('.section_select').val('');
				$('.unit_select').val('');	
				$('.unit_select').prop('disabled', true);

			}	

			$('.section_list').hide()
			$('.section_select').trigger('change');
		},250);

	}).siblings().on('click','li', function() {
		select_section_click = true;
		if ($(this).attr('value') == '') {
			select_section_click = false
		}
		//id = $(this).parent().parent().attr('id');
		$('.section_select').val($(this).attr('value'));

		$('.unit_select').val('');	
		$('.unit_select').prop('disabled', false);

		$('.section_list').hide();
		$('.section_select').trigger('change');

	})

//------------------------------------------------------------------------------------------------------------

	$('.unit_select').keyup(function() {
		width = $(this).innerWidth();
		select_unit_click = false;
		id = 'unit_list';
		if ($(this).val().length >= 0) {
			$.ajax({
				type: "POST",
				url: "library/page/b_global_parameter.php",
				data:{'get_unit':true, 'unit':$(this).val(), 'division': $('.division_select').val(),'department': $('.department_select').val(), 'section': $('.section_select').val()},
				success: function(data){
					$("#"+id).show();
					$("#"+id).html(data);
					$(".unit_list").width(width);
					$("#"+id).css("background","#FFF");
				}
			});
		}
	}).focusin(function() {
		width = $(this).innerWidth();
		select_unit_click = false;
		id = 'unit_list';
		$.ajax({
			type: "POST",
			url: "library/page/b_global_parameter.php",
			data:{'get_unit':true, 'unit':'', 'division': $('.division_select').val(),'department': $('.department_select').val(), 'section': $('.section_select').val()},
			success: function(data){
				$("#"+id).show();
				$("#"+id).html(data);
				$(".unit_list").width(width);
				$("#"+id).css("background","#FFF");
			}
		});
		
	}).focusout(function() {
		id = this.id;
		setTimeout(function () {
			$('.unit_list').hide()
			$('.unit_select').trigger('change');
		},250);

	}).siblings().on('click','li', function() {
		select_unit_click = true;
		//id = $(this).parent().parent().attr('id');
		$('.unit_select').val($(this).attr('value'));
		$('.unit_list').hide();
		$('.unit_select').trigger('change');

	})

})