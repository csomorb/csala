<?php
include("head.php");
include("upload_photo.php");
include("generer_form_upload_photo_media.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$cim = test_input($_POST["cim"]);
	$photo = $_POST["photo"];
	$desc =  nl2br(test_input($_POST["desc"]));
	$datum = test_input($_POST["datum"]);
	$type = "cikk";
	$content = $id;
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
}
?>
<h1 class="text-center">Média - Cikk hozzàadàs</h1>
<?php generer_upload_photo_media();?>
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