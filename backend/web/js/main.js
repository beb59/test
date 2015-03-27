$(document).ready(function(){

});

function view_form_error(form, data, name){

	if(name != ''){
		for(key in data){

			var input = form.find('[name="'+name+'['+key+']"]');

			input.next().html(data[key]);
			input.next().animate({ height : 'show' });
			input.parent().addClass('has-error');

		}
	}
	else{
		for(key in data){
			form.find('[name="'+key+'"]').next().html(data[key]);
			form.find('[name="'+key+'"]').next().animate({height:'show'});
		}
	}

}

function clear_form_error(form){
	form.find('.has-error').removeClass('has-error');
	form.find('.error_form').hide();
}