<?php
	session_start();
	include_once('../include/connex.inc.php');
	//include_once('../include/user.inc.php');
	$idcom = connex("myparam");
	
	if (!empty($_SESSION['R_U_ID'])) {
		$R_U_ID = $_SESSION['R_U_ID'];
		$query = "SELECT * FROM Utilisateur WHERE U_ID = '$R_U_ID'";
		$result = mysqli_query($idcom, $query);
		$result = mysqli_fetch_array($result, MYSQLI_BOTH);
	} else {
		
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="user.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Note Utilisateur</title>
</head>
<body>
