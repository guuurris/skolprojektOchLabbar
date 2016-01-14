<?php
header('Content-type: text/plain');

//Det här php scriptet klarar av att ta emot både namn och land genom antigen GET metod eller Post metod

//Om ett namn skickas in till som argument genom GET
if(!empty($_GET["name"]))
{
	echo 'Hej ' . htmlspecialchars($_GET["name"]) ;
	//Om ett land även skickas med som argument genom GET
	if(!empty($_GET["country"]))
		echo ",\nfrån " . htmlspecialchars($_GET["country"]) . '!';
	else 
		echo '!';
}
//Om ett namn skickas in till som argument genom POST
if(!empty($_POST["name"]))
{
	echo 'Hej ' . htmlspecialchars($_POST["name"]) ;
	//Om ett land även skickas med som argument genom POST 
	if(!empty($_POST["country"]))
		echo ",\nfrån " . htmlspecialchars($_POST["country"]) . '!';
	else 
		echo '!';
}
// Om ett kön tas emot och det ska alltid tas in genom post i så fall 
if(!empty($_POST["Gender"]))
{
	echo "\nKön: " . htmlspecialchars($_POST["Gender"]) ;
}

?>