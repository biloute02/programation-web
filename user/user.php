<?php
	session_start();
	include('../include/connex.inc.php');
	$idcom = connex("myparam");
    if (!empty($_SESSION['U_ID'])) {
        $U_ID = $_SESSION['U_ID'];
		//on protÃ¨ge U_ID qui va Ãªtre utilisÃ© dans des requÃªtes
		$U_ID = mysqli_real_escape_string($idcom, $U_ID);
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
    <form method="post">
        <label>Recherche :
            <input name="pseudo">
        </label>
		<button type="submit">OK</button>
    </form>
<?php
	// si le pseudo est renseignÃÂ©,
    if (!empty($_POST['pseudo'])) {
    	//verifier que l'utilisateur existe
		//
		$pseudo = mysqli_real_escape_string($idcom, $_POST['pseudo']);
		$result = mysqli_query($idcom, "SELECT U_ID from Utilisateur WHERE pseudo = '$pseudo'");
		if (mysqli_num_rows($result) > 2) {
			echo "<p>Plusieurs résultats possibles</p>";
		}
		print_r($result);
	}
	if (!empty($U_ID)) {

	} else {
		echo "<p>Ã©Vous n'ÃÂªtes pas connectÃÂ©</p>";
		echo "<p>Faites une recherche d'utilisateur</p>";
	}
?>
</body>
</html>
