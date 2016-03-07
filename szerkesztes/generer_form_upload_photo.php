<?php function generer_upload_photo($alt,$cat){?> 
 <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
  <div class="form-group">
    <label for="input-id">Kép:</label>
    <input id="input-id" type="file" class="file" accept="image/*" data-preview-file-type="text" required name="photo">
  </div>
  <div class="form-group">
    <label for="cim">Kép cim:</label>
    <input type="text" class="form-control" id="cim" required name="cim">
  </div>
   <div class="form-group">
     <label for="comment">Kép leíràs (méret, dàtum,...):</label>
      <textarea class="form-control" rows="5" id="comment" name="desc"></textarea>
  </div>
  <input type="hidden" name="cat" value="<?php echo $cat; ?>">
  <input type="hidden" name="alt" value="<?php echo $alt; ?>">
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
}
?>