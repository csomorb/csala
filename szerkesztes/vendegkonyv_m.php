<?php
include("head.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$nom = test_input($_POST['nom']);
	$contenu = nl2br(test_input($_POST['contenu']));
	$id = test_input($_POST['id']);
	$req = $bdd->prepare('UPDATE livre SET nom = :nnom, contenu = :ncontenu WHERE id = :id');
	$req->execute(array(
		'nnom' => $nom,
		'ncontenu' => $contenu,
		'id' => $id
	));	
	echo "<br/><div class=\"alert alert-success\"><strong>Sikerült!</strong> Sikeres volt a modositàs</div><a type=\"button\" class=\"btn btn-info\" href=\"index.php\">Vissza a főmenühöz</a>";
}
?>
<h1 class="text-center">Vendégkönyv szerkesztése - Bejegyzések modositàsa</h1>
<?php
$reponse = $bdd->query("SELECT * FROM livre ORDER BY id DESC");
while ($donnees = $reponse->fetch()){
?>		
	<form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
		<div class="form-group">
			<label for="nom">Név:</label>
			<input id="nom" type="text" class="form-control" required name="nom" value="<?php echo $donnees['nom'];?>">
		</div>
		<div class="form-group">
		<label for="cim">Tartalom:</label>
			<textarea class="form-control" rows="5" id="cim" name="contenu"><?php echo str_replace('<br />', '',$donnees['contenu']);?></textarea>
		</div>
		<button type="submit" class="btn btn-default" name="id" value="<?php echo $donnees['id'];?>">Bejegyzés modositàsa</button>
	</form>
	<hr/>
<?php		
}
$reponse->closeCursor();
include("foot.php");
?>