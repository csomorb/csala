<?php
function genere_delete($cat){
?>
<form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
<?php
include('../pages/connect.php'); //problème d'inclusion dans head?
$reponse = $bdd->query("SELECT * FROM image WHERE cat = $cat ORDER BY id DESC");
while ($donnees = $reponse->fetch()){
?>	
	<div class="checkbox delete">
		<label><input type="checkbox" name="id_<?php echo $donnees['id']?>" value="<?php echo $donnees['id']?>">
		<img src="../img/m_<?php echo $donnees['nom']?>"/>
		<p><span class="lead"><?php echo $donnees['cim']?></span><br/><?php echo $donnees['descr']?></p>
		</label>
	</div>
<?php		
}
$reponse->closeCursor();
?>
<button type="submit" class="btn btn-danger">Képek törlése</button>
</form>
<br/>
<?php
}
?>
