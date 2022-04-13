<?php
	include_once('../include/connex.inc.php');
	include_once('../include/user.inc.php');
	session_start();
	$idcom = connex("myparam");

	// si on regarde son profil
	if (!empty($_POST['monProfil'])) {
		$_SESSION['R_U_ID'] = "";
		header("Location: ./user.php");
		die();
	}

	// si l'U_ID de l'utilisateur a été renseigné
	if (!empty($_POST['profil'])) {
		$_SESSION['R_U_ID'] = $_POST['profil'];
		header("Location: ./user.php");
		die();
	}

	//action si on veut contacter le locataire
	if (isset($_POST['contacter'])) {
		$_SESSION['R_U_ID'] = $_POST['contacter'];
		header("Location: ../messagerie/envoie.php");
		die();
	}

	// si on lance la recherche d'un utilisateur
	if (isset($_POST['R_pseudo'])) {
		// si un pseudo a été renseigné on le sauvegarde en session
		if (!empty($_POST['R_pseudo'])) { 
			$_SESSION['R_pseudo'] = mysqli_real_escape_string($idcom, $_POST['R_pseudo']);
			header("Location: ./recherche_user.php");
			die();
		// sinon on réinitialise le dernier pseudo sauvegardé
		} else {
			$_SESSION['R_pseudo'] = "";
		}
	}

	// on fait une requête dans la base de donnée en fonction de R_pseudo
	if (!empty($_SESSION['R_pseudo'])) {
		$pseudo = $_SESSION['R_pseudo'];
		$query = "SELECT * from Utilisateur WHERE pseudo LIKE  '%$pseudo%'";
	} else {
		$query = "SELECT * from Utilisateur WHERE 1";
	}
	$result = mysqli_query($idcom, $query);
	$result = mysqli_fetch_all($result, MYSQLI_BOTH);

	// recherche réussie, un seul utilisateur trouvé
	// U_ID sauvegardé en session
	if (count($result) == 1) {
		$_SESSION['R_U_ID'] = $result[0]['U_ID'];
		header("Location: ./user.php");
		die();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="recherche_user.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Recherche Utilisateur</title>
</head>
<body>
	<?php 
	include('../include/header.inc.php'); 
	include('../include/nav.inc.php'); ?>
	<main>
		<h2>Recherche Utilisateur</h2>
		<form method="post" action="recherche_user.php">
			<input type="search" name="R_pseudo" placeholder="Rechercher" accesskey="s">
			<button type="submit">OK</button>
			<button type="submit" name="monProfil" value="true">mon profil</button>
		</form>
	<?php
		if (isset($result)) {
			if (count($result) > 1) {
				echo '<form method="post"><ul>';
				foreach ($result as $row) {
					echo '<li>';
					affUser($idcom, $row["U_ID"]);
					echo '<button name="profil" value="'.$row["U_ID"].'">';
					echo 'profil';
					echo '</button>';
					echo '</li>';
				}
				echo "</ul></form>";
			} else {
				$R_U_ID = false;
				echo "<p>Aucun résultat</p>";
			}
		} else {
			echo "<p>Faites une recherche d'utilisateur</p>";
		}
	?>
	</main>
</body>
</html>
