<?php
include_once "../include/myparam.inc.php";
session_start();

if (isset($_POST['connexion'])) {

	$email = htmlentities(trim($_POST['email']), ENT_QUOTES, "UTF-8"); 
	$password = htmlentities(trim($_POST['password']), ENT_QUOTES, "UTF-8");
	if ($email && $password) {
		$connect = mysqli_connect(MYHOST, MYUSER, MYPASS, MYBASE) or die("Erreur de connexion à la base de données");
		$passhash = password_hash($password, PASSWORD_DEFAULT);
		$test = mysqli_query($connect, "SELECT * FROM utilisateur WHERE email = '$email'");

		if (mysqli_num_rows($test) == 1 && password_verify($password, $passhash)) {

		$lpseudo = mysqli_query($connect, "SELECT pseudo FROM utilisateur WHERE email ='$email'");
		$lpseudo = $lpseudo->fetch_array(1);

		$U_ID = mysqli_query($connect, "SELECT U_ID FROM utilisateur WHERE email ='$email'");
		$U_ID = $U_ID->fetch_array(1);

		$_SESSION['email'] = $email;
		$_SESSION['U_ID'] = $U_ID['U_ID'];
		$_SESSION['pseudo'] = $lpseudo['pseudo'];

		$page = "../index.php";
		if(!empty($_SESSION['page'])){
			$page = $_SESSION['page'];
			unset($_SESSION['page']);
		}
		header("Location:" . $page);
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
	    <input type="text" name="email">
	    <p>Votre Mot de passe:</p>
	    <input type="password" name="password">
	    <br><br>
	    <input type="submit" name="connexion" value="Connexion" />
	    <br>
	    <h4>Vous ne possedez pas de compte ?</h4>
	    <a href="./register.php"> <input type="button" value="Créer un compte"> </a>
	    <br>
	</form>
</body>
