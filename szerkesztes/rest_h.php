<?php
include("head.php");
echo "A képek mérete összességében nem lépheti tul a  ".ini_get(upload_max_filesize)."-àt. <br/>";
$nb_image = 10;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cim = test_input($_POST["cim"]);
	$alt = test_input($_POST["alt"]);
	$desc = nl2br(test_input($_POST["desc"]));
	$cat = test_input($_POST["cat"]);
    $date_deb = test_input($_POST["date_deb"]);
    $date_fin = test_input($_POST["date_fin"]);
    /*Enregistrement de la restauration*/
    $req = $bdd->prepare("INSERT INTO rest (id, cim , descr, date_deb, date_fin) VALUES (:id, :cim, :descr, :date_deb, :date_fin)");
    $req->execute(array(
                	'id' => $id_rest,
                    'cim' => $cim,
                    'descr' => $desc,
                    'date_deb' => $date_deb,
                    'date_fin' => $date_fin
    ));
    /*Récupération de la dernière id*/
    $reponse = $bdd->query("SELECT * FROM rest ORDER BY id DESC");
    $donnees = $reponse->fetch();
    $id_rest = $donnees['id'];
    $reponse->closeCursor();
    
    /**UPLOAD DES IMAGES**/
    // génération des uploadeurs d'image
    for($i = 0 ; $i < $nb_image; $i++){
        if(isset($_FILES["photo_".$i])){
            if ($_FILES["photo_".$i]['error'] == 0 && $_FILES["photo_m_".$i]['error'] == 0){
            // tout va bien    
            	/*Recherche du dernier nom disponible*/
            	$reponse = $bdd->query("SELECT * FROM image ORDER BY id DESC");
            	$donnees = $reponse->fetch();
            	$id = $donnees['id']+1;
            	$nom_fichier = $donnees['id']+1 .".".strtolower(substr(strrchr($_FILES['photo_'.$i]['name'],'.'),1));
            	$reponse->closeCursor();
                
                /*Upload et redimentionnemnt des images sur les serveur*/
            	$upload1 = upload('photo_'.$i,'../img/'.$nom_fichier,FALSE, array('png','jpg','jpeg','JPG','JPEG','PNG') );
            	$upload1 = upload('photo_m_'.$i,'../img/m_'.$nom_fichier,FALSE, array('png','jpg','jpeg','JPG','JPEG','PNG') );
            	if ($upload1 && $upload2) $msg = "<div class=\"alert alert-success\"><strong>Sikerült!</strong> Sikeres volt a kép feltöltés</div><a type=\"button\" class=\"btn btn-info\" href=\"index.php\">Vissza a főmenühöz</a>";
            	else $msg = "<div class=\"alert alert-danger\">Echèc de l'upload de l'image</div>";
            	//if (!fct_redim_image(1200,0,'','','../img/',$nom_fichier)) $msg.="Az eggyik kép nincs meg 1200px széles!"; //échec du redimentionnement 1200
            	//if (!fct_redim_image(250,0,'','m_'.$nom_fichier,'../img/',$nom_fichier)) $msg.=" echec du redimentionnement de l'image pour le 250";
            	  
                /*Récupérer la hauteur et la largeur*/
	            list($width, $height, $type, $attr) = getimagesize('../img/'.$nom_fichier);
	            /*Récupération du titre et de la description de l'image*/
	            $desc_image = test_input($_POST["desc_".$i]);
	            $nom_image = test_input($_POST["cim_".$i]);
	            /*Enregistrement dans la bdd image*/
                $req = $bdd->prepare("INSERT INTO image (id, nom, cat, largeur, hauteur, cim, alt, descr) VALUES (:id, :nom, :cat, :largeur, :hauteur, :cim, :alt, :descr)");
                	$req->execute(array(
                	'id' => $id,
                    'nom' => $nom_fichier,
                    'largeur' => $width,
                    'hauteur' => $height,
                    'cim' => $nom_image,
                    'alt' => $alt,
                	'descr' => $desc_image,
                	'cat' => $cat
                ));
                /*enregistrement dans la bdd rest_cat*/
                $req = $bdd->prepare("INSERT INTO rest_cat (id_rest, id_image) VALUES (:id_rest, :id_image)");
                	$req->execute(array(
                	'id_rest' => $id_rest,
                    'id_image' => $id
                ));
                
            }
        }
    }
    echo $msg;  
}

//fonction pour l'upload d'images

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




?>
<h1 class="text-center">Restauràlàsok - Restauràlàsok hozzáadása</h1>
<form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
  <div class="form-group">
    <label for="cim">Restauràlàs neve:</label>
    <input type="text" class="form-control" id="cim" required name="cim">
  </div>
   
  <input type="hidden" name="cat" value="9">
  <input type="hidden" name="alt" value="kialitas">
   <div class="form-group">
     <label for="comment">Restauràlàs leírása: </label>
      <textarea class="form-control" rows="5" id="comment" name="desc"></textarea>
  </div>
  
  
   <div class="form-group">
	  <label for="datepicker">Kezdet:</label>
	  <input type="text" id="datepicker" required name="date_deb">
  </div>
  <div class="form-group">
	  <label for="datepicker2">Vég:</label>
	  <input type="text" id="datepicker2" required name="date_fin">
  </div>
  
  
 <?php 
  
  for ($i = 0; $i < $nb_image;  $i++){
  echo "<div class=\"form-group\">";
  echo "<label for=\"input-".$i."\">Kép 1200p:</label>";
  echo "<input id=\"input-".$i."\" type=\"file\" class=\"file\" accept=\"image/*\" data-preview-file-type=\"text\" name=\"photo_".$i."\">";
  echo "</div>";
  echo "<div class=\"form-group\">";
  echo "<label for=\"input-m-".$i."\">Kép 250px:</label>";
  echo "<input id=\"input-m-".$i."\" type=\"file\" class=\"file\" accept=\"image/*\" data-preview-file-type=\"text\" name=\"photo_m_".$i."\">";
  echo "</div>";
  echo "<div class=\"form-group\">";
  echo "<label for=\"cim_".$i."\">Kép Neve:</label>";
  echo "<input type=\"text\" class=\"form-control\" id=\"cim_".$i."\" name=\"cim_".$i."\">";
  echo "</div>";
  echo "<div class=\"form-group\">";
  echo "<label for=\"comment_".$i."\">Restauràlàs leírása: </label>";
  echo "<textarea class=\"form-control\" rows=\"5\" id=\"comment_".$i."\" name=\"desc_".$i."\"></textarea>";
  echo "</div>";
  }
  //génération du script
  echo "<script>$(\"#input-0,#input-m-0 ";
  for($i =1 ; $i < $nb_image; $i++){
      echo ",#input-".$i." ,#input-m-".$i." ";
  }
  echo "\").fileinput({ uploadLabel: \"\", removeLabel: \"Torlés\", browseLabel: \"Kép vàlasztàs\",uploadClass: \"display-none\" });</script>"
  
  ?>

  
  <button type="submit" class="btn btn-default" name="add" value="had">Hozzàadàs</button>
</form>
<br/><br/>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
  $(function() {
    $( "#datepicker" ).datepicker();
	$( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	$( "#datepicker2" ).datepicker();
	$( "#datepicker2" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
  });
  </script>

<?php
include("foot.php");
?>