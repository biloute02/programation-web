<?php
session_start();
include_once "../include/annonce.inc.php";
$connect = mysqli_connect(MYHOST, MYUSER, MYPASS, MYBASE) or die("Erreur de connexion à la base de données");
$query = mysqli_query($connect, "SELECT A_ID FROM annonce");

$num_rows = mysqli_num_rows($query);

 
for ($i=1; $i <= $num_rows; $i++) {
	afficherannonce($i);
}

?>
<link rel="stylesheet" type="text/css" href="reserver.css">