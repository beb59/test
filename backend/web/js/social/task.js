
var stop = 0;
var stop_words = 0;
var id_word = 0;
var word = '';

$(document).ready(function(){

	$('#social_task_edit_form').on('show.bs.modal', function(e){

		var id = $(e.relatedTarget).data('id');
		var title = '';

		if(id > 0){
			title = 'Редактировать задачу';
		}
		else{
			title = 'Добавить задачу';
		}

		$('#social_task_edit_form').find('.modal-title').html(title);

		$.post('/ajax/social_task/form/', { id : id }, function(data){
			$('#social_task_edit_form').find('.modal_content').html(data['html']);
			id_word = id;

		});

	});

	$(document).on('click', '.delete', function(){

		var block = $(this);

		$.post('/ajax/dict/remove/', { id : block.data('id') }, function(data){
			block.parent().parent().remove();
		});

	});

	$(document).on('dblclick', '.edit_word_form', function(){

		var block = $(this);

		if(block.find('input').length != 0){

			$.post('/ajax/dict/saveword/',
				{
					id : block.data('id'),
					name : block.find('input').val()
				}, function(data){
					block.html(block.find('input').val());
			});

			return 1;
		}

		word = jQuery.trim(block.html());

		block.html('<input type="text" value="'+word+'">');

	});

	$(document).on('click', '.delete_word', function(){

		var block = $(this);

		$.post('/ajax/dict/removeword/', { id : block.data('id') }, function(data){
			block.parent().parent().remove();
		});
	});

	$('#keywords').keyup(function(){
		loader_table(1);
	});

	$('.select_change').change(function(){
		loader_table(1);
	});

	$('#social_task_edit_form form').submit(function(){

		var form = $(this);
		clear_form_error(form);

		$.ajax({
			url: '/ajax/social_task/save',
			type: 'POST',
			data: form.serialize(),
			dataType: 'json',
			success: function(data){

				if(data['error'] != ''){
					view_form_error(form, data['error'], 'data');
					return false;
				}

				$('#social_task_edit_form').modal('hide');

				loader_table(1);
			}
		});

		return false;
	});

	loader_table(1);

	$(window).scroll(function(){
		var rs = get_post_loader();

		if(rs){
			loader_table();
		}

	});

});

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

function get_post_loader_words(){

	var scrollTop = $('#scroll_words').scrollTop();
	var windowHeight = $('#scroll_words').height();
	var result = [];  

	var el = $('#ajax_words').find('tr:last');
	var offset = el.offset();

	if(scrollTop+500 <= offset.top && ((scrollTop+500)+(windowHeight)) > offset.top){
		return 1;
	}

}

function loader_table(reload){

	if(stop == 0){

		stop = 1;

		var offset = 0;

		if(!reload){
			offset = $('#ajax_data').find('tr').length
		}

		var filter = 'offset='+offset;

		filter += '&'+$('#filter').serialize();

		$.ajax({
			url: '/ajax/social_task/list',
			type: 'POST',
			data: filter,
			dataType: 'json',
			success: function(data){
				if(reload){
					$('#ajax_data').html(data['html']);
				}
				else{
					$('#ajax_data').append(data['html']);
				}

				stop = 0;
			}
		});
	}
}

function loader_words(reload){

	if(stop_words == 0){

		stop_words = 1;

		var offset = 0;

		if(!reload){
			offset = $('#ajax_words').find('tr').length
		}

		var filter = 'offset='+offset+'&id='+id_word;

		$.ajax({
			url: '/ajax/dict/listwords',
			type: 'POST',
			data: filter,
			dataType: 'json',
			success: function(data){
				if(reload){
					$('#ajax_words').html(data['html']);
				}
				else{
					$('#ajax_words').append(data['html']);
				}

				stop_words = 0;
			}
		});
	}
}