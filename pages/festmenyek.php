<div class="container">
<h1 class="text-center">Festmények</h1>
<?php
include('connect.php');
$i = 0;
$reponse = $bdd->query('SELECT * FROM categorie');
while ($donnees = $reponse->fetch()){
	if($donnees['id'] < 7 || $donnees['id'] > 9){
		if ($i % $GLOBAL['nb_categorie_ligne'] === 0)
			echo "<div class=\"row\">\n";
		echo "\t<div class=\"col-sm-". 12/$GLOBAL['nb_categorie_ligne'] ." text-center\">\n";
		$id_couverture = $donnees['id_couverture'];
		$reponse2 = $bdd->query("SELECT nom FROM image WHERE id = $id_couverture");
		$image = $reponse2->fetch(); 
		$reponse2->closeCursor();	
	?>
		<a href="<?php echo $donnees['nom_lien']; ?>" class="no_decoration">
		<img src="/img/<?php echo $image['nom']; ?>" class="img-responsive"/>
		<h3><?php echo $donnees['nom_categorie']; ?></h3>
		</a>
	<?php
		echo "\t</div>\n";
		if ($i % $GLOBAL['nb_categorie_ligne'] === $GLOBAL['nb_categorie_ligne']-1)
			echo "</div>\n";
		$i++;
	}
}
$reponse->closeCursor();
?>
</div>