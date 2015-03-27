<div>
	<h2><?=$post->title?></h2>

	<p><?=$post->description?></p>


	<?
	if(count($post->tags_arr)){
	?>
		<h3>Тэги</h3>

		<?
		foreach($post->tags_arr AS $k => $tag){
		?>
			<a href="/tag/<?=$k?>"><?=$tag?></a>
		<?
		}
		?>
	<?
	}
	?>
</div>