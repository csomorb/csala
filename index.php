<?php
	$querystring = htmlspecialchars($_SERVER['QUERY_STRING']);
    if (empty($querystring)) {
        $params = "art";
    }
    else {
        $params = $querystring;
    }
    $folder = explode("/", $params)[0];
    $page = "pages/" . $params . ".php";
	include('pages/global.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Csala Ildiko</title>
    <script src="./script/jquery-2.2.1.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="./script/bootstrap.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<!-- font Raleay-->
	<link href='https://fonts.googleapis.com/css?family=Raleway:400,600&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<!-- css -->
	<link rel="stylesheet" href="./css/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- css Galery **************************************************************-->
	<!-- Core CSS file -->
	<link rel="stylesheet" href="./css/photoswipe.css"> 
	<!-- Skin CSS file (styling of UI - buttons, caption, etc.)
		 In the folder of skin CSS file there are also:
		 - .png and .svg icons sprite, 
		 - preloader.gif (for browsers that do not support CSS animations) -->
	<link rel="stylesheet" href="./css/default-skin/default-skin.css"> 
	<!-- Core JS file -->
	<script src="./script/photoswipe.min.js"></script> 
	<!-- UI JS file -->
	<script src="./script/photoswipe-ui-default.min.js"></script>
	<script src="./script/galleri.js"></script>
	<link rel="stylesheet" href="./css/gallery.css">
	<!-- fin Galery **************************************************************-->	
	
</head>
<body  oncontextmenu="return false">


<nav class="navbar">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		<img src="./img/menu.png" width="32px" height="32px;">
      </button>
      <a class="navbar-brand" href="art">Csala Ildikó</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="dropdown  <?php if ($folder == "festmenyek" || $folder == "csendelet" || $folder == "onarckep" || $folder == "portre" || $folder == "verskep" || $folder == "tajkep" || $folder == "egyeb" || $folder == "restauralasok") echo "active";  ?>">
          <a class="dropdown-toggle" data-toggle="dropdown" href="munkaim">Munkáim<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="festmenyek">Festmények</a></li>
            <li><a href="portre">&nbsp;&nbsp;Portrék</a></li>
			<li><a href="csendelet">&nbsp;&nbsp;Csendéletek</a></li>
			<li><a href="tajkep">&nbsp;&nbsp;Tájképek</a></li>
			<li><a href="aktok">&nbsp;&nbsp;Aktok</a></li>
			<li><a href="verskep">&nbsp;&nbsp;Versképek</a></li>
			<li><a href="onarckep">&nbsp;&nbsp;Önarcképek</a></li>
            <li><a href="onarckep">&nbsp;&nbsp;Másolatok</a></li>
			<li><a href="egyeb">&nbsp;&nbsp;Egyebek</a></li>
            <li><a href="restauralasok">Restaurálások</a></li>
          </ul>
        </li>
        <li <?php if ($folder != "vendegkonyv")  { echo "class='sliding-middle-out'"; } ?> ><a  href="vendegkonyv" <?php if ($folder == "vendegkonyv") { echo "class='active'"; } ?> >Vendégkönyv</a></li>
		<li <?php if ($folder != "media")  { echo "class='sliding-middle-out'"; } ?> ><a href="media" <?php if ($folder == "media") { echo "class='active'"; } ?> >Média</a></li>
        <li <?php if ($folder != "kialitasok")  { echo "class='sliding-middle-out'"; } ?> ><a href="kialitasok" <?php if ($folder == "kialitasok") { echo "class='active'"; } ?> >Kiàlitások</a></li>
		<li <?php if ($folder != "kapcsolat")  { echo "class='sliding-middle-out'"; } ?> ><a href="kapcsolat" <?php if ($folder == "kapcsolat") { echo "class='active'"; } ?> >Kapcsolat</a></li>
      </ul>
    </div>
  </div>
 
</nav>

<?php
	if (file_exists($page)) {
		require_once($page);
	}
    else {
        require_once("404.php");
    }
?>
</body>
</html>