<?php
include("head.php");
include("upload_photo.php");
include("generer_form_upload_photo.php");
?>
  <h1>Csendélet - Kép hozzàadàsa</h1>

<?php 
generer_upload_photo("csendelet",2);
include("foot.php");
?>