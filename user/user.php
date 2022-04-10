<?php
	session_start();
	include_once('../include/connex.inc.php');
	include_once('../include/user.inc.php');
	$idcom = connex("myparam");

	if (empty($_SESSION['R_U_ID']) and estConnecte())
		$_SESSION['R_U_ID'] = $_SESSION['U_ID'];
	if (!empty($_SESSION['R_U_ID'])) {
		$R_U_ID = $_SESSION['R_U_ID'];
		$query = "SELECT * FROM Utilisateur WHERE U_ID = '$R_U_ID'";
		$result = mysqli_query($idcom, $query);
		$result = mysqli_fetch_array($result, MYSQLI_BOTH);
	} else {
		header("Location: recherche_user.php");	
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="user.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profil</title>
</head>
<body>
	<h1 style="text-align:center;">
		<a href=../index.php>Share My House</a>
	</h1>
    <form method="post" action="recherche_user.php">
		<?php affButtonProfil() ?>
	</form>
    <form method="post" action="recherche_user.php">
		<input type="search" name="pseudo" placeholder="Rechercher" accesskey="s">
		<button type="submit">OK</button>
    </form>
<?php
	if (isset($result)) {
		if (estConnecte() == $R_U_ID)
			echo "<h2>Votre profil <i>".$result['pseudo']." :</i></h2>";
		else
			echo "<h2>Profil de <i>".$result['pseudo']." :</i></h2>";
?>
	<h2>Informations</h2>
		<?php affUser($idcom, $R_U_ID, $R_U_ID == estConnecte()); ?>
	<h2>Notes</h2>
		<ul>
			<li><p>Moyenne : <?php echo moyenneNote($idcom, $R_U_ID) ?> / 5</p></li>
			<?php if (estConnecte() && estConnecte() != $R_U_ID) { ?>
			<li><form method="post" action="note_user.php">
				<fieldset>
					<legend>Donner votre avis</legend>
					<input type="number" name="note" placeholder="note" min="1" max="5" required>
					<br><textarea name="com" placeholder="commentaire" 
							rows="6" cols="60" maxlength="250" required></textarea>
					<br><button type="submit">OK</button>
				</fieldset>
			</form>
			<?php } ?></li>
			<li><a href="./note_user.php">Voir tous les avis</a>
			</li>
		</ul>
	<h2>Annonces</h2>
		<ul>

		</ul>
<?php
	} else {

	}
?>
</body>
</html>
