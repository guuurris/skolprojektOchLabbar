<?php
	   //Inkludera smarty
	   include('libs/Smarty.class.php');

	   // skapar smarty objekt
	   $smarty = new Smarty;
	   
	   $filename = 	"antalbesok.txt";
	   $guests = 0;	
	   $handler = fopen($filename,"r");
	   if(flock($handler, LOCK_EX))
	   {
			if(file_exists($filename))
			{	
				$guests = (int) fread($handler,filesize($filename));
			}
			fclose($handler);
	   
			$guests ++;
			$handler = fopen($filename,"w+");
			fwrite($handler,$guests);
			flock($handler, LOCK_UN);
			fclose($handler);
		}	
	   


		// Länkar variabeln visitor med guest genom smarty 
		$smarty->assign('visitor', $guests);

		// Visar templaten med data
		$smarty->display('../index.tpl.htm');
	   
?>