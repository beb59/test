
var stop = 0;

$(document).ready(function(){

	$('#post_edit_form').on('show.bs.modal', function(e){

		var id = $(e.relatedTarget).data('id');
		var title = '';

		if(id > 0){
			title = 'Редактировать пост';
		}
		else{
			title = 'Добавить пост';
		}

		$('#post_edit_form').find('.modal-title').html(title);

		$.post('/ajax/posts/form/', { id : id }, function(data){
			$('#post_edit_form').find('.modal_content').html(data['html']);
		});

	});

	$(document).on('click', '.delete', function(){

		var block = $(this);

		$.post('/ajax/posts/remove/', { id : block.data('id') }, function(data){
			block.parent().parent().remove();
		});
	});

	$('#keywords').keyup(function(){
		loader_table(1);
	});

	$('.select_change').change(function(){
		loader_table(1);
	});

	$('#post_edit_form form').submit(function(){

		var form = $(this);
		clear_form_error(form);

		$.ajax({
			url: '/ajax/posts/save',
			type: 'POST',
			data: form.serialize(),
			dataType: 'json',
			success: function(data){

				if(data['error'] != ''){
					view_form_error(form, data['error'], 'data');
					return false;
				}

				$('#post_edit_form').modal('hide');
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
			url: '/ajax/posts/list',
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