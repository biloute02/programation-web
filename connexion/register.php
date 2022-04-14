<?php

include_once "../include/myparam.inc.php";

if (isset($_POST['submit'])) { // Si 'enregistrer' est cliqué, on récupère les données de l'utilisateur
	$username = htmlentities(trim($_POST['username']), ENT_QUOTES, "UTF-8");
	$password = htmlentities(trim($_POST['password']), ENT_QUOTES, "UTF-8");
	$password1 = htmlentities(trim($_POST['password1']), ENT_QUOTES, "UTF-8");
	$emailadress = htmlentities(trim($_POST['email']), ENT_QUOTES, "UTF-8");
	$nomfamille = htmlentities(trim($_POST['family']), ENT_QUOTES, "UTF-8");
	$prenom = htmlentities(trim($_POST['name']), ENT_QUOTES, "UTF-8");
	$naissance = htmlentities(trim($_POST['birth']), ENT_QUOTES, "UTF-8");

		if($username && $password && $password1 && $emailadress && $nomfamille && $prenom && $naissance){ // Si tout les champs sont remplies 
			if(filter_var($emailadress, FILTER_VALIDATE_EMAIL)){ // Regarde si l'adresse mail est valide
				if ($password==$password1) { // Si les deux mots de passes sont identiques
					if (preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/", $password)) {
					
						$passhash = password_hash($password, PASSWORD_DEFAULT); //Permet de hacher le mot de passe
						$connect = connex("myparam");


						$test = mysqli_query($connect, "SELECT * FROM utilisateur WHERE email = '$emailadress'");

						if (mysqli_num_rows($test) >= 1) die("L'adresse mail est déjà utilisée");
						
						$annaissance = date('Y-m-d', strtotime($naissance));
						$query = mysqli_query($connect, "INSERT INTO utilisateur VALUES( null, '$emailadress','$passhash', '$username', '$nomfamille', '$prenom', '$annaissance', now())"); // Insère les éléments dans la base de données

						header("Location: ./connexion.php");
						die();

					}
					else echo "<p><b>Votre mot de passe doit contenir entre 8 et 16 caractères, une majuscule, une minuscule et un chiffre !</b></p>"; //le mdp ne correspond pas
				}
				else echo "<p><b>Les deux mots de passe ne sont pas identique</b></p>"; // Les deux mdp sont différents
			}
			else echo "<p><b>l'adresse email n'est pas valide</b></p>"; // Adresse mail invalide
		}
		else echo "<p><b>Veuillez renseigner tout les champs !</b></p>"; // Il manque minimum un champs
}

?>

<body>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="connex.css">
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
		<p>Votre mot de passe (8 à 16 caractères, 1 majuscule, 1 minuscule, 1 chiffre):</p>
		<input type="password" name="password">
		<p>Confirmation de votre mot de passe:</p>
		<input type="password" name="password1">
		<br><br>
		<input type="submit" value="Inscription" name="submit">
	</form>
</body>
