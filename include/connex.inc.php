<?php
function connex($param)
{
	include($param.".inc.php");
	$idcom=mysqli_connect(MYHOST,MYUSER,MYPASS,MYBASE);
	if(!$idcom)
	{
    echo "<script type=text/javascript>";
		echo "alert('Connexion Impossible à la base  $base')</script>";
	}
	return $idcom;
}
?>

