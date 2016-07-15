<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$cim = test_input($_POST["cim"]);
	$alt = test_input($_POST["alt"]);
	$desc = nl2br(test_input($_POST["desc"]));
	$cat = test_input($_POST["cat"]);
	/*Recherche du dernier nom disponible*/
	$reponse = $bdd->query("SELECT * FROM image ORDER BY id DESC");
	$donnees = $reponse->fetch();
	$id = $donnees['id']+1;
	$nom_fichier = $donnees['id']+1 .".".strtolower(substr(strrchr($_FILES['photo']['name'],'.'),1));
	$reponse->closeCursor();
	/*Upload et redimentionnemnt des images sur les serveur*/
	$upload1 = upload('photo','../img/'.$nom_fichier,FALSE, array('png','jpg','jpeg','JPG','JPEG','PNG') );
	$upload2 = upload('photo2','../img/m_'.$nom_fichier,FALSE, array('png','jpg','jpeg','JPG','JPEG','PNG') );
	if ($upload1 && $upload2) $msg = "<div class=\"alert alert-success\"><strong>Sikerült!</strong> Sikeres volt a kép feltöltés</div><a type=\"button\" class=\"btn btn-info\" href=\"index.php\">Vissza a főmenühöz</a>";
	else $msg = "<div class=\"alert alert-danger\">Echèc de l'upload de l'image</div>";
//	echo $msg;
 //redimentionnement
// ini_set("display_errors",true);
//	if (!fct_redim_image(1200,0,'','','../img/',$nom_fichier)) $msg.=""; //échec du redimentionnement 1200
//	if (!fct_redim_image(250,0,'','m_'.$nom_fichier,'../img/',$nom_fichier)) $msg.=" echec du redimentionnement de l'image pour le 250";
	echo $msg;
	/*Récupérer la hauteur et la largeur*/
	list($width, $height, $type, $attr) = getimagesize('../img/'.$nom_fichier);
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$req = $bdd->prepare("INSERT INTO image (id, nom, cat, largeur, hauteur, cim, alt, descr) VALUES (:id, :nom, :cat, :largeur, :hauteur, :cim, :alt, :descr)");
	$req->execute(array(
	'id' => $id,
    'nom' => $nom_fichier,
    'largeur' => $width,
    'hauteur' => $height,
    'cim' => $cim,
    'alt' => $alt,
	'descr' => $desc,
	'cat' => $cat
    ));
}

function upload($index,$destination,$maxsize=FALSE,$extensions=FALSE)
{
   //Test1: fichier correctement uploadé
     if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;
   //Test2: taille limite
     if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;
   //Test3: extension
     $ext = substr(strrchr($_FILES[$index]['name'],'.'),1);
     if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;
   //Déplacement
     return move_uploaded_file($_FILES[$index]['tmp_name'],$destination);
}
 
 


// --------------------------------------------------------------------------------------------------

?>