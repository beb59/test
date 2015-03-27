<div class="form-group">
	<label for="exampleInputEmail1">Title</label>
	<input type="text" name="data[title]" class="form-control" value="<?=(isset($data->title) ? $data->title : '')?>">
	<label class="control-label error_form">Input with warning</label>
	<div class="error_form"></div>
</div>

<div class="clearfix"></div>
<div class="form-group">
	<label for="exampleInputEmail1">Extract</label>
	<textarea class="form-control" rows="20" name="data[extract]"><?=(isset($data->extract) ? $data->extract : '')?></textarea>
	<label class="control-label error_form">Input with warning</label>
	<div class="error_form"></div>
</div>

<div class="clearfix"></div>
<div class="form-group">
	<label for="exampleInputEmail1">Description</label>
	<textarea class="form-control" rows="20" name="data[description]"><?=(isset($data->description) ? $data->description : '')?></textarea>
	<label class="control-label error_form">Input with warning</label>
	<div class="error_form"></div>
</div>

<div class="clearfix"></div>
<div class="form-group">
	<label for="exampleInputEmail1">Tags (вводить через запятую)</label>
	<textarea class="form-control" rows="20" name="tags"><?=(isset($data->tags_arr) ? implode(',', $data->tags_arr) : '')?></textarea>
	<label class="control-label error_form">Input with warning</label>
	<div class="error_form"></div>
</div>

<input type="hidden" name="id" value="<?=(isset($data->id) ? $data->id : '')?>">