<?php
include('libs/Smarty.class.php');
include ('../lang/language.php');
//include ('digest.php');

$lang_eng = new lang("Eng");
// create object
$smarty = new Smarty;

// assign some content. This would typically come from
// a database or other source, but we'll use static
// values for the purpose of this example.
$templateToShow = "default";
if(isset($_GET["showPage"]))
{
	$templateToShow = $_GET["showPage"];
	// Av säkerhetskäl så kollas den mottagna länken så den är riktig så inga erro uppstår
	if($templateToShow == "About" || 
	( $templateToShow == "Page" || 
	($templateToShow == "Information"  || 
	($templateToShow == "Members" || 
	($templateToShow == "Upload" ||
	($templateToShow == "Profile" ||
	($templateToShow == "Login"||
	($templateToShow == "Home"))))))))
	{
		$posts[0]['title'] = $lang_eng->getTextTitle($_GET["showPage"]);
		$posts[0]['subtitle'] = $lang_eng->getTextSubtitle($_GET["showPage"]);
		$posts[0]['message'] = $lang_eng->getTextMessage($_GET["showPage"]);
	
		if($posts[0]['subtitle'] != "")
			$posts[0]['subtitle'] = "-" . $posts[0]['subtitle']; 

		$smarty->assign('posts', $posts);
	}
}
else 
{
	$posts[0]['title'] = $lang_eng->getTextTitle('Home');
	$posts[0]['subtitle'] = $lang_eng->getTextSubtitle('Home');
	$posts[0]['message'] =  $lang_eng->getTextMessage('Home');
	
	$smarty->assign('posts', $posts);

}	
session_start();


// Om man väljer att ladda upp en fil eller redigera sin profil
if( $templateToShow == "Login" || ( $templateToShow == "Upload" || ($templateToShow == "Profile")))
{
	// Om man inte är inloggad eller vill logga in
	if(!isset($_SESSION['status']) || ($templateToShow == "Login") )
	{	
		if(isset($_SESSION['status']))
		{
			$smarty->assign('title', $lang_eng->getTextTitle('Logout'));
			$smarty->assign('message', $lang_eng->getTextMessage('ConfirmLogout'));
			$smarty->display('../../template/logout.tpl.htm');
		}
		else 
		{
			$smarty->assign('title', $lang_eng->getTextTitle('Login'));
			$smarty->assign('message', $lang_eng->getTextMessage('Login'));
			$smarty->assign('username', $lang_eng->getTextMessage('Username'));
			$smarty->assign('password', $lang_eng->getTextMessage('Password'));
			$smarty->display('../../template/login.tpl.htm');
		}
	}
	
	// Annars så ska man ladda upp en fil eller redigera profilen
	else 
	{
		if($templateToShow == "Upload")
		{
		$smarty->assign('upload', $lang_eng->getTextTitle('Upload'));
		$smarty->assign('file', $lang_eng->getTextMessage('Upload_file'));
		$smarty->assign('sendFile', $lang_eng->getTextMessage('Upload_send'));
		$smarty->display('../../template/upload.tpl.htm');
		}

		else if($templateToShow == "Profile")
		{
			$smarty->display('../../template/page.tpl.htm');
			
			$dir = "../upload_files/";
			// ser om bildernas mapp existerar 
			if (is_dir($dir)) 
			{
				// Försöker öppna bild mappen
				if ($dh = opendir($dir)) 
				{
					$i = 0;
					while (($file = readdir($dh)) !== false) // Går igenom alla bilder
					{
						if(filetype($dir . $file) == "file")
						{
							$pictures[$i]['title'] = $lang_eng->getTextTitle('File') . $file ;
							$pictures[$i]['src'] = $dir . $file;
							$pictures[$i]['size'] = $lang_eng->getTextMessage('File') . round(filesize($dir . $file) / 1000) . "KB";
								
							$i++;
						}
					}
					closedir($dh);
				}
			}
			if(isset($pictures))
			{
				$smarty->assign('pictures', $pictures);
				$smarty->display('../../template/mypictures.tpl.htm');
			}
		}
			
	}
	
		
}
else if($templateToShow == "Information")
{
	$posts[0]['mail'] =  $lang_eng->getTextMessage('Mail');
	$posts[0]['subject'] =  $lang_eng->getTextMessage('Mail_Subject') . date('Y-M-D G:i');
	$posts[0]['body'] =  $lang_eng->getTextMessage('Mail_Body');
	$smarty->assign('posts', $posts);
	$smarty->display('../../template/contact_me.tpl.htm');
}


else 
{		
		$smarty->display('../../template/page.tpl.htm');
}


?>