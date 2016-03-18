<?php
include("head.php");
?>
<h1 class="text-center">Média - Cikk hozzàadàs</h1>
<form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
  <div class="form-group">
    <label for="cim">Cikk cim:</label>
    <input type="text" class="form-control" id="cim" name="cim">
  </div>
  <div class="form-group">
    <label for="content">Kép: </label>
    <input id="input-id" type="file" class="file" accept="image/*" data-preview-file-type="text" required name="photo">
  </div>
   <div class="form-group">
     <label for="comment">Cikk leíràs:</label>
      <textarea class="form-control" rows="5" id="comment" name="desc"></textarea>
  </div>
  <div class="form-group">
	<label for="datepicker">Dàtum:</label>
	<input type="text" id="datepicker" required name="datum">
  </div>
  <button type="submit" class="btn btn-default" name="add" value="had">Hozzàadàs</button>
</form>
<br/><br/>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
  $(function() {
    $( "#datepicker" ).datepicker();
	$( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
  });
  </script>
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