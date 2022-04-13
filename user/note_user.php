<?php
	session_start();
	include_once('../include/connex.inc.php');
	include_once('../include/user.inc.php');
	$idcom = connex("myparam");
	
	if (!empty($_SESSION['R_U_ID'])) {
		$R_U_ID = $_SESSION['R_U_ID'];
		if (!empty($_POST['note']) and !empty($_POST['com']) and !empty($_SESSION['U_ID'])) {
			$U_ID = $_SESSION['U_ID'];
			$note = $_POST['note'];
			$com = mysqli_real_escape_string($idcom, $_POST['com']);
			$query = "SELECT * FROM evaluer WHERE U_ID_est_evalue = '$R_U_ID' AND U_ID_evalue = '$U_ID'";
			$result = mysqli_query($idcom, $query);
			$result = mysqli_fetch_all($result, MYSQLI_BOTH);
			if (count($result) == 0) {
				$query = "INSERT INTO evaluer VALUES ('$R_U_ID', '$U_ID', '$note', '$com')";
			} else {
				$query = "UPDATE evaluer SET note = '$note', contenu_eval = '$com' WHERE U_ID_est_evalue = '$R_U_ID' AND U_ID_evalue = '$U_ID'";
			}
			$result = mysqli_query($idcom, $query);
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="note_user.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Note Utilisateur</title>
</head>
<body>
	<?php
	include("../include/header.inc.php");
	include("../include/nav.inc.php"); ?>
	<main>
	<?php
	if (!empty($R_U_ID)) {
		affAvisAll($idcom, $R_U_ID);
	} ?>
	</main>
</body>
</html>
