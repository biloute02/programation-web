<?php
	session_start();
	include_once('../include/connex.inc.php');
	$idcom = connex("myparam");
	
	if (!empty($_SESSION['R_U_ID'])) {
		$R_U_ID = $_SESSION['R_U_ID'];
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
    <form method="post" action="recherche_user.php">
        <label>Recherche :
            <input type="search" name="pseudo">
        </label>
		<button type="submit">OK</button>
    </form>
<?php
	/*
	// si U_ID n'existe pas, on essaye de le déterminer
	if (empty($_POST['U_ID'])) {
		// si le pseudo est renseigné dans la barre de recherche, on récupère son $U_ID
	} else {
		$U_ID = $_POST['U_ID'];
	}
	 */
?>

<?php
	// si R_U_ID existe, on affiche la page d'utilisateur
	if (!empty($R_U_ID)) {
		$query = "SELECT * FROM Utilisateur WHERE U_ID = '$R_U_ID'";
		$result = mysqli_query($idcom, $query);
		$result = mysqli_fetch_array($result, MYSQLI_BOTH);
		// cas où on regarde son profil
		if (!empty($_SESSION['U_ID']) && $_SESSION['U_ID'] == $R_U_ID) {
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
	}
?>
</body>
</html>
