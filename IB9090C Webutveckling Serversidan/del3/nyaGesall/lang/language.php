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
	//h�mtar meny-str�ng 
	function getMenuString($message)
	{
		return $this->class->menuString[$message];
	}
	
	//h�mtar en sidas titel
	function getPageTitle($message)
	{
		return $this->class->pageTitle[$message];
	}
	
	//h�mtar titel till en skriven text
	function getTextTitle($message)
	{
		return $this->class->textTitle[$message];
	}
	
	//h�mtar underrubrik till en skriven text
	function getTextSubtitle($message)
	{
		return $this->class->textSubtitle[$message];
	}
	
	//h�mtar text meddelaned i en skriven text
	function getTextMessage($message)
	{
		return $this->class->textMessage[$message];
	}
}
?>