<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Szerkeztes</title>
    <script src="../script/jquery-2.2.1.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="../script/bootstrap.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<!-- font Raleay-->
	<link href='https://fonts.googleapis.com/css?family=Raleway:400,600&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<!-- css -->
	<link rel="stylesheet" href="../css/szerkesztes.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- ******************* FILE UPLOAD -->
	<link href="../css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
	<!-- canvas-to-blob.min.js is only needed if you wish to resize images before upload.
		 This must be loaded before fileinput.min.js -->
	<script src="../script/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
	<script src="../script/fileinput.min.js" type="text/javascript"></script>
	<!-- ******************* FILE UPLOAD -->
	<!-- Date Picker -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
</head>
<body>
<?php
include('../pages/connect.php');
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div class="container">