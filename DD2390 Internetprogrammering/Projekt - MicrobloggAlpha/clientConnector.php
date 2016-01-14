<?php

function getDbConnection()
{
	return mysqli_connect('localhost', 'useracc', 'db-name', 'password');
}

function executeInsertQuery($link,$query)
		{
			if(!mysqli_query($link, $query))
			{
				echo "Row doesn't work: SQL ['$query']" ;
			}
			return mysqli_insert_id($link);
		}

function executeQuery($link,$query)
		{
			if (($result = mysqli_query($link, $query)) === false) 
			{
						   printf("Query failed: %s<br />\n%s", $query, mysqli_error($link));
						   exit();
			}
			return $result;
		}




/*function executeInsertQuery($query)
		{
			$link = mysqli_connect('localhost', 'wiiala', 'wiiala-xmlpub13', 'wiiala');
			if(!mysqli_query($link, $query))
			{
				echo "Row doesn't work: SQL ['$query']" ;
			}
			return mysqli_insert_id($link);
		}

function executeQuery($query)
		{
			$link = mysqli_connect('localhost', 'wiiala', 'wiiala-xmlpub13', 'wiiala');
			if (($result = mysqli_query($link, $query)) === false) 
			{
						   printf("Query failed: %s<br />\n%s", $query, mysqli_error($link));
						   exit();
			}
			return $result;
		}*/

session_start();

//Sparar prenumerationsstatus
if(isset($_POST['subscriptionSave']) && isset($_SESSION['user']) && isset($_POST['subscribing']) && isset($_POST['userid'])  )
{
	//TODO Lägg till en rad i tabell
	if($_POST['subscribing'] == "yes")
	{
		//$city = $mysqli->real_escape_string($city);
		$link = getDbConnection();
		$_POST['subscriptionSave'] =  mysqli_real_escape_string ($link , $_POST['subscriptionSave']);
		$_POST['userid'] =  mysqli_real_escape_string ($link , $_POST['userid']);
		
		$query = "INSERT INTO Subsription(subscriber_id, bloggMember_id) VALUES ('".$_POST['subscriptionSave']."','".$_POST['userid']."')";
		executeInsertQuery($link,$query);
		
	}
	//TODO Ta bort rad från tabellen
	if($_POST['subscribing'] == "no")
	{
		$link = getDbConnection();
		$_POST['subscriptionSave'] =  mysqli_real_escape_string ($link , $_POST['subscriptionSave']);
		$_POST['userid'] =  mysqli_real_escape_string ($link , $_POST['userid']);
		$query = "DELETE FROM Subsription WHERE subscriber_id='".$_POST['subscriptionSave']."' AND bloggMember_id='".$_POST['userid']."'";
		executeQuery($link,$query);
		//DELETE FROM Subsription WHERE subscriber_id='' AND bloggMember_id=''
	}

}



//Prenumerationer 
if(isset($_POST['subscriptiongetUpdate']) && isset($_SESSION['user']) )
{
		$link = getDbConnection();
		$_POST['subscriptiongetUpdate'] =  mysqli_real_escape_string ($link , $_POST['subscriptiongetUpdate']);
		
		$query = " SELECT 'yes' AS subscribing,  bloggMember_id AS id, name, sex, description".
				 " FROM Subsription, Member".
				 " WHERE subscriber_id='".$_POST['subscriptiongetUpdate']."' AND Member.id=Subsription.bloggMember_id".
				 " UNION".
				 " SELECT 'no' AS subscribing, Member.id AS id, name, sex, description".
				 " FROM Member".
				 " WHERE Member.id<>'".$_POST['subscriptiongetUpdate']."'".
				 " AND Member.id NOT IN ( SELECT bloggMember_id AS Yes".
										" FROM Subsription, Member".
										" WHERE subscriber_id='".$_POST['subscriptiongetUpdate']."'".
										" AND Member.id=Subsription.subscriber_id )";
		
		
		$result = executeQuery($link,$query);
		$data = array();		
			while ($line = $result->fetch_object()) //hämta ett resultat
			 {
				array_push($data, array(
					subscribing => $line->subscribing,
					userid => $line->id,
					nickname => $line->name,
					description => $line->description,
					sex => $line->sex) );	
			 }
			mysqli_free_result($result);


	echo json_encode ($data);		
	
}

