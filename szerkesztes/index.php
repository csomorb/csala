<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Szerkeztes</title>
    <script src="../script/jquery-2.2.1.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!-- font Raleay-->
	<link href='https://fonts.googleapis.com/css?family=Raleway:400,600&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<!-- css -->
	<link rel="stylesheet" href="../css/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php
function ajout_image($nom_categorie){

}
?>
<body>
<div class="container">
<h1 class="text-center">Szerkeztés</h1>
<a href="#" id="festmenyek_m"><h2>Festmények szerkesztése</h2></a>
	<div id="festmenyek_s">
		<a href="#" id="csendelet_m" class="festmenyek_all">Csendélet szerkesztése</a>
		<div id="csendelet_s">
			<a href="#" class="festmenyek_all_all" id="csendelet_kh">Kép hozzáadása</a>
			
			<a href="#" class="festmenyek_all_all" id="csendelet_kt">Képpek törlése</a>
			<a href="#" class="festmenyek_all_all" id="csendelet_km">Képpek modositása</a>
		</div>
		<a href="#" id="onarckep_m" class="festmenyek_all">Önarckép szerkesztése</a>
		<a href="#" id="portre_m" class="festmenyek_all">Portré szerkesztése</a>
		<a href="#" id="verskep_m" class="festmenyek_all">Verskép szerkesztése</a>
		<a href="#" id="tajkep_m" class="festmenyek_all">Tájkép szerkesztése</a>
		<a href="#" id="egyeb_m" class="festmenyek_all">Egyéb szerkesztése</a>
	</div>


<form class="form-inline" role="form">
  <div class="form-group">
    <label class="control-label">Select File</label>
    <input id="input-1" type="file" class="file">
  </div>
  <div class="form-group">
    <label class="sr-only" for="cim">Kép cím:</label>
    <input type="text" class="form-control" id="cim">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>

</div>
</body>
</html>
<script>
$(document).ready(function(){
	$("#csendelet_m").click(function(e){
		e.preventDefault();
        $(".festmenyek_all").hide();
		$("#csendelet_m").show();
		$("#csendelet_s").show();
    });
	
	$("#festmenyek_m").click(function(e){
		e.preventDefault();
        $("#festmenyek_s").show();
		$(".festmenyek_all").show();
		$(".festmenyek_all_all").hide();
    });
	
/*	$("#festmenyek_m").click(function(e){
		e.preventDefault();
        $("#festmenyek_s").show();
		$(".festmenyek_all").show();
    });
*/	
	$("#csendelet_kh").click(function(e){
		e.preventDefault();
        $(".festmenyek_all_all").hide();
		//$(".festmenyek_all").show();
    });
	
	/*cacher les sous-catégories*/
	$("#festmenyek_s").hide();
	$("#csendelet_s").hide();
});
</script>
