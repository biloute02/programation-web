<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="createAnnonce.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Créer Annonce</title>
	</head>
	<body>
	
		<?php
			include '../include/connex.inc.php';			
			session_start();
			if (!estConnecte()) {
				seConnecter();
			}
			include '../include/header.inc.php';
			include '../include/nav.inc.php';
		?>
		
			<form method="post" action="traiteAnnonce.php" enctype="multipart/form-data">
			
			<!-- class Titre -->
			<div class="titre">
			<p>
			<label for="titre">Donner un titre a votre annonce :<br></label>
			<input type="text" maxlength="30" id="titre" name="titre" required>
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
			<input type="text" maxlength="50" id="adresse" name="adresse" required>
			</p>
			</div>
			
			<!-- class ville -->
			<div class="ville">
			<p>
			<label for="ville">Ville</label>
			<input type="text" maxlength="50" id="ville" name="ville" required>
			</p>
			</div>
			
			<!-- class Code Postale -->
			<div class="CP">
			<p>
			<label for="CP">Code Postale</label>
			<input type="number" min="0" max="99999" maxlength="5" id="CP" name="CP" required>
			</p>
			</div>
			
			<!-- class Pays -->
			<div class="pays">
			<p>
			<label for="pays">Pays</label>
			<input type="text" maxlength="50" id="pays" name="pays" required>
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

	</body>
</html>