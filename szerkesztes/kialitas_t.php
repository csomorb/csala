<?php
include("head.php");
//suppression de la restauration
include('../pages/connect.php'); //problème d'inclusion dans head
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (! empty($_POST)){
		foreach( $_POST as $cle=>$value ){
		    $id=test_input($_POST[$cle]);
		    // on récupère le nom des images
		    $req2 = $bdd->prepare('SELECT * FROM kialitas WHERE id = :id');
			$req2->execute(array(
			    'id' => $id
			));
		    while ($data2 = $req2->fetch()){
		        // récupération des id 
		        $id_image = $data2['photo'];
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
		    /*Supressions de la table kialitas*/
    		$req = $bdd->prepare('DELETE FROM kialitas WHERE id = :id');
    		$req->execute(array(
    			    'id' => $id
    		));	
		}
		echo "<br/><div class=\"alert alert-success\"><strong>Sikerült!</strong> Sikeres volt a törlés</div><a type=\"button\" class=\"btn btn-info\" href=\"index.php\">Vissza a főmenühöz</a>";
	}	
}



?>
<h1 class="text-center">Kiállítások - kiállítás törlése</h1>

<form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
<?php
$reponse = $bdd->query("SELECT * FROM kialitas ORDER BY id DESC");
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
<button type="submit" class="btn btn-danger">Kiàlitàsok törlése</button>
</form>
<br/>
<?php
include("foot.php");
?>