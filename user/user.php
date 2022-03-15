<?php
	session_start();
	include('../include/connex.inc.php');
	$idcom = connex("myparam");
    if (!empty($_SESSION['U_ID']))
        $U_ID = $_SESSION['U_ID'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="user.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profil</title>
</head>
<body>
	<h1 style="text-align:center;">
	<a href=../index.php>Share My House</a>
	<br>Profil	
	</h1>
    <form method="post">
        <label>Recherche :
            <input name="pseudo">
        </label>
    </form>
<?php
    if (!empty($_POST['pseudo'])) {
        //vérifier que l'utilisateur existe
    } 
    $pseudo = mysqli_real_escape_string($pseudo);
    $result = mysqli_query($idcom, 'SELECT * from Utilisateur WHERE ');
?>
</body>
</html>
