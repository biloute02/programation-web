<?php
	include_once "../include/connex.inc.php";
	include_once "../include/annonce.inc.php";
	session_start();

	if (!empty($_POST['A_ID'])) {
		$_SESSION['A_ID'] = $_POST['A_ID'];
		header("Location: reserver.php");
		die();
	}
	
	$idcom = connex("myparam");
	$query = "SELECT A_ID, statut FROM annonce WHERE 1";

	if (!empty($_POST['prixmin'])) {
		$pmin = $_POST['prixmin'];
		$query .= " AND prix >= $pmin";
	}
	if (!empty($_POST['prixmax'])) {
		$pmax = $_POST['prixmax'];
		$query .= " AND prix <= $pmax";
	}
	if (!empty($_POST['logement'])) {
		$log = $_POST['logement'];
		$query .= " AND type_logement = '$log'";
	}
	if (!empty($_POST['datedebut'])) {
		$dated = $_POST['datedebut'];
		$query .= " AND date_deb <= STR_TO_DATE('$dated', '%Y-%m-%d') AND STR_TO_DATE('$dated', '%Y-%m-%d') < date_fin";
	}
	if (!empty($_POST['datefin'])) {
		$datef = $_POST['datefin'];
		$query .= " AND date_fin >= STR_TO_DATE('$datef', '%Y-%m-%d') AND STR_TO_DATE('$datef', '%Y-%m-%d') > date_deb";
	}
	if (!empty($_POST['pays'])) {
		$pays = $_POST['pays'];
		$query .= " AND UPPER(pays) LIKE UPPER('%$pays%')";
	}
	if (!empty($_POST['ville'])) {
		$ville = $_POST['ville'];
		$query .= " AND UPPER(ville) LIKE UPPER('%$ville%')";
	}
	if (!empty($_POST['piecemin'])) {
		$pmin = $_POST['piecemin'];
		$query .= " AND nb_pieces >= $pmin";
	}
	if (!empty($_POST['piecemax'])) {
		$pmax = $_POST['piecemax'];
		$query .= " AND nb_pieces <= $pmax";
	}

	$result = mysqli_query($idcom, $query);
	$result = mysqli_fetch_all($result, MYSQLI_BOTH);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="reserver.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Recherche Annonce</title>
</head>
<body>
	<?php
	include("../include/header.inc.php");
	include("../include/nav.inc.php"); ?>
	<h2>Recherche Annonce</h2>
	<form method="POST">
	<label id="pays">Pays :</label>
	<input type="search" name="pays" id="pays" placeholder="Pays">
	<br><label id="ville">Ville :</label>
	<input type="search" name="ville" id="ville" placeholder="Ville">
	<br><label for="logement_select">Type de logement :</label>
			<select name="logement" id="logement_select">
				<option value="" disabled selected>--Choisir une option--</option>
				<option value="maison">Maison</option>
				<option value="appartement">Appartement</option>
			</select>
	<br><label id="prixmin">Prix (€) :</label> 
	<input type="number" name="prixmin" accesskey="s" placeholder="Minimum" id="prixmin" min="1">
	<input type="number" name="prixmax" accesskey="s" placeholder="Maximum" id="prixmax" min="1">
	<br><label id="datedeb">Dates début | fin:</label>
	<input type="date" name="datedebut" id="datedeb">
	<input type="date" name="datefin" id="datefin">
	<br><label id="piecemin">Nombre de pièces :</label> 
	<input type="number" name="piecemin" accesskey="s" placeholder="Minimum" id="piecemin" min="1">
	<input type="number" name="piecemax" accesskey="s" placeholder="Maximum" id="piecemax" min="1">
	<br>
	<input type="submit" name="rechercher" value="Rechercher">
	</form>
	<br>
<?php
	if (!empty($result)) {
		echo '<form method="post">';
		echo "<ol>";
		foreach ($result as $row){
			if ($row['statut'] == 1) {
				echo '<li>';
				afficherannonce($idcom, $row['A_ID']);
				echo '<br>';
				echo '<button name="A_ID" value="' . $row['A_ID'] . '">';
				echo "Voir cette annonce.</button>";
				echo '<br><br>';
				echo '</li>';
			}
		}
		echo "</ol>";
		echo "</form>";
	}
?>

</body>
</html>
