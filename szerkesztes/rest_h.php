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
            if ($_FILES["photo_".$i]['error'] == 0){
            // tout va bien    
            	/*Recherche du dernier nom disponible*/
            	$reponse = $bdd->query("SELECT * FROM image ORDER BY id DESC");
            	$donnees = $reponse->fetch();
            	$id = $donnees['id']+1;
            	$nom_fichier = $donnees['id']+1 .".".strtolower(substr(strrchr($_FILES['photo_'.$i]['name'],'.'),1));
            	$reponse->closeCursor();
                
                /*Upload et redimentionnemnt des images sur les serveur*/
            	$upload1 = upload('photo_'.$i,'../img/'.$nom_fichier,FALSE, array('png','jpg','jpeg','JPG','JPEG','PNG') );
            	if ($upload1) $msg = "<div class=\"alert alert-success\"><strong>Sikerült!</strong> Sikeres volt a kép feltöltés</div><a type=\"button\" class=\"btn btn-info\" href=\"index.php\">Vissza a főmenühöz</a>";
            	else $msg = "<div class=\"alert alert-danger\">Echèc de l'upload de l'image</div>";
            	if (!fct_redim_image(1200,0,'','','../img/',$nom_fichier)) $msg.="Az eggyik kép nincs meg 1200px széles!"; //échec du redimentionnement 1200
            	if (!fct_redim_image(250,0,'','m_'.$nom_fichier,'../img/',$nom_fichier)) $msg.=" echec du redimentionnement de l'image pour le 250";
            	  
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

function fct_redim_image($Wmax, $Hmax, $rep_Dst, $img_Dst, $rep_Src, $img_Src) {
  // ------------------------------------------------------------------
 $condition = 0;
  // Si certains paramètres ont pour valeur '' :
   if ($rep_Dst == '') { $rep_Dst = $rep_Src; }  // (meme repertoire)
   if ($img_Dst == '') { $img_Dst = $img_Src; }  // (meme nom)
   if ($Wmax == '') { $Wmax = 0; }
   if ($Hmax == '') { $Hmax = 0; }	
  // ------------------------------------------------------------------
  // si le fichier existe dans le répertoire, on continue...
 if (file_exists($rep_Src.$img_Src) && ($Wmax!=0 || $Hmax!=0)) { 
    // ----------------------------------------------------------------
    // extensions acceptées : 
   $ExtfichierOK = '" jpg jpeg png"';  // (l espace avant jpg est important)
    // extension
   $tabimage = explode('.',$img_Src);
   $extension = $tabimage[sizeof($tabimage)-1];  // dernier element
   $extension = strtolower($extension);  // on met en minuscule
    // ----------------------------------------------------------------
    // extension OK ? on continue ...
   if (strpos($ExtfichierOK,$extension) != '') {
       // -------------------------------------------------------------
       // récupération des dimensions de l image Src
      $size = getimagesize($rep_Src.$img_Src);
      $W_Src = $size[0];  // largeur
      $H_Src = $size[1];  // hauteur
       // -------------------------------------------------------------
       // condition de redimensionnement et dimensions de l image finale
       // -------------------------------------------------------------
       // A- LARGEUR ET HAUTEUR maxi fixes
      if ($Wmax != 0 && $Hmax != 0) {
         $ratiox = $W_Src / $Wmax;  // ratio en largeur
         $ratioy = $H_Src / $Hmax;  // ratio en hauteur
         $ratio = max($ratiox,$ratioy);  // le plus grand
         $W = $W_Src/$ratio;
         $H = $H_Src/$ratio;   
         $condition = ($W_Src>$W) || ($W_Src>$H);  // 1 si vrai (true)
      }
       // -------------------------------------------------------------
       // B- LARGEUR maxi fixe
      if ($Hmax != 0 && $Wmax == 0) {
         $H = $Hmax;
         $W = $H * ($W_Src / $H_Src);
         $condition = $H_Src > $Hmax;  // 1 si vrai (true)
      }
       // -------------------------------------------------------------
       // C- HAUTEUR maxi fixe
      if ($Wmax != 0 && $Hmax == 0) {
         $W = $Wmax;
         $H = $W * ($H_Src / $W_Src);         
         $condition = $W_Src > $Wmax;  // 1 si vrai (true)
      }
       // -------------------------------------------------------------
       // on REDIMENSIONNE si la condition est vraie
       // -------------------------------------------------------------
      if ($condition == 1) {
          // création de la ressource-image"Src" en fonction de l extension
          // et on crée une ressource-image"Dst" vide aux dimensions finales
         switch($extension) {
         case 'jpg':
         case 'jpeg':
           $Ress_Src = imagecreatefromjpeg($rep_Src.$img_Src);
           $Ress_Dst = ImageCreateTrueColor($W,$H);
           break;
         case 'png':
           $Ress_Src = imagecreatefrompng($rep_Src.$img_Src);
           $Ress_Dst = ImageCreateTrueColor($W,$H);
            // fond transparent (pour les png avec transparence)
           imagesavealpha($Ress_Dst, true);
           $trans_color = imagecolorallocatealpha($Ress_Dst, 0, 0, 0, 127);
           imagefill($Ress_Dst, 0, 0, $trans_color);
           break;
         }
          // ----------------------------------------------------------
          // REDIMENSIONNEMENT (copie, redimensionne, ré-echantillonne)
         ImageCopyResampled($Ress_Dst, $Ress_Src, 0, 0, 0, 0, $W, $H, $W_Src, $H_Src); 
          // ----------------------------------------------------------
          // ENREGISTREMENT dans le répertoire (avec la fonction appropriée)
         switch ($extension) { 
         case 'jpg':
         case 'jpeg':
           ImageJpeg ($Ress_Dst, $rep_Dst.$img_Dst);
           break;
         case 'png':
           imagepng ($Ress_Dst, $rep_Dst.$img_Dst);
           break;
         }
          // ----------------------------------------------------------
          // libération des ressources-image
         imagedestroy ($Ress_Src);
         imagedestroy ($Ress_Dst);
      }
       // -------------------------------------------------------------
   }
 }
// --------------------------------------------------------------------------------------------------
  // retourne : 1 (vrai) si le redimensionnement et l enregistrement ont bien eu lieu, sinon rien (false)
  // si le fichier a bien été créé
 if ($condition == 1 && file_exists($rep_Dst.$img_Dst)) { return true; }
 else { return false; }
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
  echo "<label for=\"input-".$i."\">Kép:</label>";
  echo "<input id=\"input-".$i."\" type=\"file\" class=\"file\" accept=\"image/*\" data-preview-file-type=\"text\" name=\"photo_".$i."\">";
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
  echo "<script>$(\"#input-0 ";
  for($i =1 ; $i < $nb_image; $i++){
      echo ",#input-".$i." ";
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