//Alla poster ges till användaren
if(isset($_POST['allPostUnfiltered']))
{
	//Om inloggad användare
	if(isset($_SESSION['user']))
	{
		$link = getDbConnection();
		$_POST['allPostUnfiltered'] =  mysqli_real_escape_string ($link , $_POST['allPostUnfiltered']);
		
	
		$query = "SELECT 'yes' AS subscribing,  bloggMember_id AS id, name, title, content,upploaded".
					" FROM Subsription, Member, Blogg".
						" WHERE  subscriber_id='".$_POST['allPostUnfiltered']."'". 
						" AND Member.id=Subsription.bloggMember_id".
						" AND Blogg.member_id=Member.id".
				" UNION".
				" SELECT 'no' AS subscribing, Member.id AS id,  name, title, content, upploaded". 
				" FROM Member, Blogg".
					" WHERE Member.id=Blogg.member_id". 
					" AND Blogg.id NOT IN (SELECT Blogg.id".
											" FROM Subsription, Member, Blogg".
											" WHERE  subscriber_id='".$_POST['allPostUnfiltered']."'".
											" AND Member.id=Subsription.bloggMember_id AND Blogg.member_id=Member.id)";

		$result = executeQuery($link,$query);
		$data = array();		
			while ($line = $result->fetch_object()) //hämta ett resultat
			 {
				array_push($data, array(
					subscribed => $line->subscribing,
					userid => $line->id,
					upploader => $line->name,
					title => $line->title,
					content => $line->content,
					upploaded => $line->upploaded) );	
			 }
			 mysqli_free_result($result);
	}
	else
	{
		$link = getDbConnection();
		
		$result = executeQuery($link,"SELECT name, member_id, title, content, upploaded FROM Blogg, Member WHERE Member.id=member_id");
		$data = array();		
			while ($line = $result->fetch_object()) //hämta ett resultat
			 {
				array_push($data, array(
					subscribed => "no",
					userid => $line->member_id,
					upploader => $line->name,
					title => $line->title,
					content => $line->content,
					upploaded => $line->upploaded) );	
			 }
			 mysqli_free_result($result);
	}
	echo json_encode ($data);	

}


//Användare lägger till blogg inlägg (endast om inloggad)
if(isset($_POST['addPost']) && isset($_SESSION['user']))
{
	$link = getDbConnection();
	$_POST['newPostContent'] =  mysqli_real_escape_string ($link , $_POST['newPostContent']);
	$_POST['addPost'] =  mysqli_real_escape_string ($link , $_POST['addPost']);
	executeInsertQuery($link,"INSERT INTO Blogg (title, content, member_id, upploaded) VALUES('".$_POST['newPostSubject']."','".$_POST['newPostContent']."','".$_POST['addPost']."',CURRENT_TIMESTAMP)");
}

//Uppdaterar profil (endast om inloggad)
if(isset($_POST['uppdateProfile']) && isset($_SESSION['user']))
{
	if(isset($_POST['myNickname']) && isset($_POST['myDescription']) && isset($_POST['mySex']))
	{
		$link = getDbConnection();
		$newNick =   mysqli_real_escape_string ($link , $_POST['myNickname']);//$_POST['myNickname'];
		$newDescription = mysqli_real_escape_string ($link , $_POST['myDescription']);//$_POST['myDescription'];
		$newSex = mysqli_real_escape_string ($link , $_POST['mySex']);//$_POST['mySex'];
		
		executeInsertQuery($link,"UPDATE Member SET name='".$newNick."' , description='".$newDescription."' , sex='".$newSex."' WHERE id='".$_POST['uppdateProfile']."'");
		
		$temp = array(userid => $_POST['uppdateProfile'],
						myNickname => $newNick,
						myDescription => $newDescription,
						mySex => $newSex);
		$_SESSION['user'] = $temp;
	}
}

//Ser om användaren är inloggad eller ej
if(isset($_POST['checkLoginStatus']))
{
	//inloggad
	if(isset($_SESSION['user']))
	{
		$out = array(status => "Yes",
					userid => $_SESSION['user'][userid],
					myNickname => $_SESSION['user'][myNickname],
					myDescription => $_SESSION['user'][myDescription],
					mySex => $_SESSION['user'][mySex]);
			
		echo json_encode ($out);	
	}
	else
	{
		$out = array(status => "No");
		echo json_encode ($out);
	}
}

//Ber om att logga in användare( posten innehåller userid)
if(isset($_POST['signIn']))
{
	$link = getDbConnection();
	$_POST['signIn'] =  mysqli_real_escape_string ($link , $_POST['signIn']);
	$result = executeQuery($link, "SELECT id, name, description, sex FROM `Member` WHERE id='".$_POST['signIn']."' LIMIT 1");
	$bool = False;
	while ($line = $result->fetch_object()) //hämta ett resultat
	 {
		//användare existerar sedan tidigare
		if($line->id == $_POST['signIn'])
		{
			
			$temp = array(userid => $_POST['signIn'],
			myNickname => $line->name,
			myDescription => $line->description,
			mySex => $line->sex);
			$_SESSION['user'] = $temp;
			
			$bool = True;
		}
		
	 }
	 mysqli_free_result($result);
	 if(!$bool) //användare existerade inte i databasen, lägger till
	 {
		$link = getDbConnection();
		$_POST['signIn'] =  mysqli_real_escape_string ($link , $_POST['signIn']);
		$query = "INSERT INTO Member(id) VALUES ('".$_POST['signIn']."')";
		$temp = array(userid => $_POST['signIn'],
			myNickname => "",
			myDescription => "",
			mySex => "");
			$_SESSION['user'] = $temp;
		executeInsertQuery($link,$query);
	 }

	echo json_encode ($_SESSION['user']);					
}

//Användaren vill logga ut
if(isset($_POST['signOut']))
{
	session_unset(); 
	session_destroy();
}
?>