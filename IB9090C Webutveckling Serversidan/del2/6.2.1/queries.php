<?php
class queries
{
	private $username = "";# "usr_11320778";
	private $password= "";#"320778";
	private $database= "" ;#"db_11320778";
	private $connection = null;
	private $db_selected = null;
	function __construct($uname, $passwd , $db)
	{
		$this->username = $uname;
		$this->password = $passwd;
		$this->database =  $db;
		
	}

	//Starta anslutning mot server
	function startConnection()
	{
		
		$this->connection = mysql_connect("localhost",$this->username,$this->password);
		if($this->connection)//lyckad anslutning till databasen!
		{
				$this->db_selected = mysql_select_db($this->database,$this->connection);
		}
		return $this->connection;
		
	}
	//Avsluta anslutning mot servern
	private function endConnection()
	{
		mysql_close();
	}
	
	//Kör en given query string
	function runSelectQuery( $queryString )
	{	
		$this->startConnection();
		$row[] = "";
		
		if($this->db_selected)//Blev databasen vald?
		{
	
			$result = mysql_query($queryString);
			if (!$result)// Om querien inte lyckas få något svar ge tbx null
			{
				return null;
			}
			
			$i = 0;
			while ($row[$i] = mysql_fetch_assoc($result)) // Hämta alla mottagna rader från querien
			{
				$i += 1;
			}
			mysql_free_result($result);
		}
		$this->endConnection();
		return $row;// Ger tillbaks alla hämtade rader
	}
	
	//Lägger till rader i databasen 
	function runInsertQuery( $queryString )
	{
		$this->startConnection();
		
		if($this->db_selected)
		{
			$result = mysql_query($queryString);
		}
		$this->endConnection();
		return $result ;
	}
	//Rensar Strängar från SQL satser och html kod
	function secureSQLString($toSecure)
	{
		$this->startConnection();
		$toSecure = mysql_real_escape_string(htmlspecialchars($toSecure), $this->connection);
		$this->endConnection();
		return $toSecure;
	}
}

?>