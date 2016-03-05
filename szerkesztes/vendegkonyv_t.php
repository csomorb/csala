<?php
include("head.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (! empty($_POST)){
		foreach( $_POST as $cle=>$value ){
			$value;
			$req = $bdd->prepare('DELETE FROM livre WHERE id = :id');
			$req->execute(array(
			'id' => test_input($_POST[$cle])
			));	
		}
		echo "<br/><div class=\"alert alert-success\"><strong>Sikerült!</strong> Sikeres volt a törlés</div><a type=\"button\" class=\"btn btn-info\" href=\"index.php\">Vissza a főmenühöz</a>";
	}	
}
?>
<h1 class="text-center">Vendégkönyv szerkesztése - Bejegyzések törlése</h1>
<form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
<?php
$reponse = $bdd->query("SELECT * FROM livre ORDER BY id DESC");
while ($donnees = $reponse->fetch()){
?>		
	<div class="checkbox">
		<label><input type="checkbox" name="id_<?php echo $donnees['id']?>" value="<?php echo $donnees['id']?>">Név: <?php echo $donnees['nom']?><br/>Tartalom: <?php echo substr($donnees['contenu'],0,100); 
		if (strlen($donnees['contenu'])>100)
			echo "[...]";
		?></label>
	</div>
<?php		
}
$reponse->closeCursor();
?>
<button type="submit" class="btn btn-danger">Bejegyzések törlése</button>
</form>
<br/>
<?php
include("foot.php");
?>
  