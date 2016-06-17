<div class="container">
	<hr class="trait_menu"/>
<?php
include('connect.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isRecaptchaValid(test_input($_POST['g-recaptcha-response']))) {
		$nom = test_input($_POST['nom']);
		$contenu = nl2br(test_input($_POST['contenu']));
		$date=date('Y-m-d');
		$req = $bdd->prepare('INSERT INTO livre(nom, contenu, date) VALUES( :nom, :contenu, :date)');
		$req->execute(array(
		'nom' => $nom,
		'contenu' => $contenu,
		'date' => $date
		));	
	}	
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function isRecaptchaValid($code, $ip = null)
{
	if (empty($code)) {
		return false; // Si aucun code n'est entré, on ne cherche pas plus loin
	}
	$params = [
		'secret'    => '6Le7BxoTAAAAAOVulGl_Al6ivYaeRQMuBQxAK5AU',
		'response'  => $code
	];
	if( $ip ){
		$params['remoteip'] = $ip;
	}
	$url = "https://www.google.com/recaptcha/api/siteverify?" . http_build_query($params);
	if (function_exists('curl_version')) {
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_TIMEOUT, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Evite les problèmes, si le ser
		$response = curl_exec($curl);
	} else {
		// Si curl n'est pas dispo, un bon vieux file_get_contents
		$response = file_get_contents($url);
	}
	if (empty($response) || is_null($response)) {
		return false;
	}
	$json = json_decode($response);
	return $json->success;
}

?>
<h1 class="text-center">Vendégkönyv</h1>
<script src="https://www.google.com/recaptcha/api.js?hl=hu" async defer></script>
<a href="#" id="new_post"  class="no_decoration"><h3>Új bejegyzés</h3></a>
<div id="nv_post">
<form role="form" action="vendegkonyv" method="post" accept-charset="UTF-8">
  <div class="form-group">
    <label for="nom">Név:</label>
    <input id="nom" type="text" class="form-control" required name="nom">
  </div>
  <div class="form-group">
    <label for="cim">Tartalom:</label>
     <textarea class="form-control" rows="5" id="cim" name="contenu"></textarea>
  </div>
  <div class="g-recaptcha" data-sitekey="6Le7BxoTAAAAAIWC3WoQMB5CFsHrXRPozy2DSQ32"></div><br/>
  <button type="submit" class="btn btn-default" name="add" value="had">Bejegyzés hozzàadàsa</button>
</form>

<br/>
</div>
<?php
$reponse = $bdd->query("SELECT * FROM livre ORDER BY id DESC");
while ($donnees = $reponse->fetch()){
		echo "<hr/><p><span class=\"lead\">".$donnees['nom']."</span><br/>".$donnees['contenu']."<br/></p><p class=\"text-right\">".$donnees['date']."</p><br/>";
}
$reponse->closeCursor();
?>

</div>
<script>
$(document).ready(function(){
	$("#new_post").click(function(e){
		e.preventDefault();
		$("#nv_post").slideToggle();
    });
	$("#nv_post").hide();
});
</script>	