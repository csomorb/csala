<div class="container">
<h2 class="text-center">Verskép</h2>
<?php 
//include("./pages/generate_galleri.php");
//echo generer_galleri(5);
//include("./pages/galleri_html.php");
include('connect.php');
$reponse = $bdd->query("SELECT * FROM image WHERE cat = 5");
while ($donnees = $reponse->fetch()){
    
    echo "<div class=\"row\">";
    echo    "<div class=\"col-sm-6\">";
    echo "<h3 class=\"text-center\">".$donnees['cim']."</h3>";
    echo       "<p>".$donnees['descr']."</p>";
    echo    "</div>";
    echo    "<div class=\"col-sm-6\">";
    echo       "<img src=\"../img/".$donnees['nom']."\" class=\"img-responsive\">";
    echo    "</div>";
	echo "</div>";
	echo "<hr/>";
}
?>
</div>