<?php
	include_once "../include/connex.inc.php";
	include_once "../include/annonce.inc.php";
	session_start();

	//vérifie si une annonce a été choisi
	if (empty($_SESSION['A_ID'])) {
		header("Location: annonce.php");
	}
	$A_ID = $_SESSION['A_ID'];

	//vérifie si l'utilisateur est connecté
	if (!estConnecte()) {
		seConnecter();
	}
	$U_ID = $_SESSION['U_ID'];

	//on récupère les informations sur entre l'annonce et l'utilisateur
	$idcom = connex("myparam");
	$result = mysqli_query($idcom, "SELECT * FROM reserve WHERE A_ID = '$A_ID' AND U_ID = '$U_ID'");
	$result = mysqli_fetch_all($result, MYSQLI_BOTH);

	//action si on veut reserve l'annonce
	if (isset($_POST['reserver'])) {
		if (count($result) == 0) {
			mysqli_query($idcom, "INSERT INTO reserve VALUES($U_ID, $A_ID, 'En cours')");
			header("Location: reserver.php");
		}
	}

	//action si on veut retirer sa réservation
	if (isset($_POST['retirer'])) {
		if (count($result) != 0) {
			$query = "DELETE FROM reserve WHERE A_ID = '$A_ID' AND U_ID = '$U_ID'";
			mysqli_query($idcom, $query);
			header("Location: reserver.php");
		}
	}

	//action si on veut contacter le locataire
	if (isset($_POST['contacter'])) {
		$contacte = mysqli_query($idcom, "SELECT U_ID FROM annonce WHERE A_ID = $A_ID");
		$contacte = $contacte->fetch_array();
		$_SESSION['R_U_ID'] = $contacte['U_ID'];
		header("Location: ../messagerie/envoie.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="reserver.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reserver</title>
</head>
<body>
	<h1 style="text-align:center;">
	<a href=../index.php>Share My House</a>
	</h1>
	<h2>Reserver</h2>
<?php
	afficherannonce($idcom, $A_ID);
?>
	<p>
	<form method="POST" action="./reserver.php">
	<?php
	if (count($result) == 0) {
	?>
		<input type='submit' value='Reserver' name='reserver'>
	<?php
	} else if ($result['status_res'] = 'En cours') {
	?>
		<p>Réservation en attente du locataire</p>
		<input type='submit' value='Se retirer' name='retirer'>
	<?php
	}
	?>
		<input type='submit' value='Contacter' name='contacter'>
	</form>
	</p>
</body>
</html>
