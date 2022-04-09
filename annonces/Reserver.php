<?php
include_once "../include/annonce.inc.php";
	session_start();

	if (empty($_SESSION['ida'])) {
		$_SESSION['ida'] = $_GET['id'];
	}
	$ida = $_SESSION['ida'];
	$idutilisateur = $_SESSION['U_ID'];

	$connect = mysqli_connect(MYHOST, MYUSER, MYPASS, MYBASE) or die("Erreur de connexion à la base de données");
	$query = mysqli_query($connect, "SELECT * FROM reserve WHERE A_ID = '$ida' AND U_ID = '$idutilisateur'");

	afficherannonce($ida);

	if (isset($_POST['reserve'])) {
		if (mysqli_num_rows($query) != 1) {
			$reserve = mysqli_query($connect, "INSERT INTO reserve VALUES($idutilisateur, $ida, 'En cours')");
			die("<br>Vous avez envoyé une demande de reservation.");
		}
		else echo "<br>En attente";
	}
	if (isset($_POST['contacter'])) {
		$contacte = mysqli_query($connect, "SELECT U_ID FROM annonce WHERE A_ID = $ida");
		$contacte = $contacte->fetch_array();
		$_SESSION['R_U_ID'] = $contacte['U_ID'];
		header("Location:../messagerie/envoie.php");
	}
?>
<link rel="stylesheet" type="text/css" href="reserver.css">
<form method="POST" action="./reserver.php">
	<input type='submit' value='Reserver' name='reserve'>
	<input type='submit' value='Contacter' name='contacter'>
</form>