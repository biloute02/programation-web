<?php
include_once "../include/connex.inc.php";
session_start();

if (isset($_POST['connexion'])) {
	$connect = connex("myparam"); //Se connecte à la base de données
	$password = mysqli_real_escape_string($connect, $_POST['password']);
	$email = mysqli_real_escape_string($connect, $_POST['email']);
	if ($email && $password) { //Si les deux champs ne sont pas vide

		$passhash = password_hash($password, PASSWORD_DEFAULT); // on hash le mot de passe
		$test = mysqli_query($connect, "SELECT * FROM utilisateur WHERE email = '$email'"); // on vérifie que l'adresse mail éxiste 

		if (mysqli_num_rows($test) == 1 && password_verify($password, $passhash)) { // Si les données sont bonnes alors on lance la session

		$lpseudo = mysqli_query($connect, "SELECT pseudo FROM utilisateur WHERE email ='$email'");
		$lpseudo = $lpseudo->fetch_array(1);

		$U_ID = mysqli_query($connect, "SELECT U_ID FROM utilisateur WHERE email ='$email'"); // on selectionne l'id de l'utilisateur pour lancer la session U_ID
		$U_ID = $U_ID->fetch_array(1);

		$_SESSION['email'] = $email;
		$_SESSION['U_ID'] = $U_ID['U_ID'];
		$_SESSION['pseudo'] = $lpseudo['pseudo'];

		$page = "../index.php";
		if(!empty($_SESSION['page'])){
			$page = $_SESSION['page'];
			unset($_SESSION['page']);
		}
		header("Location:" . $page); // pour renvoyer sur la page precedente
		die();
		}
		else die("L'adresse mail ou le mot de passe est incorrect."); 

	}
	else echo "Veuillez renseigner le ou les champs manquant";
}

?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="connex.css">
</head>
<body>
	<form action="connexion.php" method="post">
		<p>Votre adresse mail:</p>
	    <input type="text" name="email" maxlength="50" required>
	    <p>Votre Mot de passe:</p>
	    <input type="password" name="password" maxlength="16" required>
	    <br><br>
	    <input type="submit" name="connexion" value="Connexion" />
	    <br>
	    <h4>Vous ne possedez pas de compte ?</h4>
	    <a href="./register.php"> <input type="button" value="Créer un compte"> </a>
	    <br>
	</form>
</body>
