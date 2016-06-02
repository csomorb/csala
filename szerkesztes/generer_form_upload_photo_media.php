<?php function generer_upload_photo_media(){?> 
 <form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
  <div class="form-group">
    <label for="cim">Cikk cim:</label>
    <input type="text" class="form-control" id="cim" required name="cim">
  </div>
  <div class="form-group">
    <label for="input-id">Kép:</label>
    <input id="input-id" type="file" class="file" accept="image/*" data-preview-file-type="text" required name="photo">
  </div>
   <div class="form-group">
     <label for="comment">Cikk leíràs</label>
      <textarea class="form-control" rows="5" id="comment" name="desc"></textarea>
  </div>
  <input type="hidden" name="cat" value="7">
  <input type="hidden" name="alt" value="cikk">
  <div class="form-group">
	  <label for="datepicker">Dàtum:</label>
	  <input type="text" id="datepicker" required name="datum">
  </div>
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