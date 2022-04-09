<?php
	include_once "../include/connex.inc.php";
	include_once "../include/annonce.inc.php";
	session_start();

	if (!empty($_POST['A_ID'])) {
		$_SESSION['A_ID'] = $_POST['A_ID'];
		header("Location: reserver.php");
	}

	//$U_ID = $_SESSION['U_ID'];
	$idcom = connex("myparam");
	$query = "SELECT A_ID FROM annonce";
	//$query = "SELECT A_ID FROM annonce WHERE U_ID != '$U_ID'"
	$result = mysqli_query($idcom, $query);
	$result = mysqli_fetch_all($result, MYSQLI_BOTH);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="reserver.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Recherche Annonce</title>
</head>
<body>
	<h1 style="text-align:center;">
	<a href=../index.php>Share My House</a>
	</h1>
	<h2>Recherche Annonce</h2>
<?php
	if (!empty($result)) {
		echo '<form method="post">';
		foreach ($result as $row){
			afficherannonce($idcom, $row['A_ID']);
			echo '<br>';
			echo '<button name="A_ID" value="' . $row['A_ID'] . '">';
			echo "Voir cette annonce.</button>";
			echo '<br><br>';
		}
		echo "</form>";
	}
?>
</body>
</html>
