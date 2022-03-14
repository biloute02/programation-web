<?php
	session_start();
	include('include/connex.inc.php');
	$base = 'house';
	$param = 'myparam';
	$idcom = connex($base,$param);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="user.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profil</title>
</head>
<body>
	<h1 style="text-align:center;">
	<a href=index.php>Share My House</a>
	<br>Profil	
	</h1>
</body>
</html>
