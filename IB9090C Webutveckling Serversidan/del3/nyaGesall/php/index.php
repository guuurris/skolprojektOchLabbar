<?php
include('libs/Smarty.class.php');
include ('../lang/language.php');


//View::$toGet;
$lang_eng = new lang("Eng");
// create object
$smarty = new Smarty;

if(isset($_GET["show"]))
{
	$temp = $_GET["show"];
	if($temp == "Login" ||
		($temp == "Upload" || 
		($temp == "Profile" ||
		($temp == "Page" || 
		($temp == "Information" ||
		($temp == "About"||
		$temp == "Members"))))))
	{
		$smarty->assign('title', $lang_eng->getPageTitle($_GET["show"]));
		$smarty->assign('pageToShow',$_GET["show"]);
	}
	
else 
{
	$smarty->assign('title', $lang_eng->getPageTitle('Home'));
	$smarty->assign('pageToShow','Home');	
}
}	
else 
{
	$smarty->assign('title', $lang_eng->getPageTitle('Home'));
	$smarty->assign('pageToShow','Home');	
}
$smarty->display('../../template/index.tpl.html');
?>