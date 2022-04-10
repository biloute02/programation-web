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

	//on regarde si l'utilisateur est le locataire
	$idcom = connex("myparam");
	$query = "SELECT U_ID FROM annonce WHERE U_ID = '$U_ID' AND A_ID = '$A_ID'";
	$r_annonce = mysqli_query($idcom, $query);
	$r_annonce = mysqli_fetch_all($r_annonce, MYSQLI_BOTH);

	//on récupère les informations de réservation entre l'annonce et l'utilisateur
	//les données sont différentes si l'utilisateur est locataire ou non
	if (count($r_annonce) == 1) {
		$query = "SELECT * FROM reserve WHERE A_ID = '$A_ID'";
	} else {
		$query = "SELECT * FROM reserve WHERE A_ID = '$A_ID' AND U_ID = '$U_ID'";
	}
	$r_reserve = mysqli_query($idcom, $query);
	$r_reserve = mysqli_fetch_all($r_reserve, MYSQLI_BOTH);
	echo '<br>U_ID ' . $U_ID;
	echo '<br>A_ID ' . $A_ID;
	echo '<br>';
	echo 'r_annonce : '; print_r($r_annonce); echo '<br>';
	echo 'r_reserve : '; print_r($r_reserve); echo '<br>';

	//action si on veut reserver l'annonce
	if (isset($_POST['reserver'])) {
		if (count($r_reserve) == 0) {
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
		$contacte = mysqli_query($idcom, "SELECT U_ID FROM annonce WHERE A_ID = '$A_ID'");
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
	afficherannonceimage($idcom, $A_ID);
?>
	<p>
	<form method="POST" action="./reserver.php">
	<?php
	if (count($r_annonce) == 0) {
		if (count($r_reserve) == 0) { ?>
			<input type='submit' value='Reserver' name='reserver'>
		<?php
		} else {
			if ($r_reserve['status_res'] = 'En cours') { ?>
				<p>Réservation en attente du locataire.</p>
				<input type='submit' value='Se retirer' name='retirer'>
			<?php
			} else if ($r_reserve['status_res'] = 'Accepte') { ?>
				<p>Réservation acceptée.</p>
			<?php
			} else if ($r_reserve['status_res'] = 'Refuse') { ?>
				<p>Réservation refusée.</p>
			<?php
			}
		} 
		?>
		<input type='submit' value='Contacter' name='contacter'>
	<?php
	} else {
		/*
		echo "<ol>";
		foreach ($r_reserve as $row) {
			echo "
		}
		 */
	}
	?>
	</form>
	</p>
</body>
</html>
