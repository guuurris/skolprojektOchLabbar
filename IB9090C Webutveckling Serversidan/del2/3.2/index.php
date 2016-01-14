<?php
	include('libs/Smarty.class.php');
	
	// Skapar smarty objekt
	$smarty = new Smarty;
	
	$information = "";
	foreach ($_SERVER as $k => $v)
	{
		$information = $information . "$k: $v\n";
	}
	
	// L�nkar variabeln serverclient med information genom smarty 
	$smarty->assign('serverclient', $information);

	// Visar templaten med data 
	$smarty->display('../index.tpl.htm');
?>