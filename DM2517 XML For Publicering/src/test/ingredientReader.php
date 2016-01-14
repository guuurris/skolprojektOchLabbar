<?php 
	$lines = file("ingredienser.txt", FILE_IGNORE_NEW_LINES);
	
	foreach ($lines as $line_num => $line) 
	{
		echo  htmlspecialchars($line) . "<br />\n";
	}	
?>