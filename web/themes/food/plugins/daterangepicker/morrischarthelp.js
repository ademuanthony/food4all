$(function() {

	// Set the default dates
	var startDate	= Date.create().addDays(-6),	// 7 days ago
		endDate		= Date.create(); 				// today

	var range = $('#range');

	// Show the dates in the range input
	range.val(startDate.format('{MM}/{dd}/{yyyy}') + ' - ' + endDate.format('{MM}/{dd}/{yyyy}'));

	// Load chart
	ajaxLoadChart(startDate,endDate);
	
	range.daterangepicker({
		
		startDate: startDate,
		endDate: endDate,
		
		ranges: {
            'Today': ['today', 'today'],
            'Yesterday': ['yesterday', 'yesterday'],
            'Last 7 Days': [Date.create().addDays(-6), 'today'],
            'Last 30 Days': [Date.create().addDays(-29), 'today']
        }
	},function(start, end){
		
		ajaxLoadChart(start, end);
		
	});
	
	



	// Create a new xChart instance, passing the type
	// of chart a data set and the options object

	var graph = Morris.Line({
   // ID of the element in which to draw the chart.
  element: 'chart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.

  // The name of the data record attribute that contains x-values.
  xkey: 'label',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Value'],
   hideHover: 'auto',
   resize: true
 
});
	// Function for loading data via AJAX and showing it on the chart
	
	function ajaxLoadChart(startDate,endDate) {
		

$.getJSON('http://localhost:800/mywebsites/laravel%20MLM/public/chartdata', {
			
			start:	startDate.format('{yyyy}-{MM}-{dd}'),
			end:	endDate.format('{yyyy}-{MM}-{dd}')
			
		}, function(data) {
			
	    graph.setData(data);

		});




	}
});