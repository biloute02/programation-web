<?php
	session_start();
	include "../connexion/param_mysql.php";
	$idutilisateur = $_SESSION['U_ID'];
	$iddestinataire = $_SESSION['R_U_ID'];

	if (isset($_POST['envoie'])) {
		$message = htmlentities(trim($_POST['message']));
		if ($message) {
			if(strlen($message) < 256){
				$connect = mysqli_connect(MYHOST, MYUSER, MYPASS, MYBASE) or die("Erreur de connexion à la base de données");
				$query = mysqli_query($connect, "INSERT INTO communiquer VALUES('$iddestinataire', '$idutilisateur', now(), '$message')");
				die("Message envoyé !");

			}
			else echo "Le message doit faire 255 caractères au maximum";
		}
		else echo "Veuillez entrer un message";
	}
 ?>

<!-- à mettre dans le css pour plus tard -->
<link rel="stylesheet" type="text/css" href="message.css">
<form method="POST">
	<label >Message :</label>
	<br><br>
	<textarea class="msg" rows="5" cols = "50" name="message"></textarea>
	<br><br>
	<input type="submit" value="Envoyer" name="envoie">
</form>