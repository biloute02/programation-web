<?php
include "param_mysql.php";
session_start();

if (isset($_POST['connexion'])) {
	$email = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8"); // ENT_QUOTES -> pour les guillemets simple et double
	$password = htmlentities($_POST['password'], ENT_QUOTES, "UTF-8");
	if ($email && $password) {
		$connect = mysqli_connect(MYHOST, MYUSER, MYPASS, MYBASE) or die("Erreur de connexion à la base de données");

		$test = mysqli_query($connect, "SELECT * FROM utilisateur WHERE email = '$email' AND mdp = '$password'");

		if (mysqli_num_rows($test) == 1) {
		$_SESSION['email'] = $email;
		echo("Vous êtes connectés "); die($_SESSION['email']);
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