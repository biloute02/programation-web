<?php
function connected($R_U_ID)
{
	if (!empty($_SESSION['U_ID']))
		if (R_U_ID == $_SESSION['U_ID'])
			return true;
	return false;
}
?>
