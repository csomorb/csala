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
<body>
<div class="container">
<h1 class="text-center">Szerkeztés</h1>
<a href="#" id="festmenyek_m"><h2>Festmények szerkesztése</h2></a>
	<div id="festmenyek_s">
		<a href="#" id="csendelet_m" class="festmenyek_all"><h3>Csendélet szerkesztése</h3></a>
		<div id="csendelet_s">
			<a href="csendelet_kh.php" type="button" class="btn btn-primary festmenyek_all_all" id="csendelet_kh">Kép hozzáadása</a>	
			<a href="csendelet_kt.php" type="button" class="btn btn-primary festmenyek_all_all" id="csendelet_kt">Képpek törlése</a>
			<a href="csendelet_km.php" type="button" class="btn btn-primary festmenyek_all_all" id="csendelet_km">Képpek modositása</a>
		</div>
		<a href="#" id="onarckep_m" class="festmenyek_all"><h3>Önarckép szerkesztése</h3></a>
		<div id="onarckep_s">
			<a href="onarckep_kh.php" type="button" class="btn btn-primary festmenyek_all_all" id="onarckep_kh">Kép hozzáadása</a>	
			<a href="onarckep_kt.php" type="button" class="btn btn-primary festmenyek_all_all" id="onarckep_kt">Képpek törlése</a>
			<a href="onarckep_km.php" type="button" class="btn btn-primary festmenyek_all_all" id="onarckep_km">Képpek modositása</a>
		</div>
		<a href="#" id="portre_m" class="festmenyek_all"><h3>Portré szerkesztése</h3></a>
		<div id="portre_s">
			<a href="portre_kh.php" type="button" class="btn btn-primary festmenyek_all_all" id="portre_kh">Kép hozzáadása</a>	
			<a href="portre_kt.php" type="button" class="btn btn-primary festmenyek_all_all" id="portre_kt">Képpek törlése</a>
			<a href="portre_km.php" type="button" class="btn btn-primary festmenyek_all_all" id="portre_km">Képpek modositása</a>
		</div>
		<a href="#" id="verskep_m" class="festmenyek_all"><h3>Verskép szerkesztése</h3></a>
		<div id="verskep_s">
			<a href="verskep_kh.php" type="button" class="btn btn-primary festmenyek_all_all" id="verskep_kh">Kép hozzáadása</a>	
			<a href="verskep_kt.php" type="button" class="btn btn-primary festmenyek_all_all" id="verskep_kt">Képpek törlése</a>
			<a href="verskep_km.php" type="button" class="btn btn-primary festmenyek_all_all" id="verskep_km">Képpek modositása</a>
		</div>
		<a href="#" id="tajkep_m" class="festmenyek_all"><h3>Tájkép szerkesztése</h3></a>
		<div id="tajkep_s">
			<a href="tajkep_kh.php" type="button" class="btn btn-primary festmenyek_all_all" id="tajkep_kh">Kép hozzáadása</a>	
			<a href="tajkep_kt.php" type="button" class="btn btn-primary festmenyek_all_all" id="tajkep_kt">Képpek törlése</a>
			<a href="tajkep_km.php" type="button" class="btn btn-primary festmenyek_all_all" id="tajkep_km">Képpek modositása</a>
		</div>
		<a href="#" id="egyeb_m" class="festmenyek_all"><h3>Egyéb szerkesztése</h3></a>
		<div id="egyeb_s">
			<a href="egyeb_kh.php" type="button" class="btn btn-primary festmenyek_all_all" id="egyeb_kh">Kép hozzáadása</a>	
			<a href="egyeb_kt.php" type="button" class="btn btn-primary festmenyek_all_all" id="egyeb_kt">Képpek törlése</a>
			<a href="egyeb_km.php" type="button" class="btn btn-primary festmenyek_all_all" id="egyeb_km">Képpek modositása</a>
		</div>
	</div>
<a href="#" id="restauralasok_m"><h2>Restauràlàsok szerkesztése</h2></a>
<a href="#" id="vendegkonyv_m"><h2>Vendégkönyv szerkesztése</h2></a>
<div id="vendegkonyv_s">
			<a href="vendegkonyv_m.php" type="button" class="btn btn-primary" id="egyeb_kh">Bejegyzések modositàsa</a>	
			<a href="vendegkonyv_t.php" type="button" class="btn btn-primary" id="egyeb_kt">Bejegyzések törlése</a>
</div>
<a href="#" id="media_m"><h2>Média szerkesztése</h2></a>
	<div id="media_s">
		<a href="media_ch.php" type="button" class="btn btn-primary">Cikk hozzàadàs</a>
		<a href="media_vh.php" type="button" class="btn btn-primary">Video hozzàadàs</a>
	</div>
<a href="#" id="jialitasok_m"><h2>Kiàlitások szerkesztése</h2></a>
</div>
<script>
$(document).ready(function(){
	function cacher(nom_cat_a_pas_casher){
		if(nom_cat_a_pas_casher !== 'festmenyek_s')
			$("#festmenyek_s").slideUp();
		if(nom_cat_a_pas_casher !== 'vendegkonyv_s')
			$("#vendegkonyv_s").slideUp();
	}
	
	$("#csendelet_m").click(function(e){
		e.preventDefault();
     //   $(".festmenyek_all").hide();
		$(".festmenyek_all_all").hide();
		$("#csendelet_m").show();
		$("#csendelet_s").show();
		$("#csendelet_s .festmenyek_all_all").show();
    });
	
	$("#onarckep_m").click(function(e){
		e.preventDefault();
      //  $(".festmenyek_all").hide();
		$(".festmenyek_all_all").hide();
		$("#onarckep_m").show();
		$("#onarckep_s").show();
		$("#onarckep_s .festmenyek_all_all").show();
    });
	
	$("#portre_m").click(function(e){
		e.preventDefault();
      //  $(".festmenyek_all").hide();
		$(".festmenyek_all_all").hide();
		$("#portre_m").show();
		$("#portre_s").show();
		$("#portre_s .festmenyek_all_all").show();
    });
	
	$("#verskep_m").click(function(e){
		e.preventDefault();
    //    $(".festmenyek_all").hide();
		$(".festmenyek_all_all").hide();
		$("#verskep_m").show();
		$("#verskep_s").show();
		$("#verskep_s .festmenyek_all_all").show();
    });
	
	$("#tajkep_m").click(function(e){
		e.preventDefault();
   //     $(".festmenyek_all").hide();
		$(".festmenyek_all_all").hide();
		$("#tajkep_m").show();
		$("#tajkep_s").show();
		$("#tajkep_s .festmenyek_all_all").show();
    });
	
	$("#egyeb_m").click(function(e){
		e.preventDefault();
    //    $(".festmenyek_all").hide();
		$(".festmenyek_all_all").hide();
		$("#egyeb_m").show();
		$("#egyeb_s").show();
		$("#egyeb_s .festmenyek_all_all").show();
    });
		
	$("#festmenyek_m").click(function(e){
		e.preventDefault();
		cacher("festmenyek_s");
        $("#festmenyek_s").show();
		$(".festmenyek_all").show();
		$(".festmenyek_all_all").hide();
    });
	
	$("#vendegkonyv_m").click(function(e){
		e.preventDefault();
		cacher("vendegkonyv_s");
		$("#vendegkonyv_s").show();
    });
	
	
	/*cacher les sous-catégories*/
	$(".festmenyek_all").hide();
	$("#festmenyek_s").hide();
	$(".festmenyek_all_all").hide();
	$("#vendegkonyv_s").hide();
//	$("#csendelet_s").hide();
});
</script>

</body>
</html>

