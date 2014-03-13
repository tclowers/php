var running = true;

var toType = function(obj) {
  return ({}).toString.call(obj).match(/\s([a-zA-Z]+)/)[1].toLowerCase()
}

var get_cells = function() {
	//$('.generations').fadeOut(3000, function(){
		$.ajax({
			url: 'cells2.php',
			type: 'GET',
			dataType: 'json',
			success: function(result) {
				var content = '';
				$.each(result, function(index, row) {
						for(var a = 0; a < row.length; a++) {
							//content += "type: " + toType(row[a]) + " row: " + row[a] + ", ";
							if (row[a]) {
								content += "<i class='fa fa-circle'></i>";
							} else {
								content += "<i class='fa fa-circle-o'></i>";
							}
							/*if(element == 'true') {
								content += "<i class='fa fa-circle'></i>";
							} else {
								content += "false";
								//content += "<i class='fa fa-circle-o'></i>";
							}*/
						}
						//content += "index: " + index + " row isa: " + toType(row) + " row: " + row;
					/*$.each(row, function(element) {
						//content += element;
						//content += row;
						/*if(element == true) {
							content += "<i class='fa fa-circle'></i>";
						} else {
							content += "false";
							//content += "<i class='fa fa-circle-o'></i>";
						}*/
					//});
					content += "<br/>";
				});
				//$('.generations').html(content).fadeIn(3000, get_cells());
				$('.generations').html(content);
				if(running) {
					get_cells(running);					
				}

				
			},
			error: function(request, errorType, errorMessage) {
				console.log('Error: ' + errorType + ' with message: ' + errorMessage);
			}
		});
	//});
	
}

$(document).ready(function(){
	//NewSet.get_cells();
	$('.go').on('click', function() {
		event.preventDefault();
		running = true;
		get_cells(running);
		//$('.generations').fadeIn('slow');
	});

	$('.stop').on('click', function() {
		event.preventDefault();
		running = false;
		//$('.generations').fadeIn('slow');
	});
});