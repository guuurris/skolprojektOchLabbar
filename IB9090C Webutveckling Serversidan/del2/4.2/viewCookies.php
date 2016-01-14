<?php
	// Är kakan Anka satt?
	if (isset($_COOKIE["Anka"]))
	{
		echo "Namn på kakan: " . $_COOKIE["Anka"] . "<br/>";
		
		echo "Tid kakan går ut: " . date( "Y-m-d G:i:s " , $_COOKIE["AnkaExpires"]  );
	}
	else 
		echo "Ingen kaka är satt för din webläsare antagligen tillåter din webläsare inte kakor";
?>