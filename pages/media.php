<div class="container">
	    <hr class="trait_menu"/>
	<h1 class="text-center">Média</h1>
<iframe src="https://docs.google.com/document/d/1wttnA8WWDP_LF873dKItOcROKevlyufHszFvwC3PjBY/pub?embedded=true" width="100%" height="800px"></iframe>
<?php
include('connect.php');
$reponse = $bdd->query('SELECT * FROM media ORDER BY datum DESC');
while ($donnees = $reponse->fetch()){
	if(strcmp($donnees['type'],'cikk') != 0 ){
		echo "<h3 class=\"margin_bottom_20\">".$donnees['nom']."</h3>\n";
		echo "<div class=\"videoWrapper margin_bottom_20\">".$donnees['content']."</div>";
		echo "\n<p>".$donnees['descr']."</p>\n";
		echo "\n<p class=\"text_right\">".$donnees['datum']."</p><hr/>\n";
	}
	else{
		// on trouve l'image correspondant à l'id
		$id = $donnees['content'];
		$reponse2 = $bdd->query("SELECT * FROM image WHERE id = $id ");
		$donnees2 = $reponse2->fetch();
		echo "<h3>".$donnees['nom']."</h3>\n";
		echo "<img src=\"./img/".$donnees2['nom']."\" class=\"img-responsive margin_bottom_20\" alt=\"cikk\">";
		echo "\n<p>".$donnees['descr']."</p>\n";
		echo "\n<p class=\"text_right\">".$donnees['datum']."</p><hr/>\n";
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