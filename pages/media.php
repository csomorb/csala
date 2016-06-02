<div class="container">
<?php
include('connect.php');
$reponse = $bdd->query('SELECT * FROM media ORDER BY datum DESC');
while ($donnees = $reponse->fetch()){
	if(strcmp($donnees['type'],'cikk') != 0 ){
		echo "<h3>".$donnees['nom']."</h3>\n";
		echo "<div class=\"videoWrapper\">".$donnees['content']."</div>";
		echo "\n<p>".$donnees['descr']."</p><hr/>\n";
	}
	else{
		// on trouve l'image correspondant à l'id
		$id = $donnees['content'];
		$reponse2 = $bdd->query("SELECT * FROM image WHERE id = $id ");
		$donnees2 = $reponse2->fetch();
		echo "<h3>".$donnees['nom']."</h3>\n";
		echo "<img src=\"./img/".$donnees2['nom']."\" class=\"img-responsive\" alt=\"cikk\">";
		echo "\n<p>".$donnees['descr']."</p><hr/>\n";
	}
}
?>

<script>
	$(function() {

    var $allVideos = $("iframe[src^='//player.vimeo.com'], iframe[src^='//www.youtube.com'], object, embed"),
    $fluidEl = $("figure");

	$allVideos.each(function() {

	  $(this)
	    // jQuery .data does not work on object/embed elements
	    .attr('data-aspectRatio', this.height / this.width)
	    .removeAttr('height')
	    .removeAttr('width');

	});

	$(window).resize(function() {

	  var newWidth = $fluidEl.width();
	  $allVideos.each(function() {

	    var $el = $(this);
	    $el
	        .width(newWidth)
	        .height(newWidth * $el.attr('data-aspectRatio'));

	  });

	}).resize();

});
	
	
</script>


</div>