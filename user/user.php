<?php
	session_start();
	include_once('../include/connex.inc.php');
	$idcom = connex("myparam");
    if (!empty($_SESSION['U_ID'])) {
        $U_ID = $_SESSION['U_ID'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="user.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profil</title>
</head>
<body>
	<h1 style="text-align:center;">
	<a href=../index.php>Share My House</a>
	</h1>
	<h2>Profil</h2>
	<!--accéder au profil en rechargeant la page-->
	<p><a href="">mon profil</a></p>
    <form method="post">
        <label>Recherche :
            <input name="pseudo">
        </label>
		<button type="submit">OK</button>
    </form>
<?php
	// si le pseudo est renseigné, on récupère son $U_ID
    if (!empty($_POST['pseudo'])) {
		$pseudo = mysqli_real_escape_string($idcom, $_POST['pseudo']);
		$query = "SELECT U_ID from Utilisateur WHERE pseudo = '$pseudo'";
		$result = mysqli_query($idcom, $query);
		$result = mysqli_fetch_all($result, MYSQLI_BOTH);

		if (count($result) == 0) {
			$U_ID = false;
			echo "<p>Aucun résultat</p>";
		} else if (count($result) > 1) {
			echo "<p>Plusieurs résultats possibles</p>";
		} else {
			$U_ID = $result[0]['U_ID'];
			echo "<p>Un résultat trouvé</p>";
		}
	// si U_ID existe, on affiche la page d'utilisateur
	}
	if (!empty($U_ID)) {
		$U_ID = mysqli_real_escape_string($idcom, $U_ID);
		$query = "SELECT * FROM Utilisateur WHERE U_ID = '$U_ID'";
		$result = mysqli_query($idcom, $query);
		$result = mysqli_fetch_array($result, MYSQLI_BOTH);
		// cas où on regarde son profil
		if (!empty($_SESSION['U_ID']) && $_SESSION['U_ID'] == $U_ID) {
			echo "<p>Votre profil :</p>";
			echo "<ul>";
			printf("<li>email : %s<br>pseudo : %s</li>", $result['email'], $result['pseudo']);
			printf("<li>prénom : %s<br>nom : %s</li>", $result['prenom'], $result['nom']);
			printf("<li>date de naissance : %s</li>", $result['date_naissance']);
			echo "</ul>";
			echo "<p>Vos annonces</p>";
		// cas où on recherche un autre utilisateur
		} else {
			echo "<p>Profil de <b>".$result['pseudo']."</b></p>";
			echo "<ul>";
			printf("<li>email : %s<br>pseudo : %s</li>", $result['email'], $result['pseudo']);
			echo "</ul>";
			echo "<p>Ses annonces</p>";
		}
	// l'internaute n'est pas connecté ou n'a pas fait de recherche
	} else {
		if (empty($_SESSION['U_ID']))
			echo "<p>Vous n'êtes pas connecté<p>";
		echo "<p>Faites une recherche d'utilisateur</p>";
	}
?>
</body>
</html>
