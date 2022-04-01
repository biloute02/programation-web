<?php
	include_once "../connexion/param_mysql.php";
	function afficherannonce($A_ID){
		$connect = mysqli_connect(MYHOST, MYUSER, MYPASS, MYBASE) or die("Erreur de connexion à la base de données");
		$query = mysqli_query($connect, "SELECT * FROM annonce WHERE A_ID = '$A_ID'");

		$row = $query->fetch_row();

		printf("Statut : %s\n", $row[1]);
		printf("Type de logement : %s\n", $row[2]);
		printf("Date début : %d  |", $row[3]); //date à revérifier peut-être echo date("Y-m-d", $row[3])
		printf("  Date fin : %d\n", $row[4]);
		printf("Adresse : %s\n", $row[5]);
		printf("Ville : %s\n", $row[6]);
		printf("Code postale : %s\n", $row[7]);
		printf("Pays : %s\n", $row[8]);
		printf("Annonce : %s\n", $row[9]);
		printf("Prix : %lf\n", $row[10]);
		printf("surface : %d\n", $row[11]);
		printf("Nombre de pièces : %d\n", $row[12]);



	}

?>	