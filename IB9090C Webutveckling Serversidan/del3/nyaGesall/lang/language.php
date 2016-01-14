<?php 
include('classEnglish.php');
class lang
{	
	private $class = "";
	function __construct($language)
	{
		if($language == "Eng")
		{
			$this->class = new English();
		}
	}
	//hämtar meny-sträng 
	function getMenuString($message)
	{
		return $this->class->menuString[$message];
	}
	
	//hämtar en sidas titel
	function getPageTitle($message)
	{
		return $this->class->pageTitle[$message];
	}
	
	//hämtar titel till en skriven text
	function getTextTitle($message)
	{
		return $this->class->textTitle[$message];
	}
	
	//hämtar underrubrik till en skriven text
	function getTextSubtitle($message)
	{
		return $this->class->textSubtitle[$message];
	}
	
	//hämtar text meddelaned i en skriven text
	function getTextMessage($message)
	{
		return $this->class->textMessage[$message];
	}
}
?>