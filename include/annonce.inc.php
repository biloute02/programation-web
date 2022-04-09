<?php
	include_once "../connexion/param_mysql.php";
	function afficherannonce($A_ID){
		$connect = mysqli_connect(MYHOST, MYUSER, MYPASS, MYBASE) or die("Erreur de connexion à la base de données");
		$query = mysqli_query($connect, "SELECT * FROM annonce WHERE A_ID = '$A_ID'");

		$row = $query->fetch_row();

		$row[3] = strtotime($row[3]); //Met les dates dans le bon format (ex : 2021 12 13 deviendra 13 12 2021)
		$row[3] = date('d-m-Y', $row[3]);
		$row[4] = strtotime($row[4]);
		$row[4] = date('d-m-Y', $row[4]);

		echo "Statut : $row[1] <br>";
		echo "Type de logement : $row[2]<br>";		
		echo "Date début : $row[3]<br>";		
		echo "Date fin : $row[4]<br>";
		echo "Adresse : $row[5]<br>";
		echo "Ville : $row[6]<br>";
		echo "Code postale : $row[7]<br>";
		echo "Pays : $row[8]<br>";
		echo "Prix : $row[9]<br>";
		echo "surface : $row[10]<br>";
		echo "Nombre de pièces : $row[11]";



	}

?>	