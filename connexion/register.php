<?php

include "param_mysql.php";

if (isset($_POST['submit'])) { // Si 'enregistrer' est cliqué, on récupère les données de l'utilisateur
	$username = htmlentities(trim($_POST['username']));
	$password = htmlentities(trim($_POST['password']));
	$password1 = htmlentities(trim($_POST['password1']));
	$emailadress = htmlentities(trim($_POST['email']));
	$nomfamille = htmlentities(trim($_POST['family']));
	$prenom = htmlentities(trim($_POST['name']));
	$naissance = htmlentities(trim($_POST['birth']));

		if($username && $password && $password1 && $emailadress && $nomfamille && $prenom && $naissance){ // Si tout les champs sont remplies 
			if(filter_var($emailadress, FILTER_VALIDATE_EMAIL)){ // Regarde si l'adresse mail est valide
				if ($password==$password1) { // Si les deux mots de passes sont identiques
					$connect = mysqli_connect(MYHOST, MYUSER, MYPASS, MYBASE) or die("Erreur de connexion à la base de données");

					$test = mysqli_query($connect, "SELECT * FROM utilisateur WHERE email = '$emailadress'");

					if (mysqli_num_rows($test) >= 1) die("L'adresse mail est déjà utilisée");
					
					$annaissance = date('Y-m-d', strtotime($naissance));
					$query = mysqli_query($connect, "INSERT INTO utilisateur VALUES( null, '$emailadress','$password', '$username', '$nomfamille', '$prenom', '$annaissance')"); // Insère les éléments dans la base de données

					die("Inscription terminé <a href='connexion.php'> connectez </a> vous"); // L'inscription est terminée

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
	<p>Votre pseudo:</p>
	<input type="text" name="username">
	<p>Votre nom de famille:</p>
	<input type="text" name="family">
	<p>Votre prénom:</p>
	<input type="text" name="name">
	<p>Votre date de naissance:</p>
	<input type="date" name="birth">
	<p>Votre mot de passe:</p>
	<input type="password" name="password">
	<p>Confirmation de votre mot de passe:</p>
	<input type="password" name="password1">
	<br><br>
	<input type="submit" value="Inscription" name="submit">
</form>