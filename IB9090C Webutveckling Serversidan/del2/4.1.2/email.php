<?php

include('libs/Smarty.class.php');
// create object
$smarty = new Smarty;

// assign some content. This would typically come from
// a database or other source, but we'll use static
// values for the purpose of this example.
if($_POST["knapp"])
{
	$smarty->assign('emailadress', $_POST["email"]);
	$smarty->assign('namn', $_POST["namn"]);
}
// display it
$smarty->display('../email.tpl.html');
?>