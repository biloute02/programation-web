<?php
/* connection � une base de donn�e avec les parm�tres de connexion
 * contenus dans $param
 */
function connex($param)
{
	include($param.".inc.php");
	$idcom=mysqli_connect(MYHOST,MYUSER,MYPASS,MYBASE);
	if(!$idcom)
	{
    echo "<script type=text/javascript>";
		echo "alert('Connexion Impossible � la base  $base')</script>";
	}
	return $idcom;
}

/* regarde si l'utilisateur est connect�
 */
function estConnecte()
{
	if (!empty($_SESSION['U_ID'])) {
		return $_SESSION['U_ID'];
	}
	return false;
}

/* connecte l'utilisateur en l'envoyant sur connexion.php et le ridirige
 * sur la page o� la fonction a �t� appel�e
 */
function seConnecter()
{
		$_SESSION['page'] = $_SERVER['SCRIPT_NAME'];
		Header("Location: ../connexion/connexion.php");
}
?>
