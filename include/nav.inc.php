<nav>
	<ul>
<?php 
if (empty($_SESSION['U_ID'])) {
	echo "<li>Vous êtes déconnectés.</li>"; ?>
	<li><a href='../connexion/connexion.php'>Connexion</a></li>
	<li><a href='../connexion/register.php'>Créer un compte</a></li>
<?php
} else {
   	echo "<li>Vous êtes connectés en tant que <b><i>".$_SESSION['pseudo']."</b></i>.</li>" ?>
	<li><a href='../connexion/deconnexion.php'>Déconnexion</a></li>
<?php
} ?>
	</ul><ul>
	<li><a href='../user/user.php'>Profil</a></li>
	<li><a href='../user/recherche_user.php'>Recherche de profil</a></li>
	<li><a href='../annonces/createAnnonce.php'>Créer une annonce</a></li>
	<li><a href='../annonces/annonce.php'>Voir les annonces</a></li>
	<li><a href='../messagerie/envoie.php'>Messagerie</a></li>
	</ul>
</nav>
