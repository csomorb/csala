<?php
include("head.php");
var_dump($_POST);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$cim = test_input($_POST["cim"]);
	$content = $_POST["content"];
	$desc =  nl2br(test_input($_POST["desc"]));
	$datum = test_input($_POST["datum"]);
	$type = "video";
	if (!empty($cim)){
		$req = $bdd->prepare("INSERT INTO media (datum, nom, content, type, descr) VALUES (:datum, :nom, :content, :type, :descr)");
		$req->execute(array(
			'nom' => $cim,
			'datum' => $datum,
			'content' => $content,
			'type' => $type,
			'descr' => $desc
		));
	}
	echo "<div class=\"alert alert-success\"><strong>Sikerült!</strong> Sikeres volt a video feltöltés</div><a type=\"button\" class=\"btn btn-info\" href=\"index.php\">Vissza a főmenühöz</a>";
}
?>
<h1 class="text-center">Média - Video hozzàadàs</h1>
<form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
  <div class="form-group">
    <label for="cim">Vidéo cim:</label>
    <input type="text" class="form-control" id="cim" required name="cim">
  </div>
  <div class="form-group">
    <label for="content">Youtube link -> Megosztàs -> Integràlàs</label>
    <input type="text" class="form-control" id="content" required name="content">
  </div>
   <div class="form-group">
     <label for="comment">Vidéo leíràs:</label>
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

<?php
include("foot.php");
?>