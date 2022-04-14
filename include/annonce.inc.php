<?php
/* Affiche l'ensemble de la description d'une annonce
 */
function afficherannonceimage($idcom, $A_ID)
{
	$query = mysqli_query($idcom, "SELECT * FROM annonce WHERE A_ID = '$A_ID'");

	$row = $query->fetch_array();

	$row['date_deb'] = strtotime($row['date_deb']); //Met les dates dans le bon format (ex : 2021 12 13 deviendra 13 12 2021)
	$row['date_deb'] = date('d-m-Y', $row['date_deb']);
	$row['date_fin'] = strtotime($row['date_fin']);
	$row['date_fin'] = date('d-m-Y', $row['date_fin']);

	echo "<dl>";
	if ($row['statut'] == 0)
		echo "<dt><b>- Annonce Privée -</b></dt>";
	echo "<dt>\"<u>" . $row['titre'] . "</u>\"</dt>"; 
	echo "<dd>";
	echo "Type de logement : " . $row['type_logement'] . "<br>";		
	echo "Date début : " . $row['date_deb'] . "<br>";		
	echo "Date fin : " . $row['date_fin'] . "<br>";
	echo "Adresse : " . $row['adresse'] . "<br>";
	echo "Ville : " . $row['ville'] . "<br>";
	echo "Code postale : " . $row['cp'] . "<br>";
	echo "Pays : " . $row['pays'] . "<br>";
	echo "Prix : " . $row['prix'] . "<br>";
	echo "Surface : " . $row['surface'] . "<br>";
	echo "Nombre de pièces : " . $row['nb_pieces'] . "<br>";
	echo "Description : " . nl2br($row['contenu_annonce']);
	echo "</dd></dl>";

	$query1 = mysqli_query($idcom, "SELECT chemin FROM photo WHERE A_ID = $A_ID");
	echo "<br>";
	$padding = 0;
	while ($rows = mysqli_fetch_assoc($query1)){
		if ($padding >= 1) echo'<span style="padding-left:30px;"><img height="400" width="400" src="../'.$rows['chemin']. '"></span>'; 
		else echo'<img height="400" width="400" src="../'.$rows['chemin']. '">';
		$padding++;
	}	
}

/* Affiche toutes les informations textuelles de l'annonce
 */
function afficherannonce($idcom, $A_ID)
{
	$query = mysqli_query($idcom, "SELECT * FROM annonce WHERE A_ID = '$A_ID'");

	$row = $query->fetch_array();

	$row['date_deb'] = strtotime($row['date_deb']); //Met les dates dans le bon format (ex : 2021 12 13 deviendra 13 12 2021)
	$row['date_deb'] = date('d-m-Y', $row['date_deb']);
	$row['date_fin'] = strtotime($row['date_fin']);
	$row['date_fin'] = date('d-m-Y', $row['date_fin']);

	echo "<dl>" ;
	if ($row['statut'] == 0)
		echo "<dt><b>- Annonce Privée -</b></dt>";
	echo "<dt>\"<u>" . $row['titre'] . "</u>\"</dt>"; 
	echo "<dd>";
	echo "Type de logement : " . $row['type_logement'] . "<br>";		
	echo "Date début : " . $row['date_deb'] . "<br>";		
	echo "Date fin : " . $row['date_fin'] . "<br>";
	echo "Adresse : " . $row['adresse'] . "<br>";
	echo "Ville : " . $row['ville'] . "<br>";
	echo "Code postale : " . $row['cp'] . "<br>";
	echo "Pays : " . $row['pays'] . "<br>";
	echo "Prix : " . $row['prix'] . "<br>";
	echo "Surface : " . $row['surface'] . "<br>";
	echo "Nombre de pièces : " . $row['nb_pieces'] . "<br>";
	echo "</dd></dl>";
}

/* affiche toutes les résevartions sur une annonce
 * si statut_res est spécifié, affiche seulement celles avec ce status
 */
function affAllReservation ($idcom,
							$A_ID, 
							$statut_res = '%')
{
	$query = "SELECT pseudo, r.U_ID, r.A_ID, statut_res
		FROM reserve r, utilisateur u WHERE r.U_ID = u.U_ID
		AND r.A_ID = '$A_ID' AND statut_res LIKE '$statut_res'";
	$result = mysqli_fetch_all(mysqli_query($idcom, $query), MYSQLI_BOTH);
	if (count($result) == 0) return;
	echo "<dl>";
	foreach ($result as $row) {
		printf("<dd><label><i>%s</i> :", $row['pseudo']);
		printf("<button type='submit' value='%s' name='accepter'>
			Accepter</button>", $row['U_ID']);
		printf("<button type='submit' value='%s' name='refuser'>
			Refuser</button>", $row['U_ID']);
		printf("<button type='submit' value='%s' name='contacter'>
			Contacter</button>", $row['U_ID']);
		printf("<button type='submit' value='%s' name='profil'>
			Profil</button>", $row['U_ID']);
		printf("</label></dd>");
	}
	echo "</dl>";
}
?>	
