  <?php
  function generer_update($cat){
	include("../pages/connect.php");
  $reponse = $bdd->query("SELECT * FROM image WHERE cat = $cat ORDER BY id DESC");
while ($donnees = $reponse->fetch()){
?>	
	
	<div class="row">
		<div class="col-sm-3">
			<img src="../img/m_<?php echo $donnees['nom']?>" class="img-responsive"/>
		</div>
		<div class="col-sm-9">
			
				<p class="de">Cim : <?php echo $donnees['cim']?><br/>Kép leiràs: <?php echo $donnees['descr']?> </p>
				<button class="btn btn-default modif">Modositàs</button>
			<form role="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" accept-charset="UTF-8">
				<div class="form-group">
					<label for="cim">Kép cim:</label>
					<input type="text" class="form-control" id="cim" required name="cim" value="<?php echo $donnees['cim']?>">
				</div>
				<div class="form-group">
					 <label for="comment">Kép leíràs (méret, dàtum,...):</label>
					  <textarea class="form-control" rows="5" id="comment" name="desc"><?php echo $donnees['descr']?></textarea>
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
<?php
  }
?>
