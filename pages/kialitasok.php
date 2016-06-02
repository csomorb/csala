<div class="container">
    <script src="./script/map.js"></script>
    <h2 class="text-center">Kàlitàsok</h2>    
    <?php
include('connect.php');
$reponse = $bdd->query('SELECT * FROM kialitas ORDER BY date_deb DESC');
while ($donnees = $reponse->fetch()){
		// on trouve l'image correspondant à l'id
		$id = $donnees['photo'];
		$reponse2 = $bdd->query("SELECT * FROM image WHERE id = $id ");
		$donnees2 = $reponse2->fetch();
		echo "<h3>".$donnees['cim']."</h3>\n";
		echo "<img src=\"./img/".$donnees2['nom']."\" class=\"img-responsive margin_bottom_20\" alt=\"kiàlitàs\">";
		echo "<div class=\"row\"><div class=\"col-sm-6\">Elso nap: ".$donnees['date_deb']." utolso nap: ".$donnees['date_fin']."<p>".$donnees['descr']."</p></div><div class=\"col-sm-6\">";
		echo "<div id=\"googleMap".$donnees['id']."\" style=\"width:100%;height:380px;\"></div>";
		//génération google map
		?>
		<script>
        function initialize() {
          var myCenter=new google.maps.LatLng(<?php echo $donnees['cord'];?>);
          
          var mapProp = {
            center:myCenter,
            zoom:12,
            mapTypeId:google.maps.MapTypeId.ROADMAP
          };
          var map=new google.maps.Map(document.getElementById("googleMap<?php echo $donnees['id']?>"),mapProp);
          
          var marker=new google.maps.Marker({
            position:myCenter,
            });

            marker.setMap(map);
          
          
        }
        google.maps.event.addDomListener(window, 'load', initialize);
        </script>
		
<?php		
		
		echo "</div></div><hr/>\n";
	
}
?>
    
    
    
    
</div>