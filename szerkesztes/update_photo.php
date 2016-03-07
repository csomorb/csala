<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (! empty($_POST)){
		$cim = test_input($_POST["cim"]);
		$id = test_input($_POST["id"]);
		$descr = nl2br(test_input($_POST["desc"]));
		$req = $bdd->prepare('UPDATE image SET cim = :cim, descr = :descr WHERE id = :id');
		$req->execute(array(
			'cim' => $cim,
			'descr' => $descr,
			'id' => $id
		));
		echo "<br/><div class=\"alert alert-success\"><strong>Sikerült!</strong> Sikeres volt a kép modositàs.</div><a type=\"button\" class=\"btn btn-info\" href=\"index.php\">Vissza a főmenühöz</a>";
	}
}
?>