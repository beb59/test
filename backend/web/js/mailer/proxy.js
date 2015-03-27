
var stop = 0;

$(document).ready(function(){
	
	loader_table();

	setInterval(function(){
		loader_table();
	}, 2000);

});

function loader_table(){

	if(stop == 0){

		stop = 1;

		var filter = $('#filters').serialize();

		$.ajax({
			url: '/ajax/mailer/proxy',
			type: 'POST',
			data: filter,
			dataType: 'json',
			success: function(data){

				$('#log').append(data['log']);
				$('#filters').find('[name="date"]').val(data['updated']);

				stop = 0;
			},
			error: function(){
				stop = 0;
			}
		});
	}
}