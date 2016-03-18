<div class="container">
<?php
include('connect.php');
$reponse = $bdd->query('SELECT * FROM media ORDER BY datum DESC');
while ($donnees = $reponse->fetch()){
	echo "<h3>".$donnees['nom']."</h3>\n";
	echo $donnees['content'];
	echo "\n<p>".$donnees['descr']."</p><hr/>\n";
}
?>
</div>