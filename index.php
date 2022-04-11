<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="index.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index</title>
</head>
<body>
	<header>
		<h1 style="text-align:center;">
			Share My House
		</h1>
	</header>
	<nav>
		<ul>
		<?php 
		if (empty($_SESSION['U_ID'])) {
			echo "<li>Vous êtes déconnectés.</li>"; ?>
			<li><a href='connexion/connexion.php'>Connexion</a></li>
			<li><a href='connexion/register.php'>Créer un compte</a></li>
		<?php
		} else {
			echo "<li>Vous êtes connectés en tant que <i><b>".$_SESSION['pseudo']."</b></i>.</li>" ?>
			<li><a href='connexion/deconnexion.php'>Déconnexion</a></li>
		<?php
		} ?>
		</ul><ul>
			<li><a href='user/user.php'>Profil</a></li>
			<li><a href='user/recherche_user.php'>Recherche de profil</a></li>
			<li><a href='annonces/createAnnonce.html'>Créer une annonce</a></li>
			<li><a href='annonces/annonce.php'>Voir les annonces</a></li>
			<li><a href='messagerie/envoie.php'>Messagerie</a></li>
		</ul>
	</nav>
</body>
</html>

