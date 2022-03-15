<?php

include "../include/myparam.inc.php";

if (isset($_POST['submit'])) { // Si 'enregistrer' est cliqué, on récupère les données de l'utilisateur
	$username = htmlentities(trim($_POST['username']));
	$password = htmlentities(trim($_POST['password']));
	$password1 = htmlentities(trim($_POST['password1']));
	$emailadress = htmlentities(trim($_POST['email']));

		if($username && $password && $password1 && $emailadress){ // Si les quatre champs sont remplies 
			if(filter_var($emailadress, FILTER_VALIDATE_EMAIL)){ // Regarde si l'adresse mail est valide
				if ($password==$password1) { // Si les deux mots de passes sont identiques
					$connect = mysqli_connect(MYHOST, MYUSER, MYPASS, MYBASE) or die("Erreur de connexion à la base de données");

					$test = mysqli_query($connect, "SELECT * FROM utilisateur WHERE adressemail = '$emailadress'"); // Regarde dans la base de données si l'adresse mail est déjà utilisée ou non

					if (mysqli_num_rows($test)) die("Erreur l'adresse mail est déjà utilisée");
					
					$query = mysqli_query($connect, "INSERT INTO utilisateur VALUES( null, '$emailadress', '$username','$password')"); // Insère les éléments dans la base de données

					die("Inscription terminé <a href='login.php'> connectez </a> vous"); // L'inscription est terminée

				}
				else echo "Les deux mots de passe ne sont pas identique"; // Les deux mdp sont différents
			}
			else echo "l'adresse email n'est pas valide"; // Adresse mail invalide
		}
		else echo "Veuillez renseigner tout les champs !"; // Il manque minimum un champs
}

?>

<form method="POST" action="register.php">
	<p>Votre adresse mail:</p>
	<input type="text" name="email">
	<p>Votre nom d'utilisateur:</p>
	<input type="text" name="username">
	<p>Votre mot de passe:</p>
	<input type="password" name="password">
	<p>Confirmation de votre mot de passe:</p>
	<input type="password" name="password1">
	<br><br>
	<input type="submit" value="Inscription" name="submit">
</form>
