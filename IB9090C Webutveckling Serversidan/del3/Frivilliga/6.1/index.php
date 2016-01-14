<?php
	header("Content-type: text/plain");
	//�ppna databasen
	$db = dba_open("my_db.db", "c", "db4");
	$entry = 0;
	// R�knar hur m�nga entries som finns i databasen
	while(dba_exists($entry, $db))$entry++;

	// G�r ett l�mplig datum och tidsvisning till en str�ng
	$time = date("Y-n-d G:i:s");

	// Fyller databasen med v�sentliga v�rden
	dba_insert($entry,$_SERVER['HTTP_USER_AGENT'],$db);
	dba_insert(++$entry,$_SERVER['REMOTE_ADDR'],$db);
	dba_insert(++$entry,$time,$db);
	
	
	//H�mtar fr�n databasen s�l�nge som det finns n�got i en viss entry
	$counter = 3;
	while(dba_exists($entry, $db))
	{
		//�r det tiden som h�mtades?
		if($counter == 3)
			echo "Time: " . dba_fetch($entry,$db)."\n";
		// Eller �r det remote address	?
		else if($counter == 2)
			echo "Remote address: " . dba_fetch($entry,$db)."\n";
		// Annars �r det information om webl�saren	
		else 
		{
			echo "User Agent: " . dba_fetch($entry,$db)."\n\n";
		}
		// Minska r�knaren nu med ett
		--$counter;
		// �r r�knaren lika med noll?, i s�nna fall b�rja om fr�n b�rjan med r�knandet
		if(!$counter)
			$counter = 3;
		$entry--;
	}
	
	//St�nger db hanteraren
	dba_close($db);

	
?>