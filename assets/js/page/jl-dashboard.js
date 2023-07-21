$(document).ready(function() {



	process_request('schedule','schedule');
	process_request('register','register');
	process_request('internal','internal');
	process_request('external','external');
	process_request('incoming_training', 'incoming_training')

	
})

$(function () {
    var ctx = document.getElementById("TrainingChart").getContext("2d");
    // examine example_data.json for expected response data
    var json_url = "example_data.json";

    // draw empty chart
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [
                {
                    label: "Month Training Report",
                    fill: true,
                    backgroundColor: [
				      '#dc3545',
				      '#198754',
				      '#0d6efd',
				      '#0dcaf0',
				      'rgba(54, 162, 235, 0.2)',
				      'rgba(153, 102, 255, 0.2)',
				      'rgba(201, 203, 207, 0.2)'
				    ],
                    barPercentage: 10,
				    barThickness: 40,
				    maxBarThickness: 40,
				    minBarLength: 2,
                    data: [],
                    borderColor: [
				      '#dc3545',
				      '#198754',
				      '#0d6efd',
				      '#0dcaf0',
				      'rgb(54, 162, 235)',
				      'rgb(153, 102, 255)',
				      'rgb(201, 203, 207)'
				    ],
                    spanGaps: true,
                }
            ]
        },
        options: {
            tooltips: {
                mode: 'index',
                intersect: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });

    ajax_chart(myChart, json_url);

    // function to update our chart
    function ajax_chart(chart, url, data) {
        
        var data = data || {};
        form_data = new FormData($('#dashboard')[0]);
		form_data.append('form_process' , 'yearly_training');
		form_data.append('id' , 'yearly_training');

        /*$.getJSON(url, data).done(function(response) {
            chart.data.labels = response.labels;
            chart.data.datasets[0].data = response.data.quantity; // or you can iterate for multiple datasets
            chart.update(); // finally update our chart
        });*/
        $.ajax({ //Process the form using $.ajax()
	        type    : 'POST', //Method type
	        url     : 'library/page/b_dashboard.php', //Your form processing file URL
	        data    : form_data, //Forms name
	        dataType: 'json',
	        contentType: false,
	      	cache: false,
			processData:false, 
		    success	: function(data) {

		    	//success = data.success;
		    	//label = data.data.labels; 
		    	//label = data['labels'];
	            chart.data.labels = data.labels;
	            chart.data.datasets[0].data = data.data; //.quantity; // or you can iterate for multiple datasets
	            chart.update(); // finally update our chart
				
			},
			error	: function (xhr, ajaxOptions, thrownError) {
				//$("#loading-overlay").hide();
				//danger ('Process Error', "There is unknown error occurs. Please contact administrator for system verification") 
				console.log(xhr.status);
				console.log(xhr.responseText);
				console.log(thrownError);
				console.log('There is unknown error occurs. Please contact administrator for system verification');
				console.log(xhr.responseText);
			}
	   	});
    }
});

function process_request (id, action_process) {

	form_data = new FormData($('#dashboard')[0]);
	form_data.append('form_process' , action_process);
	form_data.append('id' , id);
	
		
	$.ajax({ //Process the form using $.ajax()
        type    : 'POST', //Method type
        url     : 'library/page/b_dashboard.php', //Your form processing file URL
        data    : form_data, //Forms name
        dataType: 'json',
        contentType: false,
      	cache: false,
		processData:false, 
	    success	: function(data) {
	    	if (!data.success) { //If fails
				//alert(data.errors);
				$('#'+id).html(data.process);
			} else {
				$('#'+id).html(data.process);
			}
			
		},
		error	: function (xhr, ajaxOptions, thrownError) {
			//$("#loading-overlay").hide();
			//danger ('Process Error', "There is unknown error occurs. Please contact administrator for system verification") 
			console.log(xhr.status);
			console.log(xhr.responseText);
			console.log(thrownError);
			console.log('There is unknown error occurs. Please contact administrator for system verification');
			console.log(xhr.responseText);
		}
				
   	});

}
