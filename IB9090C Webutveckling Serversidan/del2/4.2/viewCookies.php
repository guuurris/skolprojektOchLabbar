<?php
	// �r kakan Anka satt?
	if (isset($_COOKIE["Anka"]))
	{
		echo "Namn p� kakan: " . $_COOKIE["Anka"] . "<br/>";
		
		echo "Tid kakan g�r ut: " . date( "Y-m-d G:i:s " , $_COOKIE["AnkaExpires"]  );
	}
	else 
		echo "Ingen kaka �r satt f�r din webl�sare antagligen till�ter din webl�sare inte kakor";
?>