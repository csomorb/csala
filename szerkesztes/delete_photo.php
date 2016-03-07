<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (! empty($_POST)){
		foreach( $_POST as $cle=>$value ){
			/*On récupère le nom de l'image*/
			$req = $bdd->prepare('SELECT * FROM image WHERE id = :id');
			$req->execute(array(
			'id' => test_input($_POST[$cle])
			));
			$data = $req->fetch();
			/*Suppression des fichiers sur le disque*/
			unlink('../img/'.$data['nom']);
			unlink('../img/m_'.$data['nom']);
			$req = $bdd->prepare('DELETE FROM image WHERE id = :id');
			$req->execute(array(
			'id' => test_input($_POST[$cle])
			));	
		}
		echo "<br/><div class=\"alert alert-success\"><strong>Sikerült!</strong> Sikeres volt a törlés</div><a type=\"button\" class=\"btn btn-info\" href=\"index.php\">Vissza a főmenühöz</a>";
	}	
}
?>