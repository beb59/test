
var stop = 0;

$(document).ready(function(){

	$('#refresh').click(function(){
		loader_table();
	});

	$('#select_proxy').change(function(){
		loader_table();
	});

});

function loader_table(){

	if(stop == 0){

		stop = 1;

		var filter = $('#filters').serialize();

		$.ajax({
			url: '/ajax/mailer/logproxy',
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