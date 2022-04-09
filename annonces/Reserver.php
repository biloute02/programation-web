<?php
session_start();
include_once "../include/annonce.inc.php";
$idutilisateur = $_SESSION['U_ID'];
$connect = mysqli_connect(MYHOST, MYUSER, MYPASS, MYBASE) or die("Erreur de connexion à la base de données");
$query = mysqli_query($connect, "SELECT A_ID FROM annonce WHERE U_ID != '$idutilisateur'");

$rows = mysqli_fetch_all($query);

if(!empty($rows)){
	foreach ($rows as $row){
		afficherannonce($row[0]);
		echo "<br><a href='./annonce.php?id=$row[0]'>Voir cette annonce ? </a><br><br>";
	}
}

?>

<link rel="stylesheet" type="text/css" href="reserver.css">