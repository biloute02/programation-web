<?php
include "param_mysql.php";
session_start();

if (isset($_POST['connexion'])) {
	define("pseudo", "");

	error_reporting (E_ALL ^ E_NOTICE);

	$email = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8"); // ENT_QUOTES -> pour les guillemets simple et double
	$password = htmlentities($_POST['password'], ENT_QUOTES, "UTF-8");
	if ($email && $password) {
		$connect = mysqli_connect(MYHOST, MYUSER, MYPASS, MYBASE) or die("Erreur de connexion à la base de données");

		$test = mysqli_query($connect, "SELECT * FROM utilisateur WHERE email = '$email' AND mdp = '$password'");

		$lpseudo = mysqli_query($connect, "SELECT pseudo FROM utilisateur WHERE email ='$email'");
		$lpseudo = $lpseudo->fetch_array(1);

		$U_ID = mysqli_query($connect, "SELECT U_ID FROM utilisateur WHERE email ='$email'");
		$U_ID = $U_ID->fetch_array(1);

		if (mysqli_num_rows($test) == 1) {
		$_SESSION['email'] = $email;
		$_SESSION['U_ID'] = $U_ID;
		$_SESSION['pseudo'] = $lpseudo[pseudo];

		die("Vous êtes connectés $lpseudo[pseudo]");
		}
		else die("L'adresse mail ou le mot de passe est incorrect."); 

	}
	else echo "Veuillez renseigner le ou les champs manquant";
}

?>

<form action="connexion.php" method="post">
	<p>Votre adresse mail:</p>
    <input type="text" name="email">
    <p>Votre Mot de passe:</p>
    <input type="password" name="password">
    <br><br>
    <input type="submit" name="connexion" value="Connexion" />
</form>