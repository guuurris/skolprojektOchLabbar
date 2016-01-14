<?php

include('libs/Smarty.class.php');
// create object
$smarty = new Smarty;

// assign some content. This would typically come from
// a database or other source, but we'll use static
// values for the purpose of this example.
$smarty->assign('namn', $_GET["namn"]);

// display it
$smarty->display('../lank1.tpl.htm');
?>