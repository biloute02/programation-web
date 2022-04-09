<?php
	include_once "../connexion/param_mysql.php";
	function afficherannonce($A_ID){
		$connect = mysqli_connect(MYHOST, MYUSER, MYPASS, MYBASE) or die("Erreur de connexion à la base de données");
		$query = mysqli_query($connect, "SELECT * FROM annonce WHERE A_ID = '$A_ID'");

		$row = $query->fetch_array();

		$row['date_deb'] = strtotime($row['date_deb']); //Met les dates dans le bon format (ex : 2021 12 13 deviendra 13 12 2021)
		$row['date_deb'] = date('d-m-Y', $row['date_deb']);
		$row['date_fin'] = strtotime($row['date_fin']);
		$row['date_fin'] = date('d-m-Y', $row['date_fin']);

		echo "Statut : ". $row['statut'] . "<br>";
		echo "Type de logement : " . $row['type_logement'] . "<br>";		
		echo "Date début : " . $row['date_deb'] . "<br>";		
		echo "Date fin : " . $row['date_fin'] . "<br>";
		echo "Adresse : " . $row['adresse'] . "<br>";
		echo "Ville : " . $row['ville'] . "<br>";
		echo "Code postale : " . $row['cp'] . "<br>";
		echo "Pays : " . $row['pays'] . "<br>";
		echo "Prix : " . $row['prix'] . "<br>";
		echo "surface : " . $row['surface'] . "<br>";
		echo "Nombre de pièces : " . $row['nb_pieces'];

	}
?>	
