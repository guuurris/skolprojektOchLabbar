<?php
class English
{
	public $menuString = "";
	function __construct()
	{
		//Menyns texter som ska visas
		$this->menuString['Home'] = "Home";
		$this->menuString['About'] = "About";
		$this->menuString['Page'] = "Page";
		$this->menuString['Information'] = "Contact information";
		$this->menuString['Members'] = "Members Area";
		$this->menuString['Upload'] = "Upload file";
		$this->menuString['Profile'] = "My Profile";
		$this->menuString['Login'] = "Login/Logout";
		$this->menuString['Online'] = "Logout";
		$this->menuString['Logout'] = "Logout";
		
		//Sidors titlar
		$this->pageTitle['Home'] = "Welcome to this new site in beta phase!";
		$this->pageTitle['About'] = "This is a test!";
		$this->pageTitle['Page'] = "How the page is constructed";
		$this->pageTitle['Information'] = "Overall information";
		$this->pageTitle['Members'] = "The home of members";
		$this->pageTitle['Upload'] = "Upload files";
		$this->pageTitle['Profile'] = "Your Profile";
		$this->pageTitle['Login'] = "Login";
		$this->pageTitle['Online'] = "Online";
		$this->pageTitle['Logout'] = "Logout";
		
		//Home, en page innehåll
		$this->textTitle['Home'] = "Welcome to this new site in beta phase!";
		$this->textTitle['About'] = "About this site";
		$this->textTitle['Page'] = "Information about page structures";
		$this->textTitle['Information'] = "Information";
		$this->textTitle['Members'] = "Members";
		$this->textTitle['Upload'] = "Upload";
		$this->textTitle['Profile'] = "This is your profile";
		$this->textTitle['Login'] = "Login";
		$this->textTitle['Online'] = "Online";
		$this->textTitle['Logout'] = "Logout";
		$this->textTitle['BadCredential'] = "You were not logged in!";
		$this->textTitle['Upload'] = "Upload a file";
		$this->textTitle['Upload_SUCCESS'] = "File was uploaded";
		$this->textTitle['Upload_FAILED'] = "File Could not be uploaded";
		$this->textTitle['File'] = "Name: ";
		
		// Sub rubriker
		$this->textSubtitle['Home'] =  "Beta";
		$this->textSubtitle['About'] =  "";
		$this->textSubtitle['Page'] =  "";
		$this->textSubtitle['Information'] =  "Mail me!";
		$this->textSubtitle['Members'] =  "More about";
		$this->textSubtitle['Upload'] =  "More about";
		$this->textSubtitle['Profile'] =  "More about";
		$this->textSubtitle['Login'] =  "";
		$this->textSubtitle['Online'] =  "";
		$this->textSubtitle['Logout'] =  "";
		
		// Meddelandet som ska visas
		$this->textMessage['Home'] = "Welcome to a work in progress";
		$this->textMessage['About'] = "This website is a work in progress and there is still a lot to do!";
		$this->textMessage['Page'] = "Pages are built throughout tables and with the help of css the design is stylish good lookin. ". 
									"A template engine called Smarty is used to distinguish php and html from each other.";
		$this->textMessage['Information'] = "Send a mail if you have question or have suggestion on how to make this website better";
		$this->textMessage['Members'] = "Members has the possibility to upload and view photos!";
		$this->textMessage['Upload'] = "LOLOLO";
		$this->textMessage['Profile'] = "Your Pictures is shown below ";
		$this->textMessage['Login'] = "Enter your username and password below";		
		$this->textMessage['Online'] = "Welcome in";
		$this->textMessage['ConfirmLogout'] = "Press the button to confirm logout!";
		$this->textMessage['Logout'] = "You are now offline!";
		
		$this->textMessage['BadCredential'] = "Password or username is not correct\n<br/>Sending you back to login in 3 seconds";
		$this->textMessage['Username'] = "Username:";
		$this->textMessage['Password'] = "Password:";
		
		$this->textMessage['Upload_SUCCESS_file'] = "Name of uploaded file: ";
		$this->textMessage['Upload_SUCCESS'] = "You can view your pictures under your profile. In 5 seconds you will be redirected to upload site! ";
		$this->textMessage['Upload_FAILED'] = "Only pictures with the size 10MB or less is allowed!";
		$this->textMessage['Upload_file'] = "Choose a file:";
		$this->textMessage['Upload_send'] = "Send";
		
		$this->textMessage['File'] = "Size: ";
		$this->textMessage['Mail'] = "wiiala@dsv.su.se";
		$this->textMessage['Mail_Subject'] = 'A USER POST SENT: ';
		$this->textMessage['Mail_Body'] = "Thoughts are good let me hear them!";
	}

}
?>