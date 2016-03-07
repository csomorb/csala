<?php
include("head.php");
include("upload_photo.php");
include("generer_form_upload_photo.php");
?>
  <h1>Portré - Kép hozzàadàsa</h1>

<?php 
generer_upload_photo("portre",1);
include("foot.php");
?>