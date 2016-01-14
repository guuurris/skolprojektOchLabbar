<?php
header('Content-type: text/plain');
//Om ett namn skickas in till som argument
if(!empty($_GET["name"]))
{
	echo 'Hello ' . htmlspecialchars($_GET["name"]) ;
	
	//Om ett land även skickas med som argument
	if(!empty($_GET["country"]))
		echo ",\nFrom " . htmlspecialchars($_GET["country"]) . '!';
	else 
		echo '!';
}

?>
