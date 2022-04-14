<?php
if (isset($_POST["submit"])) {
	date_default_timezone_set('Europe/Paris');
	include '../include/connex.inc.php';
	session_start();
	$U_ID = $_SESSION['U_ID'];
	
	$idcom = connex("myparam");

	$titre = mysqli_real_escape_string($idcom, $_POST["titre"]);
	$type_l = $_POST["logement"];
	$date_d = $_POST["date_deb"];
	$date_f = $_POST["date_fin"];
	$date_p = date('Y-m-d');
	$adrs = mysqli_real_escape_string($idcom, trim($_POST["adresse"]));
	$ville = mysqli_real_escape_string($idcom, trim($_POST["ville"]));
	$cp = trim($_POST["CP"]);
	$pays = mysqli_real_escape_string($idcom, trim($_POST["pays"]));
	$desc = mysqli_real_escape_string($idcom, trim($_POST["desc"]));
	$prix = trim($_POST["prix"]);
	$surface = trim($_POST["surface"]);
	$nb_p = trim($_POST["pieces"]);
	$file = $_FILES['photo'];

	$SQL_INSERT = "INSERT INTO annonce (statut, titre, type_logement, date_deb, date_fin, date_post, adresse, ville, cp, pays, contenu_annonce, prix, surface, nb_pieces, U_ID) VALUES(1, '$titre', '$type_l', '$date_d', '$date_f', '$date_p', '$adrs', '$ville', $cp, '$pays','$desc', $prix, $surface, $nb_p, $U_ID)";
	
	$valide = true;

	if (mb_strlen($pays, 'utf8') > 50) {
		echo "Pays invalide : taille <= 50.";
		$valide = false;
	}	
	if (mb_strlen($ville, 'utf8') > 50) {
		echo "Ville invalide : taille <= 50.";
		$valide = false;
	} 
	if (mb_strlen($adrs, 'utf8') > 50) {
		echo "Adresse invalide : taille <= 50.";
		$valide = false;
	}
	if (mb_strlen($titre, 'utf8') > 30) {
		echo "Titre invalide : taille <= 30.";
		$valide = false;
	} 
	if ($cp < 0 or $cp > 99999) {
		echo "Code postal invalide : 0 à 99 999.";
		$valide = false;
	}
	if (mb_strlen($desc, 'utf8') > 5000) {
		echo "Description invalide : taille <= 5000.";
		$valide = false;
	}
	if (!preg_match('/^[0-9]+\ [a-zA-Z- 0-9]+/', $adrs) or mb_strlen($desc, 'utf8') > 50) {	
		echo "Adresse invalide : format '2 rue...', taille <= 50.";
		$valide = false;
	}
	if ($prix < 0 or $prix > 10000) {
		echo "Prix invalide : 0 à 10 000.";
		$valide = false;
	}
	if ($surface < 0 or $surface > 1000) {
		echo "Surface invalide : 0 à 1000 m2.";
		$valide = false;
	}
	if ($nb_p < 0 or $nb_p > 100) {
		$valide = false;
	}

	if ($valide) {
		mysqli_query($idcom, $SQL_INSERT);
		
		$selectaid = "SELECT MAX(A_ID) FROM annonce WHERE  U_ID = $U_ID";
		$A_ID = mysqli_query($idcom, $selectaid);
		$A_ID = $A_ID->fetch_array();
		$A_ID = $A_ID['MAX(A_ID)'];			

		for ($i = 0; $i < count($file['name']); $i++) {
			$ext = pathinfo($file['name'][$i], PATHINFO_EXTENSION);
			$nom = $A_ID . "_" . $i . "." . $ext;
			$origine = $file['tmp_name'][$i];
			$destination = '../photos/'.$nom;
			if (!move_uploaded_file($origine,$destination)) {
				echo "Sauvegarde de la photo impossible.<br>";
				echo "Modifiez les droits d'accès du dossier photos 'sharemyhouse/photos',<br>";
				echo "ou contactez votre administrateur.<br>";
				break;
			}

			$destination = './photos/'.$nom;
			$query = "INSERT INTO photo VALUES(null, '$destination', $U_ID, $A_ID, $i)";
			mysqli_query($idcom, $query);
		}
		echo "Votre annonce a bien ete postée <a href='../index.php'>Retour sur la page d'accueil</a>";
	} else {
		echo "<a href='./createAnnonce.php'>Retour sur la page de création</a>";
	}
	mysqli_close($idcom);		
}
	
?>
