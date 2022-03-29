<?php
include_once('../include/connex.inc.php');

function connected()
{
	if (!empty($_SESSION['U_ID']))
		return $_SESSION['U_ID'];
	return 0;
}

function moyenneNote($U_ID)
{
	
}
?>
