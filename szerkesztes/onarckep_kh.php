<?php
include("head.php");
include("upload_photo.php");
include("generer_form_upload_photo.php");
?>
  <h1>Önarckép - Kép hozzàadàsa</h1>

<?php 
generer_upload_photo("onarckep",6);
include("foot.php");
?>