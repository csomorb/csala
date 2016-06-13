<?php
include("head.php");
include("upload_photo.php");
include("generer_form_upload_photo.php");
?>
  <h1>Másolat - Kép hozzàadàsa</h1>

<?php 
generer_upload_photo("masolat",10);
include("foot.php");
?>