<?php
	
	// Finns det n�gon kaka satt f�r webbl�saren
	if (!isset($_COOKIE["Anka"]))
	{
		$timeouttid = time()+60*60*3;			
		setcookie("Anka", "kaka", $timeouttid);
		setcookie("AnkaExpires", $timeouttid, $timeouttid);
	}
	include('libs/Smarty.class.php');
	$smarty = new Smarty;
	$smarty->display('../index.htm');
	
?>