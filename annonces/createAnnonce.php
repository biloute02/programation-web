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
	if ($date_f > $date_d) {
		if(preg_match('/^[0-9]+\ [a-zA-Z- 0-9]+/', $adrs)) {	
		$idcom = connex("myparam") or die("Erreur de connexion");
		mysqli_query($idcom, $SQL_INSERT);
		
<<<<<<< HEAD
		$selectaid = "SELECT MAX(A_ID) FROM annonce WHERE  U_ID = $U_ID";
		$A_ID = mysqli_query($idcom, $selectaid);
		$A_ID = $A_ID->fetch_array();
		$A_ID = $A_ID['MAX(A_ID)'];			
=======
			<form method="post" action="traiteAnnonce.php" enctype="multipart/form-data">
			
			<!-- class Titre -->
			<div class="titre">
			<p>
			<label for="titre">Donner un titre a votre annonce :<br></label>
			<input type="text" id="titre" name="titre" required>
			</p>
			</div>
			
			<!-- class Type logement -->
			<div class="logement">
			<p>
			<label for="logement_select">Type de logement <br></label>
			<select name="logement" id="logement_select" name="logement" required>
				<option value="" disabled selected>--Choisir une option--</option>
				<option value="maison">Maison</option>
				<option value="appart">Appartement</option>
			</select>
			</p>
			</div>
			
			<!-- Class date debut/fin -->
			<div class="date">
			<p>
			Periode de disponibilit&eacute; de votre logement :<br />
			du
			<input type="date" name="date_deb" value="" required>
			au
			<input type="date" name="date_fin" value="" required>
			</p>
			</div>
			
			<!-- class adresse -->
			<div class="adresse">
			<p>
			<label for="adresse">Adresse</label>
			<input type="text" id="adresse" name="adresse" required>
			</p>
			</div>
			
			<!-- class ville -->
			<div class="ville">
			<p>
			<label for="ville">Ville</label>
			<input type="text" id="ville" name="ville" required>
			</p>
			</div>
			
			<!-- class Code Postale -->
			<div class="CP">
			<p>
			<label for="CP">Code Postale</label>
			<input type="number" id="CP" name="CP" required>
			</p>
			</div>
			
			<!-- class Pays -->
			<div class="pays">
			<p>
			<label for="pays">Pays</label>
			<input type="text" id="pays" name="pays" required>
			</p>
			</div>
			
			<!-- class Desc -->
			<div class="desc">
			<p>
			<label for="desc">Description<br /></label>
			<textarea id="desc" name="desc" rows="4" cols="50" required></textarea>
			</p>
			</div>
			
			<!-- class Prix -->
			<div class="prix">
			<p>
			<label for="prix">Prix</label>
			<input type="number" id="prix" name="prix" min="0" required> &euro;
			</p>
			</div>
			
			<!-- class Surface -->
			<div class="surface">
			<p>
			<label for="surface">Surface</label>
			<input type="number" id="surface" name="surface" min="0" required> m<sup>2</sup>	
			</p>
			</div>
			
			<!-- class pieces -->
			<div class="pieces">
			<p>
			<label for="pieces">Nombre de Pi&egrave;ces</label>
			<input type="number" id="pieces" name="pieces" min="0" required>	
			</p>
			</div>
			
			<!-- class photo -->
			<div class="photo">
			<p>
			<label for="photo">Photos : </label>
			<input type="file" id="photo" name="photo[]" accept="image/png, image/jpeg" required multiple>
			</p>
			</div>
			
			<!-- class Envoie -->
			<div class="Envoie">
			<p>
			<input type="submit" name="submit" value="Publier" required>
			</p>
			</div>
>>>>>>> 87f44ea316850a5776202a971d8a842a1aec4d01

		for ($i = 0; $i < count($file['name']); $i++) {
			$ext = pathinfo($file['name'][$i], PATHINFO_EXTENSION);
			$nom = $A_ID . "_" . $i . "." . $ext;
			$origine = $file['tmp_name'][$i];
			$destination = '../photos/'.$nom;
			move_uploaded_file($origine,$destination);

			$destination = './photos/'.$nom;
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
	else echo "La date de fin est inferieur à la date de début ! <a href='./createAnnonce.html'> Retour sur la page de creation</a>";
	}
	
?>