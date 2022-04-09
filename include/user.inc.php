<?php
include_once('connex.inc.php');

function moyenneNote($idcom, $U_ID)
{
	$query = "SELECT AVG(note) moy FROM evaluer WHERE U_ID_est_evalue = '$U_ID'";
	$result = mysqli_query($idcom, $query);
	$result = mysqli_fetch_all($idcom, $result);
	return result['moy'];
}

function affButtonProfil() {
	if (estConnecte()) {
		echo '<button name="R_U_ID" value="' . $_SESSION['U_ID'] . '">mon profil</button>';
	} else {
		$_SESSION['page'] = $_SERVER['SCRIPT_NAME'];
		echo '<p>' . $_SESSION['page'] . '</p>';
		echo '<button type="button">';
		echo '<a href="../connexion/connexion.php">mon profile : connexion</a>';
		echo '</button>';
	}
}

/*
function affAvis($idcom, $R_U_ID, $U_ID) {
	$query = "SELECT note, contenu_eval FROM evaluer WHERE U_ID_est_evalue = '$R_U_ID' AND U_ID_evalue = '$U_ID':";
	$result = mysqli_query($idcom, $query);
	$result = mysqli_fetch_array($result, MYSQLI_BOTH);

}*/

function affAvisAll($idcom, $R_U_ID) {
	$query = "SELECT U_ID_evalue, note, contenu_eval FROM evaluer WHERE U_ID_est_evalue = '$R_U_ID'";
	$result = mysqli_query($idcom, $query);
	$result = mysqli_fetch_all($result, MYSQLI_BOTH);

	echo '<dl>';	
	foreach ($result as $row) {
		$query = "SELECT pseudo FROM utilisateur WHERE U_ID = '" . $row['U_ID_evalue'] . "'";
		$pseudo = mysqli_query($idcom, $query);
		$pseudo = mysqli_fetch_array($pseudo);
		echo '<div class=avis>';
		echo '<dt><b>' . $pseudo['pseudo'] . '</b> :</dt>';
		echo '<dd>' . $row['note'] . ' / 5</dd>';
		echo '<dd>' . $row['contenu_eval'] . '</dd>';
		echo "</div>";
	}
	echo '</dl>';
}

?>
