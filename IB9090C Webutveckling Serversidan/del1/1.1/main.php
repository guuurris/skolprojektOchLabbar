<?php	
	   $filename = 	"antalbesok.txt";
	   $guests = 0;
	   header('Content-type: text/plain');

	   $handler = fopen($filename,"r");
	   //�r filhanteraren l�st?
	   if(flock($handler, LOCK_EX))
	   {
			// Ser om filen existerar
			if(file_exists($filename))
			{	
				$guests = (int) fread($handler,filesize($filename));
			}
			fclose($handler);
			
			//�kar och �ndrar antalet bes�k p� sidan
			$guests ++;
			$value = "$guests";
			$handler = fopen($filename,"w+");
			fwrite($handler,$value);
			flock($handler, LOCK_UN);
			fclose($handler);
		}	
		
	   echo "Antal Bes�kare: " . $value ; 
	   
?>