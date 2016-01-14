<?php
	header("Content-type: text/plain");
	//öppna databasen
	$db = dba_open("my_db.db", "c", "db4");
	$entry = 0;
	// Räknar hur många entries som finns i databasen
	while(dba_exists($entry, $db))$entry++;

	// Gör ett lämplig datum och tidsvisning till en sträng
	$time = date("Y-n-d G:i:s");

	// Fyller databasen med väsentliga värden
	dba_insert($entry,$_SERVER['HTTP_USER_AGENT'],$db);
	dba_insert(++$entry,$_SERVER['REMOTE_ADDR'],$db);
	dba_insert(++$entry,$time,$db);
	
	
	//Hämtar från databasen sålänge som det finns något i en viss entry
	$counter = 3;
	while(dba_exists($entry, $db))
	{
		//Är det tiden som hämtades?
		if($counter == 3)
			echo "Time: " . dba_fetch($entry,$db)."\n";
		// Eller är det remote address	?
		else if($counter == 2)
			echo "Remote address: " . dba_fetch($entry,$db)."\n";
		// Annars är det information om webläsaren	
		else 
		{
			echo "User Agent: " . dba_fetch($entry,$db)."\n\n";
		}
		// Minska räknaren nu med ett
		--$counter;
		// Är räknaren lika med noll?, i sånna fall börja om från början med räknandet
		if(!$counter)
			$counter = 3;
		$entry--;
	}
	
	//Stänger db hanteraren
	dba_close($db);

	
?>