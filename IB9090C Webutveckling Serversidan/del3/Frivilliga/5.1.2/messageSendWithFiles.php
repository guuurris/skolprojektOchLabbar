<?php
header("Content-type: text/plain");
//Vissa f�lt m�ste vara ifyllda f�r att mail ska kunna skickas
if(isset($_POST["from"]) && isset($_POST["reciever"]) && isset($_POST["passwd"]))
{
	// L�senordet f�r att skicka ska vara 12344
	if($_POST["passwd"] == "12344")
	{
		$from = $_POST["from"];
		$to = $_POST["reciever"];
		$subject = $_POST["title"];
		$message = $_POST["message"];
		$message .="\nObservera! Detta meddelande �r s�nt fr�n ett formul�r p� Internet och avs�ndaren kan vara felaktig!";
		
		$header = "From: $from";
		// Finns det n�gon BCC ?
		if($_POST["BCC"] != "")
		{
			$header .="\r\nBcc: " . $_POST["BCC"];
		}
		
		//Finns det n�got CC ?
		if($_POST["CC"] != "")
		{
			$header  .= "\r\nCc: " . $_POST["CC"] ;
		}
		
		$header  .= "\r\n";

		$uid = md5(uniqid(time()));

		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
		$header .= "--".$uid."\r\n";
		
		$header .= "Content-type:text/plain; charset=iso-8859-1\r\n"; // Mail klienterna verkar inte st�dja utf-8
		$header .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
		$header .= $message."\r\n\r\n";
		
		//L�gger till fil efter fil till headern
		for($x = 0; $x < count($_FILES["file"]["name"]); $x++)
		{
			if($_FILES["file"]["name"][$x] != "")
			{
				
				$fileatt      = $_FILES['file']['tmp_name'][$x];
				$fileatt_type = $_FILES['file']['type'][$x];    
				$fileatt_name = $_FILES['file']['name'][$x];
				$content = chunk_split(base64_encode(file_get_contents($fileatt)));
				
				$header .= "--".$uid."\r\n";
				$header .= "Content-Type: application/octet-stream; name=\"".$fileatt_name."\"\r\n";
				$header .= "Content-Transfer-Encoding: base64\r\n";
				$header .= "Content-Disposition: attachment; filename=\"".$fileatt_name."\"\r\n\r\n";
				$header .= $content."\r\n\r\n";
				
			}
		}

		// Om meddelandet lyckas skickas
		if(mail($to,$subject,"",$header))
		{
			echo "Mail to: " . $to .  " was sent\n";
			echo "With subject: ". $subject;
			echo "\nMessage: " . $message ;
			// Loppar och skriver ut information om filer som skickats tillsammans med meddelandet
			for($x = 0; $x < count($_FILES["file"]["name"]); $x++)
			{
				if($_FILES["file"]["name"][$x] != "")
				{
					$atnr = $x+1;
					echo "\n\nAttachment". $atnr  . "\n";
					echo "Attachment type: " . $_FILES['file']['type'][$x] . "\n";
					echo "File name: " . $fileatt_name = $_FILES['file']['name'][$x] . "\n";
					echo "Size: " . $fileatt_name = $_FILES['file']['size'][$x]/1000 . "KB";
				}
			}
		}
		// Om anv�ndaren inte mattat in tillr�ckligt med information
		else
		{
				echo "Failed to send mail!";
		}	
	}
}
?>