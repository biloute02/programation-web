<?php
	session_start();
 ?>

<!-- à mettre dans le css pour plus tard -->
<link rel="stylesheet" type="text/css" href="message.css">
<form method="POST">
	<label >Message :</label>
	<br><br>
	<textarea class="msg" rows="5" cols = "50" name="message"></textarea>
	<br><br>
	<input type="submit" value="Envoyer" name="envoie">
</form>