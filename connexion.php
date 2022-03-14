<?php
include "param_mysql.php";
session_start();

if (isset($_POST['connexion'])) {
	$email = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8"); // ENT_QUOTES -> pour les guillemets simple et double
	$password = htmlentities($_POST['password'], ENT_QUOTES, "UTF-8");
	if ($email && $password) {
		$connect = mysqli_connect(MYHOST, MYUSER, MYPASS, MYBASE) or die("Erreur de connexion à la base de données");

		$test = mysqli_query($connect, "SELECT adressemail FROM utilisateur WHERE adressemail = '$email' AND password = '$password'");

		if (mysqli_num_rows($test)) die("L'adresse mail ou le mot de passe est incorrect");

		$_SESSION['adressemail'] = $email;
		$pseudo = mysqli_query($connect, "SELECT pseudo FROM utilisateur WHERE adressemail = '$email'");

		echo "Vous être bien connecté $pseudo";

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