<?php
header('Content-type: text/plain');

//Det h�r php scriptet klarar av att ta emot b�de namn och land genom antigen GET metod eller Post metod

//Om ett namn skickas in till som argument genom GET
if(!empty($_GET["name"]))
{
	echo 'Hej ' . htmlspecialchars($_GET["name"]) ;
	//Om ett land �ven skickas med som argument genom GET
	if(!empty($_GET["country"]))
		echo ",\nfr�n " . htmlspecialchars($_GET["country"]) . '!';
	else 
		echo '!';
}
//Om ett namn skickas in till som argument genom POST
if(!empty($_POST["name"]))
{
	echo 'Hej ' . htmlspecialchars($_POST["name"]) ;
	//Om ett land �ven skickas med som argument genom POST 
	if(!empty($_POST["country"]))
		echo ",\nfr�n " . htmlspecialchars($_POST["country"]) . '!';
	else 
		echo '!';
}
// Om ett k�n tas emot och det ska alltid tas in genom post i s� fall 
if(!empty($_POST["Gender"]))
{
	echo "\nK�n: " . htmlspecialchars($_POST["Gender"]) ;
}

?>