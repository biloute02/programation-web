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
	<h1 style="text-align:center;">
	Share My House 
	</h1>
	<?php if (empty($_SESSION['pseudo'])) echo "vous êtes déconnectés"; else echo "vous êtes connectés en tant que : <b>".$_SESSION['pseudo']."</b>" ?>
	<p><a href='user/user.php'>profile</a>
	<p><a href='user/recherche_user.php'>recherche de profile</a>
	<p><a href='connexion/connexion.php'>connexion</a>
	<p><a href='connexion/deconnexion.php'>deconnexion</a>
	<p><a href='connexion/register.php'>register</a>
	<p><a href='annonces/createAnnonce.html'>createAnnonce</a>
	<p><a href='messagerie/envoie.php'>Envoyer un message</a>
</body>
</html>

