<?php
header("Content-type: text/plain");
if(!empty($_POST['usr']) && (   !empty($_POST['passwd']) && ( !empty($_POST['server_addr']) && (!empty($_POST['server_port'])) )   ) )
{
	// To connect to a POP3 server on port 110 on the local server, use:
	//$mbox = imap_open ("'{" . $_POST['server_addr'] . ":" . $_POST['server_port'] . "/pop3}INBOX", "'" . $_POST['usr'] . "'", "'" . $_POST['passwd'] . "'");
	$mbox = imap_open ("{" . $_POST['server_addr'] . ":" . $_POST['server_port'] . "/pop3}INBOX", $_POST['usr'], $_POST['passwd']);
	echo "Connection to: " .  $_POST['server_addr'] . " on port: " . 110 . " was establish\n";
	
	// Nu ska alla mailboxar hämtats och visas för användaren
	$status = imap_status($mbox, "{" . $_POST['server_addr'] . ":" . $_POST['server_port'] . "/pop3}INBOX", SA_ALL);
	if ($status) 
	{
	  $number_of_messages = $status->messages;
	  echo "._______________________.\n";
	  echo "|Messages:   " . $number_of_messages  . " \t|\n";
	  echo "|Recent:     " . $status->recent      . " \t|\n";
	  echo "|Unseen:     " . $status->unseen      . " \t|\n";
	  echo "|UIDnext:    " . $status->uidnext     . " \t|\n";
	  echo "|UIDvalidity:" . $status->uidvalidity . " |\n";
	  echo "|-----------------------|\n\n";
	  $i = 1;
	 
	  while($i <= $number_of_messages)
	  {
		$mail_header = imap_header($mbox, $i); 
		echo "--------------MESSAGE---------------------------\n";
		echo "Message id: " . $mail_header->message_id . "\n" ;
		echo "Subject: " . $mail_header->subject . "\n";
		echo "From: " .$mail_header->fromaddress . "\n";
		echo "Sender: " .$mail_header->senderaddress . "\n";
		echo "Message recieve date: " .$mail_header->date . "\n";
		echo "Size: " .$mail_header->Size . " bytes\n";
		$message_text = imap_body($mbox, $i);
		echo "***************MESSAGE CONTENT START*************\n ";
		echo $message_text. "\n";
		echo "///////////////MESSAGE CONTENT END///////////////\n";
		echo "---------------END OF MESSAGE--------------------\n\n";
		$i++;
	  }
	}
	else 
	{
		echo "imap_status failed: " . imap_last_error() . "\n";
	}

	imap_close($mbox);
}
	
else
	echo "All fields most be non-empty";
?>