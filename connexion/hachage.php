<?php 
include "param_mysql.php";
session_start();

if (isset($_POST['connexion'])) {

	$password = htmlentities(trim($_POST['password']));
	if ($password) {
		$passhash = password_hash($password, PASSWORD_DEFAULT);
		print_r($passhash);
		
		}
}


 ?>

 <form action="hachage.php" method="post">
    <p>Votre Mot de passe:</p>
    <input type="password" name="password">
    <br><br>
    <input type="submit" name="connexion" value="Connexion" />
</form>