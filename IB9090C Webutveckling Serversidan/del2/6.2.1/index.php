<?php
include ("queries.php");
include('../libs/Smarty.class.php');

// skapar smarty objekt
$smarty = new Smarty;

//Skapar en ny anslutning mot databasen
$q = new queries("usr_11320778", "320778" , "db_11320778");


//$post = "";// Skapar en post variabel i fall att det inte finns något att hämta !
if(!empty($_POST['name']) && !empty($_POST['email']) &&  !empty($_POST['website']) && !empty($_POST['comment']) )
{

	$newName = $_POST['name'];
	$newEmail = $_POST['email'];
	$newWebsite = $_POST['website'];
	$newComment = $_POST['comment'];


	$newName = $q->secureSQLString($newName);
	$newEmail = $q->secureSQLString($newEmail);
	$newWebsite = $q->secureSQLString($newWebsite);
	$newComment = $q->secureSQLString($newComment);

	$insert1 = $q->runInsertQuery("INSERT INTO person (name, email, website) VALUES('" . $newName ."', '". $newEmail ."' , '" . $newWebsite  . "' )");
	// Om inte insert satsen fungerar så ska det ha att göra med att email adressen redan finns 
	if(!$insert1)
	{
		$smarty->assign('PostInformation','Det fanns sparad information om användare med email: '. $newEmail .' adressen, uppdaterade informationen om denna!');
		//Uppdaterar användaren med en viss emailadress
		$q->runInsertQuery("UPDATE person SET name='" . $newName . "', website='" . $newWebsite . "'WHERE email='". $newEmail. "'");
	
	}
	// tar reda på användarens id 
	$pid = $q->runSelectQuery("SELECT id FROM person WHERE email =  '". $newEmail ."' ");
	$i = 0;
	foreach ($pid as $v)
	{
	$personid[$i] =  $v['id'];
	$i += 1;
	}
	// lägger till kommentar genom att använda id som identifierar användaren
	$q->runInsertQuery("INSERT INTO comment (personid, comment, timeadded) VALUES( '" . $personid[0] . "' , '" . $newComment  . "' , '" . date('Y-m-d H:i:s') . "')");
}
else 
	$smarty->assign('putInMessage', 'Posta enkelt genom att fylla i alla fält och tryck på lägg till kommentar!');
	
//Hämtar alla kommentarer sorterar efter den senaste först!	
$get_posts = $q->runSelectQuery("SELECT name, email, website, comment , timeadded FROM person, comment WHERE person.id = comment.personid  ORDER BY timeadded DESC ;");


// Om något rad hämtas från databasen och bara inte en tom
if($get_posts && count($get_posts) != 1)
{	
	// Går igenom alla posterna och placerar dem i en array
	$i = 0;
	foreach ($get_posts as $get_post)
	{
		if(!empty($get_post['name']))
		{	
			$post[$i]['name'] = $get_post['name'];
			$post[$i]['email'] = $get_post['email'];
			$post[$i]['web'] = $get_post['website'];
			$post[$i]['comment'] = $get_post['comment']; 
			$post[$i]['added'] = $get_post['timeadded'];
			$i += 1;
		}
	}
}
// Det finns ingen post att hämta
else 
	$smarty->assign('PostInformation', 'Det finns inga kommentarer för tillfället, bli den första att lägga en kommentar!');	
	
//Ge tillbacka array med alla inlägg som har hämtats
$smarty->assign('Posts', $post);

//Visa templaten
$smarty->display('../6.2.1/index.tpl.html');

?>