<?
foreach($posts AS $post){
?>
	<a href="/post/<?=$post->id?>"><?=$post->title?></a> <?=$post->created?>

	<p><?=$post->extract?></p>
<?
}
?>