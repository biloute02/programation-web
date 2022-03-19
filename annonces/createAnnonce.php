<?php
	//if(test isset et pas vide)
	//{
		include 'connex.php';
		
		$type_l = trim($_POST["logement"]);
		$date_d = $_POST["date_deb"];
		$date_f = $_POST["date_fin"];
		$adrs = trim($_POST["adresse"]);
		$ville = trim($_POST["ville"]);
		$cp = trim($_POST["CP"]);
		$pays = trim($_POST["pays"]);
		$prix = trim($_POST["prix"]);
		$surface = trim($_POST["surface"]);
		$nb_p = trim($_POST["pieces"]);
		
		echo $date_d;
		//...(verif bon format)
		
		
		$SQL_INSERT = "INSERT INTO annonce (A_ID, type_logement, date_deb, date_fin, adresse, ville, cp, pays, prix, surface, nb_pieces) VALUES('a', '$type_l', $date_d, $date_f, '$adrs', '$ville', $cp, '$pays', $prix, $surface, $nb_p)";		
		$idcom = connex("", "login") or die(mysqli_error()); //connex est ici !!
		mysqli_query($idcom, $SQL_INSERT);
		mysqli_close($idcom);
	//}
?>
