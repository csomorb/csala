<?php
include("head.php");
//suppression de la restauration
include('../pages/connect.php'); //problème d'inclusion dans head
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (! empty($_POST)){
		foreach( $_POST as $cle=>$value ){
		    $id=test_input($_POST[$cle]);
		    // on récupère le nom des images
		    $req2 = $bdd->prepare('SELECT * FROM rest_cat WHERE id_rest = :id');
			$req2->execute(array(
			    'id' => $id
			));
		    while ($data2 = $req2->fetch()){
		        // récupération des id 
		        $id_image = $data2['id_image'];
		        /*On récupère le nom de l'image*/
    			$req = $bdd->prepare('SELECT * FROM image WHERE id = :id');
    			$req->execute(array(
    			    'id' => $id_image
    			));
    			$data = $req->fetch();
    			/*Suppression des fichiers sur le disque*/
    			unlink('../img/'.$data['nom']);
    			unlink('../img/m_'.$data['nom']);
    			/*Supressions de l'image de la table image*/
    			$req = $bdd->prepare('DELETE FROM image WHERE id = :id');
    			$req->execute(array(
    			    'id' => $id_image
    			));	
		    }
		    /*Supressions de la rest de la table rest_cat*/
    		$req = $bdd->prepare('DELETE FROM rest_cat WHERE id_rest = :id');
    		$req->execute(array(
    			    'id' => $id
    		));	
    		/*Supressions de la rest de la table rest*/
    		$req = $bdd->prepare('DELETE FROM rest WHERE id = :id');
    		$req->execute(array(
    			    'id' => $id
    		));	
		}
		echo "<br/><div class=\"alert alert-success\"><strong>Sikerült!</strong> Sikeres volt a törlés</div><a type=\"button\" class=\"btn btn-info\" href=\"index.php\">Vissza a főmenühöz</a>";
	}	
}



?>
<h1 class="text-center">Restauràlàsok - Restauràlàsok törlése</h1>

<form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
<?php
$reponse = $bdd->query("SELECT * FROM rest ORDER BY id DESC");
while ($donnees = $reponse->fetch()){
?>	
	<div class="checkbox delete">
		<label><input type="checkbox" name="id_<?php echo $donnees['id']?>" value="<?php echo $donnees['id']?>">
		<p><span class="lead"><?php echo $donnees['cim']?></span><br/><?php echo $donnees['descr']?></p>
		</label>
	</div>
<?php		
}
$reponse->closeCursor();
?>
<button type="submit" class="btn btn-danger">Restauràlàsok törlése</button>
</form>
<br/>
<?php
include("foot.php");
?>