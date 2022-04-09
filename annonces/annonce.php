<?php
include_once "../include/annonce.inc.php";
	session_start();

	$ida = $_GET['id'];
	afficherannonce($ida);
?>