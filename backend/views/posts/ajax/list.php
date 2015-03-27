<?
foreach($arr_data AS $data){
?>
	<tr>
		<td><?=$data->id?></td>
		<td>
			<?=$data->title?>
		</td>
		<td><?=$data->created?></td>
		<td><?#=backend\models\Admin::$statuses[$data->status]?></td>
		<td>
			<a href="#" data-id="<?=$data->id?>" data-toggle="modal" data-target="#post_edit_form" class="glyphicon glyphicon-pencil edit_link"></a>
		</td>
	</tr>
<?
}
?>