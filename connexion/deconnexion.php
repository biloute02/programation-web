<?php
	session_start();
	session_unset(); //Supprime les variables de SESSION
	session_destroy(); //Detruit la session
	header("Location: ../index.php"); //renvoie sur la page index
	die();
?>
