<?php
	session_start();
	include_once('../include/connex.inc.php');
	include_once('../include/user.inc.php');
	$idcom = connex("myparam");
	
	if (!empty($_SESSION['R_U_ID'])) {
		$R_U_ID = $_SESSION['R_U_ID'];
		$query = "SELECT * FROM Utilisateur WHERE U_ID = '$R_U_ID'";
		$result = mysqli_query($idcom, $query);
		$result = mysqli_fetch_array($result, MYSQLI_BOTH);
	} else {
		
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
		<br>Profil
	</h1>
	<!--accéder au profil en rechargeant la page-->
	<p><a href="">mon profil</a></p>
    <form method="post" action="recherche_user.php">
        <label>Recherche :
            <input type="search" name="pseudo">
        </label>
		<button type="submit">OK</button>
    </form>

<?php
	if (isset($result)) {
		if (connected($R_U_ID))
			echo "<h2>Votre profil <i>".$result['pseudo']." :</i></h2>";
		else
			echo "<h2>Profil de <i>".$result['pseudo']." :</i></h2>";
?>
	<h2></h2>
	<ul>
		<?php
		if (connected($R_U_ID)) {
			printf("<li>email : %s</li>", $result['email']);
			printf("<li>date de naissance : %s</li>", $result['date_naissance']);
		}
		printf("<li>prénom : %s</li>", $result['prenom']);
		printf("<li>nom : %s</li>", $result['nom']);
		?>
	</ul>
	<h2>Notes</h2>
	<ul>

	</ul>
	<h2>Annonces</h2>
	<ul>

	</ul>
<?php
	} else {

	}
?>
</body>
</html>
