<?php
	session_start();
	include_once "../connexion/param_mysql.php";
	$idutilisateur = $_SESSION['U_ID'];
	$iddestinataire = $_SESSION['R_U_ID'];
	$connect = mysqli_connect(MYHOST, MYUSER, MYPASS, MYBASE) or die("Erreur de connexion à la base de données");
	$query = mysqli_query($connect, "SELECT contenu_message,U_ID_envoie FROM communiquer WHERE (U_ID_recoit = '$iddestinataire' AND U_ID_envoie = '$idutilisateur') OR (U_ID_recoit = '$idutilisateur' AND U_ID_envoie = '$iddestinataire') ORDER BY date_envoi DESC LIMIT 20"); // prend les 20 derniers messages mais les affiche de haut en bas
	
	if (isset($_POST['envoie'])) {
		$message = htmlentities(trim($_POST['message']), ENT_QUOTES, "UTF-8"); // permet l'ajout des tildes
		if ($message) {
			$query1 = mysqli_query($connect, "INSERT INTO communiquer VALUES('$iddestinataire', '$idutilisateur', now(), '$message')");
			header("Location:envoie.php");		
		}
	}

	if(mysqli_num_rows($query) >= 1) {
			$result = $connect->query("SELECT contenu_message,U_ID_envoie FROM communiquer WHERE (U_ID_recoit = '$iddestinataire' AND U_ID_envoie = '$idutilisateur') OR (U_ID_recoit = '$idutilisateur' AND U_ID_envoie = '$iddestinataire') ORDER BY date_envoi DESC LIMIT 20");

			for ($row_no = $result->num_rows -1; $row_no >= 0 ; $row_no--) {
				$result->data_seek($row_no);

				$row = $result->fetch_row();
				$row[1] = mysqli_query($connect, "SELECT pseudo FROM utilisateur WHERE U_ID = '$row[1]'");
				$row[1] = $row[1]->fetch_array(1);	
				echo"<p>"; 
				printf("Message de %s : %s <br>", $row[1]['pseudo'], $row[0]);
				echo"</p>";

			}
		} 


	if (isset($_POST['envoie'])) {
		if (!$message) echo "<br><b>Veuillez entrer un message</b><br>";
	}
 ?>
 <body>
 <meta charset="utf-8">
 <link rel="stylesheet" type="text/css" href="message.css">
<form method="POST">
	<label >Message :</label>
	<br><br>
	<textarea class="msg" rows="8" cols = "80" name="message"></textarea>
	<br><br>
	<input type="submit" value="Envoyer" name="envoie">
</form>
</body>
