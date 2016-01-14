<?php

session_start();


if(isset($_SESSION['visits']) &&  $_SESSION['visits'] < 10)
{

			$_SESSION['visits'] = $_SESSION['visits']+ 1;

}
else
    $_SESSION['visits'] = 1;


if(isset($_POST["counter"]))
{
	if($_POST["counter"] == "reset")
	{
		$_SESSION['visits'] = 0; 
	}
	else if($_POST["counter"] == "destroy")
	{
		$_SESSION['visits'] = 0; 
		session_destroy();
	}
}


include('libs/Smarty.class.php');

// create object
$smarty = new Smarty;

// assign some content. This would typically come from
// a database or other source, but we'll use static
// values for the purpose of this example.
$smarty->assign('visits', $_SESSION['visits']);
// display it
$smarty->display('../index.tpl.html');




#echo "Antalbesök under denna Session = ". $_SESSION['visits']; 
?>

