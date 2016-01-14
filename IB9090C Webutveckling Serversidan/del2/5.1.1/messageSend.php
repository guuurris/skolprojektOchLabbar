<?php
if(isset($_POST["from"]) && isset($_POST["reciever"]) && isset($_POST["passwd"]))
{
	if($_POST["passwd"] == "12344")
	{
		$from = $_POST["from"];
		$to = $_POST["reciever"];
		$subject = $_POST["title"];
		$message = $_POST["message"];
		$message .="\nObservera! Detta meddelande är sänt från ett formulär på Internet och avsändaren kan vara felaktig!";

		$headers = "From: $from";

		if($_POST["BCC"] != "")
		{
			$headers .="\r\nBcc: " . $_POST["BCC"];
		}
		
		if($_POST["CC"] != "")
		{
			$headers  .= "\r\nCc: " . $_POST["CC"] ;
		}
		
		mail($to,$subject,$message,$headers);
		echo "Mail to: " . $to .  " was sent";
	}
}

?>
