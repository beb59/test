
var stop = 0;
var not_loaded = 1;

$(document).ready(function(){

	not_loaded = 0;

	$(window).scroll(function(){
		
		if(not_loaded != 1){
			if($(window).scrollTop() > 125){
				$('#element_block').css({position : 'fixed', marginTop: '-125px'});
			}
			else{
				$('#element_block').css({position : 'static', marginTop: '0px'});
			}

		}
	});

	$('.settings_nav li').click(function(){

		$('.settings_nav li').removeClass('active');
		$(this).addClass('active');

		$('.settings_block').hide();
		$('.settings_block_'+$(this).data('id')).show();

	});

	list_proxies();

	$('#mailer_edit_form').on('show.bs.modal', function(e){

		var id = $(e.relatedTarget).data('id');
		var title = '';

		if(id > 0){
			title = 'Редактировать рассылку';
		}
		else{
			title = 'Добавить рассылку';
		}

		$('#mailer_edit_form').find('.modal-title').html(title);

		$.post('/ajax/mailer/form/', { id : id }, function(data){
			$('#mailer_edit_form').find('.modal_content').html(data['html']);
		});

	});

	$('#edit_proxy').on('show.bs.modal', function(e){

		var id = $(e.relatedTarget).data('id');
		var title = '';

		$.post('/ajax/mailer/editproxy/', { id : id }, function(data){

			$('#edit_proxy').find('[name="id"]').val(data['id']);
			$('#edit_proxy').find('[name="ip"]').val(data['ip']);
			$('#edit_proxy').find('[name="port"]').val(data['port']);
			$('#edit_proxy').find('[name="user"]').val(data['user']);
			$('#edit_proxy').find('[name="password"]').val(data['password']);
			$('#edit_proxy').find('[name="helo"]').val(data['helo']);

		});

	});

	$('#edit_proxy form').submit(function(){
		$.post('/ajax/mailer/saveproxy/', $(this).serialize(), function(data){
			$('#edit_proxy').modal('hide');
			list_proxies();
		});

		return false;
	});

	$('#add_proxies form').submit(function(){
		$.post('/ajax/mailer/addproxies/', $(this).serialize()+'&id='+id_mailer, function(data){
			alert('Прокси Загружены');
			list_proxies();
			$('#add_proxies').modal('hide');
		});

		return false;
	});

	$('#add_accs form').submit(function(){
		$.post('/ajax/mailer/addaccs/', $(this).serialize()+'&id='+id_mailer, function(data){
			alert('Аккаунты Загружены');
			list_accs();
			$('#add_accs').modal('hide');
		});

		return false;
	});

	$('#settings form').submit(function(){
		$.post('/ajax/mailer/settings/', $(this).serialize(), function(data){
			alert('Настройки Сохранены');
			$('#settings').modal('hide');
		});

		return false;
	});

	$('#delete_proxy').click(function(){

		var proxies = '';

		$('.delete_proxies:checked').each(function(){
			proxies+= $(this).val()+','
		});

		$.post('/ajax/mailer/deleteproxies/', {proxies : proxies}, function(data){
			list_proxies();
		});

		return false;
	});

	$('#delete_accs').click(function(){

		var accs = '';

		$('.delete_accs:checked').each(function(){
			accs+= $(this).val()+','
		});

		$.post('/ajax/mailer/deleteaccs/', {accs : accs}, function(data){
			list_accs();
		});

		return false;
	});

	var proxy_checked = 0;

	$('#select_all_proxy').click(function(){

		if(proxy_checked == 1){
			proxy_checked = 0;
			$('.delete_proxies').removeAttr('checked');
		}
		else{
			proxy_checked = 1;
			$('.delete_proxies').attr('checked', 'checked');
		}

	});

	
	var accs_checked = 0;

	$('#select_all_accs').click(function(){

		if(accs_checked == 1){
			accs_checked = 0;
			$('.delete_accs').removeAttr('checked');
		}
		else{
			accs_checked = 1;
			$('.delete_accs').attr('checked', 'checked');
		}

	});

	$(document).on('click', '.del_user', function(){

		var form = $(this);
		var id = ($(this).data('id') ? $(this).data('id') : '0');

		if(confirm("Вы уверены?")){
			$.post('/admin/ajaxUsers/Delete/', { id : id }, function(data){
				$('.edit_block ').hide();
				form.closest('.table_body_wrap').animate({height : 'hide'});
			});
		}
	});

	$('#form').submit(function(){

		var form = $(this);
		clear_form_error(form);

		$.ajax({
			url: '/ajax/mailer/save',
			type: 'POST',
			data: form.serialize(),
			dataType: 'json',
			success: function(data){

				if(data['error'] != ''){
					view_form_error(form, data['error'], 'data');
					return false;
				}

				alert('Сохранено');

			}
		});

		return false;

	});

});

function list_proxies(){
	$.post('/ajax/mailer/listproxies/', { id_mailer : id_mailer }, function(data){
		$('#proxies_list').html(data['html']);
	});
}

function list_accs(){
	$.post('/ajax/mailer/listaccs/', { id_mailer : id_mailer }, function(data){
		$('#accs_list').html(data['html']);
	});
}

function get_post_loader(){

	var scrollTop = $(window).scrollTop();
	var windowHeight = $(window).height();
	var result = [];  

	var el = $('#post_loader');
	var offset = el.offset();

	if(scrollTop+500 <= offset.top && ((scrollTop+500)+(windowHeight)) > offset.top){
		return 1;
	}

}