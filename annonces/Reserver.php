<?php
	include_once "../include/connex.inc.php";
	include_once "../include/annonce.inc.php";
	include_once "../include/user.inc.php";
	session_start();

	//vérifie si une annonce a été choisi
	if (empty($_SESSION['A_ID'])) {
		header("Location: annonce.php");
		die();
	}
	$A_ID = $_SESSION['A_ID'];

	//vérifie si l'utilisateur est connecté
	if (!estConnecte()) {
		seConnecter();
	}
	$U_ID = $_SESSION['U_ID'];

	//on regarde si l'utilisateur est le locataire
	$idcom = connex("myparam");
	$query = "SELECT U_ID FROM annonce WHERE A_ID = '$A_ID'";
	$r_annonce = mysqli_query($idcom, $query);
	$r_annonce = mysqli_fetch_array($r_annonce);

	//on récupère les informations de réservation entre l'annonce et l'utilisateur
	if ($U_ID != $r_annonce['U_ID']) {
		//on récupère le status de la demande d'un utilisateur
		$query = "SELECT * FROM reserve WHERE A_ID = '$A_ID' AND U_ID = '$U_ID'";
		$r_reserve = mysqli_fetch_array(mysqli_query($idcom, $query));
	}
	/*
	echo '<br>U_ID ' . $U_ID;
	echo '<br>A_ID ' . $A_ID;
	echo '<br>';
	echo 'r_annonce : '; print_r($r_annonce); echo '<br>';
	echo 'r_reserve : '; print_r($r_reserve); echo '<br>'; */

	//action si on veut reserver l'annonce
	if (isset($_POST['reserver'])) {
		if (empty($r_reserve)) {
			mysqli_query($idcom, "INSERT INTO reserve VALUES($U_ID, $A_ID, 'En cours')");
			header("Location: reserver.php");
			die();
		}
	}

	//action si on veut retirer sa réservation
	if (isset($_POST['retirer'])) {
		if (count($r_reserve) != 0) {
			$query = "DELETE FROM reserve WHERE A_ID = '$A_ID' AND U_ID = '$U_ID'";
			mysqli_query($idcom, $query);
			header("Location: reserver.php");
			die();
		}
	}

	//action si on veut contacter le locataire
	if (isset($_POST['contacter'])) {
		$_SESSION['R_U_ID'] = $_POST['contacter'];
		header("Location: ../messagerie/envoie.php");
		die();
	}

	//action si on veut visiter le profil du bailleur
	if (isset($_POST['profil'])) {
		$profil = $_POST['profil'];
		$_SESSION['R_U_ID'] = $profil;
		header("Location: ../user/user.php");
		die();
	}

	//action si le propriétaire ferme l'annonce
	if (isset($_POST['fermer'])) {
		$query = "UPDATE annonce SET statut = 0 WHERE A_ID = $A_ID";
		mysqli_query($idcom, $query);
		header("Location: reserver.php");
		die();
	}
	
	//action si le propriétaire ouvre l'annonce
	if (isset($_POST['ouvrir'])) {
		$query = "UPDATE annonce SET statut = 1 WHERE A_ID = $A_ID";
		mysqli_query($idcom, $query);
		header("Location: reserver.php");
		die();
	}

	//action si le propriétaire accepte une réservation
	if (isset($_POST['accepter'])) {
		$accepter = $_POST['accepter'];
		$query = "UPDATE reserve SET statut_res = 'Accepte' WHERE
			U_ID = '$accepter' AND A_ID = '$A_ID'";
		mysqli_query($idcom, $query);
		header("Location: reserver.php");
		die();
	}

	//action si le propriétaire refuse une annonce
	if (isset($_POST['refuser'])) {
		$refuser = $_POST['refuser'];
		$query = "UPDATE reserve SET statut_res = 'Refuse' WHERE
			U_ID = '$refuser' AND A_ID = '$A_ID'";
		mysqli_query($idcom, $query);
		header("Location: reserver.php");
		die();
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
	<?php
	include("../include/header.inc.php");
	include("../include/nav.inc.php"); ?>
	<h2>Demande de Réservation :</h2>
		<p><a href=./annonce.php>voir toutes les annonces</a>
	<h2>Annonce</h2>
		<?php afficherannonceimage($idcom, $A_ID); ?>
	<h2>Bailleur</h2>
		<?php affUser($idcom, $r_annonce['U_ID']); ?>
	<hr>
	<form method="POST" action="./reserver.php">
	<?php
	//intéractions pour faire des réservations
	if ($U_ID != $r_annonce['U_ID']) { ?>
		<h3>Réserver :</h3> 
		<?php
		//s'il n'y a pas de réservation
		if (empty($r_reserve)) { ?>
			<input type='submit' value='Reserver' name='reserver'>
		<?php
		//sinon on affiche le status de la réservation.
		} else { 
			if (EN_COURS == $r_reserve['statut_res']) { ?>
				<p>Réservation en attente du locataire.</p>
				<input type='submit' value='Se retirer' name='retirer'>
			<?php
			} else if (ACCEPTE == $r_reserve['statut_res']) { ?>
				<p>Réservation acceptée.</p>
			<?php
			} else if (REFUSE == $r_reserve['statut_res']) { ?>
				<p>Réservation refusée.</p>
			<?php
			}
		} 
		?>
		<button type='submit' value='<?php echo $r_annonce['U_ID']; ?>'
			name='contacter'>Contacter</button>
		<button type='submit' value='<?php echo $r_annonce['U_ID']; ?>'
			name='profil'>Profil</button>

	<?php
	//intéractions pour le propriétaire
	} else { ?>
		<h3>Réservation(s) :</h3>
		<button type='submit' name='fermer'>Fermer l'annonce</button>
		<button type='submit' name='ouvrir'>Ouvrir l'annonce</button>
		<h4>En cours</h4>
		<?php affAllReservation($idcom, $A_ID, EN_COURS); ?>
		<h4>Acceptée</h4>
		<?php affAllReservation($idcom, $A_ID, ACCEPTE); ?>
		<h4>Refusée</h4>
		<?php affAllReservation($idcom, $A_ID, REFUSE);
	}
	?>
	</form>
</body>
</html>
