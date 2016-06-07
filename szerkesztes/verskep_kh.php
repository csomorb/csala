<?php
include("head.php");
include("upload_photo.php");
include("generer_form_upload_photo.php");
?>
  <h1>Verskép - Kép hozzàadàsa</h1>

<?php 
generer_upload_photo("verskep",5);
include("foot.php");
?>