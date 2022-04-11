<?php
	include_once "../include/connex.inc.php";
	include_once "../include/annonce.inc.php";
	include_once "../include/user.inc.php";
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

	//on regarde si l'utilisateur est le locataire
	$idcom = connex("myparam");
	$query = "SELECT U_ID FROM annonce WHERE A_ID = '$A_ID'";
	$r_annonce = mysqli_query($idcom, $query);
	$r_annonce = mysqli_fetch_array($r_annonce);

	//on récupère les informations de réservation entre l'annonce et l'utilisateur
	//les données sont différentes si l'utilisateur est locataire ou non
	if ($U_ID == $r_annonce['U_ID']) {
		//on récupère toutes les demandes de réservation sur l'annonce
		$query = "SELECT r.U_ID, A_ID, pseudo, statut_res FROM reserve r, utilisateur u 
			WHERE r.U_ID = u.U_ID AND r.A_ID = '$A_ID'";
		$r_reserve = mysqli_fetch_all(mysqli_query($idcom, $query), MYSQLI_BOTH);
	} else {
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
		if (empty($r_reserve_row)) {
			mysqli_query($idcom, "INSERT INTO reserve VALUES($U_ID, $A_ID, 'En cours')");
			header("Location: reserver.php");
		}
	}

	//action si on veut retirer sa réservation
	if (isset($_POST['retirer'])) {
		if (count($r_reserve) != 0) {
			$query = "DELETE FROM reserve WHERE A_ID = '$A_ID' AND U_ID = '$U_ID'";
			mysqli_query($idcom, $query);
			header("Location: reserver.php");
		}
	}

	//action si on veut contacter le locataire
	if (isset($_POST['contacter'])) {
		$contacter = $_POST['contacter'];
		$_SESSION['R_U_ID'];
		header("Location: ../messagerie/envoie.php");
	}

	//action si on veut visiter le profil du bailleur
	if (isset($_POST['profil'])) {
		$profil = $_POST['profil'];
		$_SESSION['R_U_ID'] = $profil;
		header("Location: ../user/user.php");
	}

	//action si le propriétaire ferme l'annonce
	if (isset($_POST['fermer'])) {
		$query = "UPDATE annonce SET statut = 0 WHERE A_ID = $A_ID";
		mysqli_query($idcom, $query);
		header("Location: reserver.php");
	}
	

	//action si le propriétaire accepte une réservation
	if (isset($_POST['accepter'])) {
		$accepter = $_POST['accepter'];
		$query = "UPDATE reserve SET statut_res = 'Accepte' WHERE
			U_ID = '$accepter' AND A_ID = '$A_ID'";
		mysqli_query($idcom, $query);
		header("Location: reserver.php");
	}

	//action si le propriétaire refuse une annonce
	if (isset($_POST['refuser'])) {
		$refuser = $_POST['refuser'];
		$query = "UPDATE reserve SET statut_res = 'Refuse' WHERE
			U_ID = '$refuser' AND A_ID = '$A_ID'";
		mysqli_query($idcom, $query);
		header("Location: reserver.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./reserver.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reserver</title>
</head>
<body>
	<h1 style="text-align:center;">
		<a href=../index.php>Share My House</a>
	</h1>
	<h2>Demande de Réservation :</h2>
		<p><a href=./annonce.php>voir toutes les annonces</a>
	<h2>Annonce</h2>
		<?php afficherannonceimage($idcom, $A_ID); ?>
	<h2>Bailleur</h2>
		<?php affUser($idcom, $A_ID); ?>
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
		} else { 
			if ('En cours' == $r_reserve['statut_res']) { ?>
				<p>Réservation en attente du locataire.</p>
				<input type='submit' value='Se retirer' name='retirer'>
			<?php
			} else if ('Accepte' == $r_reserve['statut_res']) { ?>
				<p>Réservation acceptée.</p>
			<?php
			} else if ('Refuse' == $r_reserve['statut_res']) { ?>
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
	} else {
		//
		function reservation ($r_reserve, $statut_res = null) {
			echo "<ul>";
			foreach ($r_reserve as $row) {
				if ($statut_res != null and $statut_res != $row['statut_res'])
					continue;
				printf("<li><label>%s :", $row['pseudo']);
				printf("<button type='submit' value='%s' name='accepter'>
					Accepter</button>", $row['U_ID']);
				printf("<button type='submit' value='%s' name='refuser'>
					Refuser</button>", $row['U_ID']);
				printf("<button type='submit' value='%s' name='contacter'>
					Contacter</button>", $row['U_ID']);
				printf("<button type='submit' value='%s' name='profil'>
					Profil</button>", $row['U_ID']);
				printf("</label></li>");
			}
			echo "</ul>";
		} ?>
		<h3>Réservation(s) :</h3>
		<button type='submit' name='fermer'>Fermer l'annonce</button>
		<h4>En cours</h4>
		<?php reservation($r_reserve, "En cours"); ?>
		<h4>Accepté</h4>
		<?php reservation($r_reserve, "Accepte"); ?>
		<h4>Refusé</h4>
		<?php reservation($r_reserve, "Refuse");
	}
	?>
	</form>
</body>
</html>
