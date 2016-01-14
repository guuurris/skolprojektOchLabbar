<?php
include ("queries.php");
include('../libs/Smarty.class.php');

// skapar smarty objekt
$smarty = new Smarty;

//Skapar en ny anslutning mot databasen
$q = new queries("usr_11320778", "320778" , "db_11320778");


//$post = "";// Skapar en post variabel i fall att det inte finns n�got att h�mta !
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
	// Om inte insert satsen fungerar s� ska det ha att g�ra med att email adressen redan finns 
	if(!$insert1)
	{
		$smarty->assign('PostInformation','Det fanns sparad information om anv�ndare med email: '. $newEmail .' adressen, uppdaterade informationen om denna!');
		//Uppdaterar anv�ndaren med en viss emailadress
		$q->runInsertQuery("UPDATE person SET name='" . $newName . "', website='" . $newWebsite . "'WHERE email='". $newEmail. "'");
	
	}
	// tar reda p� anv�ndarens id 
	$pid = $q->runSelectQuery("SELECT id FROM person WHERE email =  '". $newEmail ."' ");
	$i = 0;
	foreach ($pid as $v)
	{
	$personid[$i] =  $v['id'];
	$i += 1;
	}
	// l�gger till kommentar genom att anv�nda id som identifierar anv�ndaren
	$q->runInsertQuery("INSERT INTO comment (personid, comment, timeadded) VALUES( '" . $personid[0] . "' , '" . $newComment  . "' , '" . date('Y-m-d H:i:s') . "')");
}
else 
	$smarty->assign('putInMessage', 'Posta enkelt genom att fylla i alla f�lt och tryck p� l�gg till kommentar!');
	
//H�mtar alla kommentarer sorterar efter den senaste f�rst!	
$get_posts = $q->runSelectQuery("SELECT name, email, website, comment , timeadded FROM person, comment WHERE person.id = comment.personid  ORDER BY timeadded DESC ;");


// Om n�got rad h�mtas fr�n databasen och bara inte en tom
if($get_posts && count($get_posts) != 1)
{	
	// G�r igenom alla posterna och placerar dem i en array
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
// Det finns ingen post att h�mta
else 
	$smarty->assign('PostInformation', 'Det finns inga kommentarer f�r tillf�llet, bli den f�rsta att l�gga en kommentar!');	
	
//Ge tillbacka array med alla inl�gg som har h�mtats
$smarty->assign('Posts', $post);

//Visa templaten
$smarty->display('../6.2.1/index.tpl.html');

?>