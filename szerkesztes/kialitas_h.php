<?php
include("head.php");
include("upload_photo.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$cim = test_input($_POST["cim"]);
	$date_deb = test_input($_POST["date_deb"]);
//	$photo = $_POST["photo"];
	$desc =  nl2br(test_input($_POST["desc"]));
	$date_fin = test_input($_POST["date_fin"]);
	$cord = test_input($_POST["cord"]);
	$content = $id;
	if (!empty($cim)){
		$req = $bdd->prepare("INSERT INTO kialitas (date_deb, date_fin, cord, descr, cim, photo) VALUES (:date_deb, :date_fin, :cord, :descr, :cim, :photo)");
		$req->execute(array(
			'date_deb' => $date_deb,
			'date_fin' => $date_fin,
			'cord' => $cord,
			'descr' => $desc,
			'cim' => $cim,
			'photo' => $content
		));
	}
}
?>
<h1 class="text-center">Kiállítások - kiállítás hozzáadás</h1>
<form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
  <div class="form-group">
    <label for="cim">Kiálitás neve:</label>
    <input type="text" class="form-control" id="cim" required name="cim">
  </div>
  <div class="form-group">
    <label for="input-id">Kép:</label>
    <input id="input-id" type="file" class="file" accept="image/*" data-preview-file-type="text" required name="photo">
  </div>
   <div class="form-group">
     <label for="comment">Kiàlitàs leírás (Nyitva tartás, téma, helyszín, leírás)</label></label>
      <textarea class="form-control" rows="5" id="comment" name="desc"></textarea>
  </div>
  <input type="hidden" name="cat" value="8">
  <input type="hidden" name="alt" value="kialitas">
  <div class="form-group">
	  <label for="datepicker">Kezdet:</label>
	  <input type="text" id="datepicker" required name="date_deb">
  </div>
  <div class="form-group">
	  <label for="datepicker2">Vég:</label>
	  <input type="text" id="datepicker2" required name="date_fin">
  </div>
  <div class="form-group">
    <label for="cord">Helyszín:</label>
    <input type="text" class="form-control" id="cord" required name="cord">
  </div>
  
  <button type="submit" class="btn btn-default" name="add" value="had">Hozzàadàs</button>
</form>
<br/><br/>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
  $(function() {
    $( "#datepicker" ).datepicker();
	$( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	$( "#datepicker2" ).datepicker();
	$( "#datepicker2" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
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