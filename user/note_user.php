<?php
	session_start();
	include_once('../include/connex.inc.php');
	include_once('../include/user.inc.php');
	$idcom = connex("myparam");
	
	$valide = true; //test si le format est valide

	//test si un utilisateur a été recherché
	if (!empty($_SESSION['R_U_ID'])) {
		$R_U_ID = $_SESSION['R_U_ID'];

		//test si on souhaite ajouter un avis à l'utilisateur recherché
		if (!empty($_POST['note']) and !empty($_POST['com']) and !empty($_SESSION['U_ID'])) {
			$U_ID = $_SESSION['U_ID'];
			$note = $_POST['note'];
			$com = mysqli_real_escape_string($idcom, $_POST['com']);

			if ($note < 0 or $note > 5 or mb_strlen($com, 'utf8') > 500) {
				$valide = false;
			}
			
			if ($valide) {
				$query = "SELECT * FROM evaluer WHERE U_ID_est_evalue = '$R_U_ID' AND U_ID_evalue = '$U_ID'";
				$result = mysqli_query($idcom, $query);
				$result = mysqli_fetch_all($result, MYSQLI_BOTH);
				//si un avis n'existe pas, on l'ajoute
				if (count($result) == 0) {
					$query = "INSERT INTO evaluer VALUES ('$R_U_ID', '$U_ID', '$note', '$com')";
				//sinon on modifie l'avis courant
				} else {
					$query = "UPDATE evaluer SET note = '$note', contenu_eval = '$com' WHERE U_ID_est_evalue = '$R_U_ID' AND U_ID_evalue = '$U_ID'";
				}
				$result = mysqli_query($idcom, $query);

				header("Location: ./note_user.php");
				die();
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="note_user.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Note Utilisateur</title>
</head>
<body>
	<?php
	include("../include/header.inc.php");
	include("../include/nav.inc.php"); ?>
	<main>
	<?php
	if (!$valide) {
	   echo "<p><b>Erreur</b> : format de l'avis incorrect.<br>Ressayez.</p>";
	}
	if (!empty($R_U_ID)) {
		affAvisAll($idcom, $R_U_ID);
	} ?>
	</main>
</body>
</html>
