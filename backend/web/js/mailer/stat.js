var stop = 0;
var controls_start = 0;
var restart = 0;
var restart_stat = 0;

$(document).ready(function(){

	//restart = 1;

	loader_table();

	setInterval(function(){
		if($('#status').val() == 'W'){
			loader_table();
		}
	}, 3000);

	setInterval(function(){
		if(restart == 1 && restart_stat == 100){
			restart_stat = 1
			$.ajax({
				url: '/ajax/mailer/restartstat',
				type: 'POST',
				data: { id : $('#id').val() },
				dataType: 'json',
				success: function(data){
					$('#progressbar').html(data['percent']+'%');
					$('#progressbar').css('width', data['percent']+'%');
					restart_stat = 0;
				}
			});
		}
	}, 2000);

	setInterval(function(){
		if(controls_start == 1){
			$.ajax({
				url: '/ajax/mailer/controlsstat',
				type: 'POST',
				data: $('#filters').serialize(),
				dataType: 'json',
				success: function(data){
					if(data['complete'] == '1'){
						controls_start = 0;
						//alert('Контрольки выполнены');
						$('#control').find('.modal_content').html(data['html']);
						//$('#controls_stat').find('div').html(data['html'])
					}
				}
			});
		}
	}, 2000);

	$('#run_mailer').click(function(){

		var filter = $('#filters').serialize();

		$.ajax({
			url: '/ajax/mailer/changestatus',
			type: 'POST',
			data: filter,
			dataType: 'json',
			success: function(data){
				$('#run_mailer').html(data['status']);
				$('#status').val(data['status_code']);
			}
		});

		return false;
	});

	$('#check_proxy').click(function(){

		var block = $(this);

		$.ajax({
			url: '/ajax/mailer/checkproxy',
			type: 'POST',
			data: { id : block.data('id')},
			dataType: 'json',
			success: function(data){
				window.open('/mailer/proxy/'+block.data('id'), 'Log', 'menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes')
			}
		});

		return false;
	});

	$('#restart_mailer').click(function(){

		restart = 1;
		$('#open_restart_form').click();

		var filter = $('#filters').serialize();

		$.ajax({
			url: '/ajax/mailer/restart',
			type: 'POST',
			data: filter,
			dataType: 'json',
			success: function(data){
				restart = 0;
				$('#progressbar').html('100%');
				$('#progressbar').css('width', '100%');
				loader_table();
			}
		});

		return false;

	});

	$('#start_controls').click(function(){

		controls_start = 1;

		$('#control').modal('show');
		//$('#controls_stat').show();
		$('#control').find('.modal_content').html('Ждем......');

		var filter = $('#filters').serialize();

		$.ajax({
			url: '/ajax/mailer/startcontrols',
			type: 'POST',
			data: filter,
			dataType: 'json',
			success: function(data){
				
			}
		});

		return false;

	});

});

function loader_table(){

	if(stop == 0){

		stop = 1;

		var filter = $('#filters').serialize();

		$.ajax({
			url: '/ajax/mailer/stat',
			type: 'POST',
			data: filter,
			dataType: 'json',
			success: function(data){

				var sent = data['sent']+ ' / '+data['sent_start'];
				var dontsend = data['dontsend']+ ' / '+data['dontsend_start'];

				$('#all').html(data['all']);
				$('#sent').html(sent);
				$('#dontsend').html(dontsend);
				$('#control_count').html(data['control_count']);

				$('#controls_inbox').html(data['controls_inbox']);
				$('#controls_spam').html(data['controls_spam']);

				$('#accs').html(data['accs']);
				$('#accs_down').html(data['accs_down']);

				$('#proxy_log').html(data['proxy']);

				stop = 0;
			},
			error: function(){
				stop = 0;
			}
		});
	}
}