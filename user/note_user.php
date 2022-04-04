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
			$query = "INSERT INTO evaluer VALUES ('$R_U_ID', '$U_ID', '$note', '$com')";
			$result = mysqli_query($idcom, $query);
		}
	}
	//$result = mysqli_fetch_array($result, MYSQLI_BOTH);
	//$query = "SELECT note, contenu_eval FROM evaluer WHERE U_ID_est_evalue = '$R_U_ID' AND U_ID_evalue = '$U_ID':";
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
	<?php
	if (!empty($R_U_ID)) {
		affAvisAll($idcom, $R_U_ID);
	}
	$e = 0;
	?>
</body>
</html>
