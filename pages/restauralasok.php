<div class="container">
<h2 class="text-center">Restauràlàsok</h2>
<?php 
include('connect.php');
// génération de chaque restauration
$reponse = $bdd->query("SELECT * FROM rest");
while ($donnees = $reponse->fetch()){
	    echo "<h3>".$donnees['cim']."</h3>\n";
	    echo "\n<p>".$donnees['descr']."</p>\n";
	    //récupération des id images
	    $id_rest = $donnees['id'];
	    echo "<div class=\"my-gallery\" itemscope itemtype=\"http://schema.org/ImageGallery\">\n";
        $reponse2 = $bdd->query("SELECT * FROM rest_cat WHERE id_rest = $id_rest");	    
	    while ($donnees2 = $reponse2->fetch()){
	           $id_image = $donnees2['id_image'];
	           //récupérattion des données images
	           $reponse3 = $bdd->query("SELECT * FROM image WHERE id = $id_image");	    
	           $donnees3 = $reponse3->fetch();
	           //echo $donnees3['nom'];
	           echo "\t<figure itemprop=\"associatedMedia\" itemscope itemtype=\"http://schema.org/ImageObject\">\n";
		       echo "\t\t<a href=\"/img/".$donnees3['nom']."\" itemprop=\"contentUrl\" data-size=\"".$donnees3['largeur']."x".$donnees3['hauteur']."\">\n";
		       echo "\t\t\t<img src=\"/img/m_".$donnees3['nom']."\" itemprop=\"thumbnail\" alt=\"".$donnees3['alt']."\" />\n";
		       echo "\t\t</a>\n\t\t<figcaption itemprop=\"caption description\">".$donnees3['cim']."<br/>".$donnees3['descr']."</figcaption>\n"; /**Description***/
		       echo "\t\t<p class=\"text-center\"><span class=\"lead\">".$donnees3['cim']."</span><br/>".$donnees3['descr']."</p>\n"; /**Description***/
		       echo "\t</figure>\n";
	           
	           $reponse3->closeCursor();
	    }
	    echo "</div><hr/>";
        $reponse2->closeCursor();	    
}
$reponse->closeCursor();



include("./pages/galleri_html.php");
?>
</div>