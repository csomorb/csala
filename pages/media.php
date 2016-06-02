<div class="container">
<?php
include('connect.php');
$reponse = $bdd->query('SELECT * FROM media ORDER BY datum DESC');
while ($donnees = $reponse->fetch()){
	if(strcmp($donnees['type'],'cikk') != 0 ){
		echo "<h3>".$donnees['nom']."</h3>\n";
		echo $donnees['content'];
		echo "\n<p>".$donnees['descr']."</p><hr/>\n";
	}
	else{
		// on trouve l'image correspondant à l'id
		$id = $donnees['content'];
		$reponse2 = $bdd->query("SELECT * FROM image WHERE id = $id ");
		$donnees2 = $reponse2->fetch();
		echo "<h3>".$donnees['nom']."</h3>\n";
		echo "<img src=\"./img/".$donnees2['nom']."\" alt=\"cikk\">";
		echo "\n<p>".$donnees['descr']."</p><hr/>\n";
	}
}
?>
</div>