<?php
include("head.php");
include("upload_photo.php");
include("generer_form_upload_photo.php");
?>
  <h1>Aktok - Kép hozzàadàsa</h1>

<?php 
generer_upload_photo("aktok",4);
include("foot.php");
?>