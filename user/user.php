<?php
	session_start();
	include_once '../include/connex.inc.php';
	include_once '../include/user.inc.php';
	include_once '../include/annonce.inc.php';
	$idcom = connex("myparam");
	
	//action si on veut contacter le locataire
	if (isset($_POST['contacter'])) {
		$_SESSION['R_U_ID'] = $_POST['contacter'];
		header("Location: ../messagerie/envoie.php");
		die();
	}

	//action si on veut visiter le profil du bailleur
	if (isset($_POST['profil'])) {
		$profil = $_POST['profil'];
		$_SESSION['R_U_ID'] = $profil;
		header("Location: ../user/user.php");
		die();
	}


	//si aucun utilisateur n'est recherché, on regarde son profil
	if (empty($_SESSION['R_U_ID'])) {
		if (!estConnecte()) {
			seConnecter();
		}
		$_SESSION['R_U_ID'] = $_SESSION['U_ID'];
	}

	//on récupère les informations sur l'utilisateur
	$R_U_ID = $_SESSION['R_U_ID'];
	$query = "SELECT * FROM Utilisateur WHERE U_ID = '$R_U_ID'";
	$r_utilisateur = mysqli_query($idcom, $query);
	$r_utilisateur = mysqli_fetch_array($r_utilisateur, MYSQLI_BOTH);
	
	//on récupère les annonces de l'utilisateur
	$query = "SELECT * FROM Annonce WHERE U_ID = '$R_U_ID'";
	$r_annonce = mysqli_query($idcom, $query);
	$r_annonce = mysqli_fetch_all($r_annonce, MYSQLI_BOTH);

	if (estConnecte() == $R_U_ID) {
		//on récupère les réservations envoyés par l'utilisateur
		$query = "SELECT r.statut_res, a.A_ID, titre, date_post FROM reserve r, annonce a WHERE r.A_ID = a.A_ID AND r.U_ID = '$R_U_ID'";
		$r_envoye = mysqli_query($idcom, $query);
		$r_envoye = mysqli_fetch_all($r_envoye, MYSQLI_BOTH);
		
		//on récupère les réservations reçues par l'utilisateur
		$query = "SELECT r.statut_res, r.U_ID, a.A_ID, titre, date_post, pseudo
			FROM reserve r, annonce a, utilisateur u WHERE r.A_ID = a.A_ID
			AND r.U_ID = u.U_ID AND a.U_ID = $R_U_ID";
		$r_recu = mysqli_query($idcom, $query);
		$r_recu = mysqli_fetch_all($r_recu, MYSQLI_BOTH);
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
	<?php
	include("../include/header.inc.php");
	include("../include/nav.inc.php"); ?>
    <form method="post" action="recherche_user.php">
		<input type="search" name="R_pseudo" placeholder="Rechercher" accesskey="s">
		<button type="submit">OK</button>
		<button type="submit" name="monProfil" value="1">mon profil</button>
    </form>
<?php
	if (estConnecte() == $R_U_ID) {
		echo "<h2>Votre profil <i>".$r_utilisateur['pseudo']." :</i></h2>";
	} else { ?>
		<h2>Profil de <i><?php echo $r_utilisateur['pseudo'] ?> :</i></h2>
		<p><a href="../messagerie/envoie.php">Contacter</a></p>
	<?php
	}
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
	<?php
	if (estConnecte() == $R_U_ID) { ?>
	<hr>
	<h2>Réservations</h2>
		<form method="post" action="../annonces/annonce.php">
		<h3>Envoyées</h3>
			<ul>
			<?php
			foreach ($r_envoye as $row) {
				echo '<li>';
				echo '<dl>';
				echo '<dt>"<u>' . $row['titre'] . '</u>" ';
					echo "mise en ligne le " . $row['date_post'] . ".";
				echo '</dt>';
				echo '<dd>Demande : <b>' . $row['statut_res'] . "</b></dd>";
				echo '<dd><button name="A_ID" value="' . $row['A_ID'] . '">';
					echo "Voir l'annonce</button></dd>";
				echo "</dl>";
				echo "</li>";
			} ?>
			</ul>
		</form>
		<form method="post" action="recherche_user.php">
		<h3>Reçues</h3>
		<?php
		function  affDemandes($r_recu, $statut_res) {
			foreach ($r_recu as $row) {
				if ($row['statut_res'] != $statut_res) continue;
				echo '<li>';
				echo '<dl>';
				echo '<dt>"<u>' . $row['titre'] . '</u>" ';
					echo "mise en ligne le " . $row['date_post'] . ".";
				echo '</dt>';
				echo '<dd><i>' . $row['pseudo'] . "</i> : ";
					echo '<button name="contacter" value="' . $row['U_ID'] . '">';
					echo "Contacter</button>";
					echo '<button name="profil" value="' . $row['U_ID'] . '">';
					echo "Profil</button>";
				echo "</dd>";
				echo "</dl>";
				echo '</li>';
			}
		}?>
		<h4>En attentes</h4>
			<ul>
			<?php affDemandes($r_recu, EN_COURS); ?>
			</ul>
		<h4>Acceptées</h4>
			<ul>
			<?php affDemandes($r_recu, ACCEPTE); ?>
			</ul>
		</form>
	<?php
	} ?>
	<hr>
	<h2>Annonces</h2>
		<form method="post" action="../annonces/annonce.php">
		<h3>Publiques</h3>
		<ul>
		<?php
		foreach ($r_annonce as $row) {
			if ($row['statut']) {
				echo '<li>';
				afficherannonce($idcom, $row['A_ID']);
				echo '<button name="A_ID" value="' . $row['A_ID'] . '">';
				echo "Voir cette annonce</button>";
				echo '</li>';
			}
		} ?>
		</ul>
		<?php
		if (estConnecte() == $R_U_ID) { ?>
			<h3>Privées</h3>
			<ul>
			<?php
			foreach ($r_annonce as $row) {
				if (!$row['statut']) {
					echo '<li>';
					afficherannonce($idcom, $row['A_ID']);
					echo '<button name="A_ID" value="' . $row['A_ID'] . '">';
					echo "Voir cette annonce.</button>";
					echo '</li>';
				}
			}
		}
		?>
		</ul>
		</form>
</body>
</html>
