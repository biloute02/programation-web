<?php
	include_once "../include/connex.inc.php";
	session_start();

	if (!estConnecte())
		seConnecter();

	$idutilisateur = $_SESSION['U_ID'];

	if (empty($_SESSION['R_U_ID'])) {
		header("Location: ../user/recherche_user.php");
	}

	$connect = connex("myparam");

	$iddestinataire = $_SESSION['R_U_ID'];
	$query = "SELECT pseudo FROM utilisateur WHERE U_ID = '" . $_SESSION['R_U_ID'] . "'";
	$R_pseudo = mysqli_fetch_row(mysqli_query($connect, $query))[0];

	$query = "SELECT contenu_message,U_ID_envoie FROM communiquer WHERE (U_ID_recoit = '$iddestinataire' AND U_ID_envoie = '$idutilisateur') OR (U_ID_recoit = '$idutilisateur' AND U_ID_envoie = '$iddestinataire') ORDER BY date_envoi DESC LIMIT 20";
	$result = mysqli_query($connect, $query); // prend les 20 derniers messages mais les affiche de haut en bas
	
	if (isset($_POST['envoie'])) {
		$message = mysqli_real_escape_string($connect, $_POST['message']);
		if ($message) {
			$query1 = mysqli_query($connect, "INSERT INTO communiquer VALUES('$iddestinataire', '$idutilisateur', now(), '$message')");
			header("Location:envoie.php");		
		}
	}


 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="message.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Messagerie</title>
</head>
<body>
	<?php
	include("../include/header.inc.php");
	include("../include/nav.inc.php"); ?>
	<main>
	<h2>Messagerie</h2>
	<h3>Conversation avec
		<?php if (estConnecte() == $iddestinataire) {
			echo " soi-même :";
		} else {
			echo "<i>$R_pseudo</i> :"; 
		} ?></h3>
	<form method="POST">
		<?php
		if(mysqli_num_rows($result) >= 1) {
			for ($row_no = $result->num_rows -1; $row_no >= 0 ; $row_no--) {
				$result->data_seek($row_no);

				$row = $result->fetch_row();
				$row[1] = mysqli_query($connect, "SELECT pseudo FROM utilisateur WHERE U_ID = '$row[1]'");
				$row[1] = $row[1]->fetch_array(1);	
				echo"<p>"; 
				printf("<b>%s</b> : %s <br>", $row[1]['pseudo'], nl2br($row[0]));
				echo"</p>";

			}
		}

		if (isset($_POST['envoie'])) {
			if (!$message) echo "<br><b>Veuillez entrer un message</b><br>";
		} ?>

		<label>Nouveau message :</label>
		<br><br>
		<textarea class="msg" rows="8" cols = "80" name="message"></textarea>
		<br><br>
		<input type="submit" value="Envoyer" name="envoie">
	</form>
	</main>
</body>
