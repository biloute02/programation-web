<?php
	session_start();
	include_once('../include/connex.inc.php');
	$idcom = connex("myparam");

	// si l'utilisateur a été séléctionné
	if (!empty($_POST['R_U_ID'])) {
		$_SESSION['R_U_ID'] = $_POST['R_U_ID'];
		header("Location: ./user.php");
	}
	
	// si le pseudo a été renseigné
	if (!empty($_POST['pseudo'])) {
		$pseudo = mysqli_real_escape_string($idcom, $_POST['pseudo']);

		$query = "SELECT * from Utilisateur WHERE pseudo = '$pseudo'";
		$result = mysqli_query($idcom, $query);
		$result = mysqli_fetch_all($result, MYSQLI_BOTH);

		// recherche réussie, valeur sauvegardée en session
		if (count($result) == 1) {
			$_SESSION['R_U_ID'] = $result[0]['U_ID'];
			header("Location: ./user.php");
		// le else continue en dessous !
		}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="recherche_profil.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Recherche Profil</title>
</head>
<body>
	<h1 style="text-align:center;">
	<a href=../index.php>Share My House</a>
	</h1>
	<h2>Recherhe Utilisateur</h2>
	<!--accéder au profil en rechargeant la page-->
	<p><a href="">mon profil</a></p>
    <form method="post" action="recherche_user.php">
        <label>Recherche :
            <input type="search" name="pseudo">
        </label>
		<button type="submit">OK</button>
    </form>
<?php
		if (count($result) > 1) {
			echo "<p>Plusieurs résultats possibles pour <b>".$pseudo."</b></p>";
			echo '<form method="post"><ul>';
			foreach ($result as $row) {
				echo '<li><button name="R_U_ID" value="'.$row["U_ID"].'" type="submit">';
				printf("%s %s", ucfirst($row['nom']), ucfirst($row['prenom']));
				echo '</button></li>';
			}
			echo "</form>";
		} else {
			$R_U_ID = false;
			echo "<p>Aucun résultat</p>";
		}
	} else {
		echo "<p>Faites une recherche d'utilisateur</p>";
	}
?>
</body>
</html>
