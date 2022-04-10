<?php
if(isset($_POST["submit"])) {
	date_default_timezone_set('Europe/Paris');
	include '../include/connex.inc.php';
	session_start();

	if (!estConnecte()) {
		seConnecter();
		}
	
	$U_ID = $_SESSION['U_ID'];

	$titre = $_POST["titre"];
	$type_l = $_POST["logement"];
	$date_d = $_POST["date_deb"];
	$date_f = $_POST["date_fin"];
	$date_p = date('Y-m-d');
	$adrs = trim($_POST["adresse"]);
	$ville = trim($_POST["ville"]);
	$cp = trim($_POST["CP"]);
	$pays = trim($_POST["pays"]);
	$desc = trim($_POST["desc"]);
	$prix = trim($_POST["prix"]);
	$surface = trim($_POST["surface"]);
	$nb_p = trim($_POST["pieces"]);
	$file = $_FILES['photo'];
	$SQL_INSERT = "INSERT INTO annonce (statut, titre, type_logement, date_deb, date_fin, date_post, adresse, ville, cp, pays, contenu_annonce, prix, surface, nb_pieces, U_ID) VALUES(1, '$titre', '$type_l', '$date_d', '$date_f', '$date_p', '$adrs', '$ville', $cp, '$pays','$desc', $prix, $surface, $nb_p, $U_ID)";
	
	if(preg_match('/^[0-9]+\ [a-zA-Z- 0-9]+/', $adrs)) {	
		$idcom = connex("myparam") or die("Erreur de connexion");
		mysqli_query($idcom, $SQL_INSERT);
		
		$selectaid = "SELECT MAX(A_ID) FROM annonce WHERE  U_ID = $U_ID";
		$A_ID = mysqli_query($idcom, $selectaid);
		$A_ID = $A_ID->fetch_array();
		$A_ID = $A_ID['MAX(A_ID)'];			

		for ($i = 0; $i < count($file['name']); $i++) {
			$temps = microtime(true);
			$origine = $file['tmp_name'][$i];
			$destination = '../photos/'.$temps;
			move_uploaded_file($origine,$destination);

			$destination = './photos/'.$temps;
			$query = "INSERT INTO photo VALUES(null, '$destination', $U_ID, $A_ID, $i)";
			mysqli_query($idcom, $query);
		}
		mysqli_close($idcom);		
	}else{
		echo "Adresse invalide <a href='./createAnnonce.html'>Retour sur la page de creation</a>";
		die();
	}
	echo "Votre annonce a bien ete poste <a href='../index.php'>Retour sur la page d'accueil</a>";
	}
?>