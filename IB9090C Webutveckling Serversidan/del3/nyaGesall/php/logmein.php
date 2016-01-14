<?php
include('libs/Smarty.class.php');
include ('../lang/language.php');
$smarty = new Smarty;
$lang_eng = new lang("Eng");
session_start();

if(!empty($_SESSION['status']) )
{
		if($_SESSION['status'] == "Online")
		{
			if(isset($_POST['logout']))
			{
				session_unset();
				
				$smarty->assign('title', $lang_eng->getTextTitle('Logout'));
				$smarty->assign('message', $lang_eng->getTextMessage('Logout'));
				$smarty->display('../../template/status_message.tpl.htm');	
			}
			else if(isset($_POST['upload']))
			{
				
				//Ser efter om någon fil tas emot
				if(!empty($_FILES["file"]))
				{
					//Filen ska vara en bild av vis typ och under en viss storlek
					if((($_FILES["file"]["type"] == "image/png") 
						|| ($_FILES["file"]["type"] == "image/gif")
						||($_FILES["file"]["type"] == "image/jpeg"))
						&&($_FILES["file"]["size"] < 10000000))
					{
						$tmp_filename = $_FILES["file"]["tmp_name"];
						$name_of_file = $_FILES["file"]["name"];
						//Flytta över filen spara kopia på serverside
						move_uploaded_file($tmp_filename, "../upload_files/$name_of_file");
					
						$smarty->assign('title', $lang_eng->getTextTitle('Upload_SUCCESS'));
						$smarty->assign('message',  $lang_eng->getTextMessage('Upload_SUCCESS_file') . $name_of_file  . $lang_eng->getTextMessage('File') . round($_FILES["file"]["size"]/1000) . " KB " . $lang_eng->getTextMessage('Upload_SUCCESS') );
						//$smarty->assign('message' , "File: " . $name_of_file . " <br/>Size: " . $_FILES["file"]["size"]/1000 . " KB");
						$smarty->display('../../template/status_message.tpl.htm');
					}
					else 
					{
						$smarty->assign('title', $lang_eng->getTextTitle('Upload_FAILED'));
						$smarty->assign('message', $lang_eng->getTextMessage('Upload_FAILED'));
						$smarty->display('../../template/status_message.tpl.htm');
					}
					header( "refresh:5;url=page.php?showPage=Upload" );
				}
			}
			
		}
}

else if(!empty($_POST['user']) && (!empty($_POST['passwd'])))
{
	if(!isset($_SESSION['user']))
	{
		if($_POST['user'] == "gustav" && ($_POST['passwd'] == "12344"))
		{
			$_SESSION['user'] = $_POST['user'];
			$_SESSION['status'] = "Online";
			
			$smarty->assign('title', $lang_eng->getTextTitle('Online'));
			$smarty->assign('message', $lang_eng->getTextMessage('Online') . " " . $_SESSION['user']);
			$smarty->display('../../template/status_message.tpl.htm');
		}
		// Om inte lösenordet var korrekt vissa nya rutan med förklaring att texten inte var korrekt
		else 
		{
			$smarty->assign('title', $lang_eng->getTextTitle('BadCredential'));
			$smarty->assign('message', $lang_eng->getTextMessage('BadCredential'));
			$smarty->display('../../template/status_message.tpl.htm');
			
			// Skickar tillbacka användaren till inloggnings sidan
			header( "refresh:3;url=page.php?showPage=Login" );
		}
	}	
}

else 
{
	$smarty->assign('title', $lang_eng->getTextTitle('Login'));
	$smarty->assign('message', $lang_eng->getTextMessage('Login'));
	$smarty->assign('username', $lang_eng->getTextMessage('Username'));
	$smarty->assign('password', $lang_eng->getTextMessage('Password'));
	$smarty->display('../../template/login.tpl.htm');
}
?>