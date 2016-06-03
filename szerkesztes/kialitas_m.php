<?php
include("head.php");
var_dump($_FILES);
include("../pages/connect.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (! empty($_POST)){
		$cim = test_input($_POST["cim"]);
		$id2 = test_input($_POST["id"]);
		$descr = nl2br(test_input($_POST["desc"]));
		$cord =  test_input($_POST["cord"]);
		$req = $bdd->prepare('UPDATE kialitas SET cim = :cim, descr = :descr, cord = :cord WHERE id = :id');
		$req->execute(array(
			'cim' => $cim,
			'descr' => $descr,
			'cord' => $cord,
			'id' => $id2
		));
		// on regarde si on a une nouvelle photo
		if (isset($_FILES['photo'])){
		    if($_FILES['photo']['error'] == 0 ){
		        // on suprime l'ancienne photo
		        /*On récupère le nom de l'image*/
		        $req = $bdd->prepare('SELECT * FROM kialitas WHERE id = :id');
    			$req->execute(array(
    			'id' => $id2
    			));
    			$data = $req->fetch();
		        $id_image = $data['photo'];
		        
    			$req = $bdd->prepare('SELECT * FROM image WHERE id = :id');
    			$req->execute(array(
    			'id' => $id_image
    			));
    			$data = $req->fetch();
    			/*Suppression des fichiers sur le disque*/
    			unlink('../img/'.$data['nom']);
    			unlink('../img/m_'.$data['nom']);
    			$req = $bdd->prepare('DELETE FROM image WHERE id = :id');
    			$req->execute(array(
    			'id' => $id_image
    			));	
		        //on upload le nouveau
		        include("upload_photo.php");
		        $req = $bdd->prepare('UPDATE kialitas SET photo = :photo WHERE id = :id');
        		$req->execute(array(
        			'photo' => $id,
        			'id' => $id2
        		));
		        
		    } 
		}
		echo "<br/><div class=\"alert alert-success\"><strong>Sikerült!</strong> Sikeres volt a modositàs.</div><a type=\"button\" class=\"btn btn-info\" href=\"index.php\">Vissza a főmenühöz</a>";
	}
}
?>
  <h1>Kiállítások - kiállítás modositàsa</h1>
<?php
$reponse = $bdd->query("SELECT * FROM kialitas ORDER BY date_fin DESC");
while ($donnees = $reponse->fetch()){
?>	
	
	<div class="row">
		<div class="col-sm-3">
			<img src="../img/m_<?php $id_image = $donnees['photo'];
			$reponse2 = $bdd->query("SELECT * FROM image WHERE id = $id_image");
            $donnees2 = $reponse2->fetch();
			echo $donnees2['nom'];
			?>" class="img-responsive"/>
		</div>
		<div class="col-sm-9">
			
				<p class="de">Cim : <?php echo $donnees['cim']?><br/>Kiàlitàs leiràs: <?php echo $donnees['descr']?><br/>
				    Helyszin:  <?php echo $donnees['cord']?>
				
				</p>
				<button class="btn btn-default modif">Modositàs</button>
			<form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
				<div class="form-group">
					<label for="cim">Cim:</label>
					<input type="text" class="form-control" id="cim" required name="cim" value="<?php echo $donnees['cim']?>">
				</div>
				<div class="form-group">
					 <label for="comment">Kiàlitàs leíràs:</label>
					  <textarea class="form-control" rows="5" id="comment" name="desc"><?php echo $donnees['descr']?></textarea>
				</div>
					<div class="form-group">
					<label for="cord">Hely:</label>
					<input type="text" class="form-control" id="cord" required name="cord" value="<?php echo $donnees['cord']?>">
				</div>
				<input type="hidden" name="cat" value="8">
                <input type="hidden" name="alt" value="kialitas">
				<div class="form-group">
                    <label for="input-id">Kép modositàsa:</label>
                    <input id="input-id" type="file" class="file" accept="image/*" data-preview-file-type="text" name="photo">
                  </div>
				<button type="submit" class="btn btn-default" name="id" value="<?php echo $donnees['id']?>">Modositàsok Mentése</button>
			</form>
				
		</div>
	</div>
	<hr/>
<?php		
}
$reponse->closeCursor();
?>
<script>
$(document).ready(function(){
	$(".modif").click(function(e){
		e.preventDefault();
		console.log("dssdsd");
		$(this).siblings(".de").hide();
		$(this).siblings("form").show();
		$(this).hide();
    });
	$("form").hide();
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