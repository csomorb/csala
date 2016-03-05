<?php
include("head.php");
include("upload_photo.php");
?>

  <h1>Csendélet - Kép hozzàadàsa</h1>
 	
 <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
  <div class="form-group">
    <label for="input-id">Kép:</label>
    <input id="input-id" type="file" class="file" accept="image/*" data-preview-file-type="text" required name="photo">
  </div>
  <div class="form-group">
    <label for="cim">Kép cim:</label>
    <input type="text" class="form-control" id="cim" required name="cim">
  </div>
  <input type="hidden" name="cat" value="3">
  <button type="submit" class="btn btn-default" name="add" value="had">Hozzàadàs</button>
</form>
<br/><br/>




<script>
$("#input-id").fileinput({
	uploadLabel: "",
	removeLabel: "Torlés",
	browseLabel: "Kép vàlasztàs",
	uploadClass: "display-none"
});
</script>
<?php
include("foot.php");
?>