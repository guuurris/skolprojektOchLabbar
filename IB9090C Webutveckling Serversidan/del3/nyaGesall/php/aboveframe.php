<?php
include('libs/Smarty.class.php');
include ('../lang/language.php');

$lang_eng = new lang("Eng");

// create object
$smarty = new Smarty;
// assign some content. This would typically come from
// a database or other source, but we'll use static
// values for the purpose of this example.
$smarty->assign('title', $lang_eng->getPageTitle('Home'));
$smarty->assign('homebutton', $lang_eng->getMenuString('Home'));
$smarty->assign('aboutbutton', $lang_eng->getMenuString('About'));
$smarty->assign('membersbutton', $lang_eng->getMenuString('Members'));


//$smarty->assign('loginbutton', $lang_eng->getMenuString(InformationLogin::$status));

$smarty->assign('page', $lang_eng->getMenuString('Page'));
$smarty->assign('contact', $lang_eng->getMenuString('Information'));
$smarty->assign('upload', $lang_eng->getMenuString('Upload'));
$smarty->assign('profile', $lang_eng->getMenuString('Profile'));
$smarty->assign('loginbutton', $lang_eng->getMenuString('Login'));
// display it
$smarty->display('../../template/aboveframe.tpl.htm');
?>