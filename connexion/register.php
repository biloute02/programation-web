<?php
include_once "../include/connex.inc.php";

if (isset($_POST['submit'])) { // Si 'enregistrer' est cliqué, on récupère les données de l'utilisateur
	$connect = connex("myparam"); // se connecte à la base de données

	$username = mysqli_real_escape_string($connect, $_POST['username']); // récupère les données en gardant les é et non &eacute; (par éxemple) empêche l'injection sql
	$password = mysqli_real_escape_string($connect, $_POST['password']);
	$password1 = mysqli_real_escape_string($connect, $_POST['password1']);
	$emailadress = mysqli_real_escape_string($connect, $_POST['email']);
	$nomfamille = mysqli_real_escape_string($connect, $_POST['family']);
	$prenom = mysqli_real_escape_string($connect, $_POST['name']);
	$naissance = htmlentities(trim($_POST['birth']), ENT_QUOTES, "UTF-8");

		if($username && $password && $password1 && $emailadress && $nomfamille && $prenom && $naissance){ // Si tout les champs sont remplies
			if(filter_var($emailadress, FILTER_VALIDATE_EMAIL)){ // Regarde si l'adresse mail est valide
				if ($password==$password1) { // Si les deux mots de passes sont identiques
					if (mb_strlen($emailadress, 'utf8') <= 50 && mb_strlen($password, 'utf8') <= 16 && mb_strlen($nomfamille, 'utf8') <= 50 && mb_strlen($prenom, 'utf8') <= 50 && mb_strlen($username, 'utf8') <= 50) {
						if (preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/", $password)) { // regarde si le mdp possède 1 MAJUSCULE, 1 minustule et 1 chiffre (minimum)
					
						$passhash = password_hash($password, PASSWORD_DEFAULT); //Permet de hacher le mot de passe

						$test = mysqli_query($connect, "SELECT * FROM utilisateur WHERE email = '$emailadress'"); // regarde si l'adresse mail éxiste déjà

						if (mysqli_num_rows($test) >= 1) die("L'adresse mail est déjà utilisée"); // l'adresse mail est déjà dans la base de données
						
						$annaissance = date('Y-m-d', strtotime($naissance));
						$query = mysqli_query($connect, "INSERT INTO utilisateur VALUES( null, '$emailadress','$passhash', '$username', '$nomfamille', '$prenom', '$annaissance', now())"); // Insère les éléments dans la base de données

						header("Location: ./connexion.php"); // renvoie sur la page de connexion
						die();
					}
					else echo "<p><b>Votre mot de passe doit contenir entre 8 et 16 caractères, une majuscule, une minuscule et un chiffre !</b></p>"; //le mdp ne correspond pas
					}
					else echo "<p><b>Problème au niveau de la taille ! mot de passe : 16, email, nom, prenom et pseudo : 50 !</b></p>"; // La taille n'est pas respecté 
					
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
		<input type="text" name="email" maxlength="50" required>
		<p>Votre pseudo:</p>
		<input type="text" name="username" maxlength="50" required>
		<p>Votre nom de famille:</p>
		<input type="text" name="family" maxlength="50" required>
		<p>Votre prénom:</p>
		<input type="text" name="name" maxlength="50" required>
		<p>Votre date de naissance:</p>
		<input type="date" name="birth">
		<p>Votre mot de passe (8 à 16 caractères, 1 majuscule, 1 minuscule, 1 chiffre):</p>
		<input type="password" name="password" maxlength="16" required>
		<p>Confirmation de votre mot de passe:</p>
		<input type="password" name="password1" maxlength="16" required>
		<br><br>
		<input type="submit" value="Inscription" name="submit">
	</form>
</body>
