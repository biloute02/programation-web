<?php
include_once('connex.inc.php');

/* Renvoie la moyenne des notes d'un utilisateur arrondi au dixième.
 */
function moyenneNote($idcom, $U_ID)
{
	$query = "SELECT AVG(note) moy FROM evaluer WHERE U_ID_est_evalue = '$U_ID'";
	$result = mysqli_query($idcom, $query);
	$result = mysqli_fetch_array($result);
	return round($result['moy'], 2);
}

/* Affiche les informations publics d'un utilisateur par défaut.
 * Si $all vaut "true", affiche toutes les informations.
 */
function affUser($idcom, $U_ID, $all = false)
{
	$query = "SELECT * FROM Utilisateur WHERE U_ID = '$U_ID'";
	$result = mysqli_query($idcom, $query);
	$result = mysqli_fetch_array($result, MYSQLI_BOTH);
	printf('<dl class="user">');
	printf("<dt><b>%s</b> :</dt>", $result['pseudo']);
	printf("<dd>prénom : %s</dd>", $result['prenom']);
	printf("<dd>nom : %s</dd>", $result['nom']);
	printf("<dd>date d'inscription : %s</dd>", $result['date_inscription']);
	if ($all) {
		printf("<dd>email : %s</dd>", $result['email']);
		printf("<dd>date de naissance : %s</dd>", $result['date_naissance']);
	}
	printf("</dl>");
}

/*
function affAvis($idcom, $R_U_ID, $U_ID) {
	$query = "SELECT note, contenu_eval FROM evaluer WHERE U_ID_est_evalue = '$R_U_ID' AND U_ID_evalue = '$U_ID':";
	$result = mysqli_query($idcom, $query);
	$result = mysqli_fetch_array($result, MYSQLI_BOTH);

}*/

/* Affiche la liste de tous les avis d'un utilisateur
 */
function affAvisAll($idcom, $R_U_ID)
{
	$query = "SELECT U_ID_evalue, note, contenu_eval FROM evaluer WHERE U_ID_est_evalue = '$R_U_ID'";
	$result = mysqli_query($idcom, $query);
	$result = mysqli_fetch_all($result, MYSQLI_BOTH);
	
	if (count($result) >= 1) {
		echo '<dl>';	
		foreach ($result as $row) {
			$query = "SELECT pseudo FROM utilisateur WHERE U_ID = '" . $row['U_ID_evalue'] . "'";
			$pseudo = mysqli_query($idcom, $query);
			$pseudo = mysqli_fetch_array($pseudo);
			echo '<div class="avis">';
			echo '<dt><b>' . $pseudo['pseudo'] . '</b> :</dt>';
			echo '<dd>' . $row['note'] . ' / 5</dd>';
			echo '<dd>' . $row['contenu_eval'] . '</dd>';
			echo "</div>";
		}
		echo '</dl>';
	} else {
		echo "<p>Aucun avis à ce jour</p>";
	}
}

?>
