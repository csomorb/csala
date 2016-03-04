<?php
/*
Codes catégories : 
	1: portre
	2: tajkep
	3: csendélet
	4: onarckép
	5: verskép
	6: egyéb
*/
function generer_galleri($code_categorie){
	$galleri = "<div class=\"my-gallery\" itemscope itemtype=\"http://schema.org/ImageGallery\">\n";
	include('connect.php');
	$reponse = $bdd->query("SELECT * FROM image WHERE cat = $code_categorie");
	while ($donnees = $reponse->fetch()){
		$galleri.= "\t<figure itemprop=\"associatedMedia\" itemscope itemtype=\"http://schema.org/ImageObject\">\n";
		$galleri.= "\t\t<a href=\"/img/".$donnees['nom']."\" itemprop=\"contentUrl\" data-size=\"".$donnees['largeur']."x".$donnees['hauteur']."\">\n";
		$galleri.= "\t\t\t<img src=\"/img/m_".$donnees['nom']."\" itemprop=\"thumbnail\" alt=\"".$donnees['alt']."\" />\n";
		$galleri.= "\t\t</a>\n\t\t<figcaption itemprop=\"caption description\">".$donnees['cim']."</figcaption>\n"; /**Description***/
		$galleri.= "\t\t<p class=\"text-center\"><span class=\"lead\">".$donnees['cim']."</span><br/></p>\n"; /**Description***/
		$galleri.= "\t</figure>\n";
	}
	$galleri.= "</div>";
	return $galleri;
}
?>