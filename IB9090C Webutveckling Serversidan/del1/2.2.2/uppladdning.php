<?php

//Ser efter om någon fil tas emot
if(!empty($_FILES["file"]))
{
	//Filen ska vara en bild av vis typ och under en viss storlek
	if((($_FILES["file"]["type"] == "image/png") 
		|| ($_FILES["file"]["type"] == "image/gif")
		||($_FILES["file"]["type"] == "image/jpeg"))
		&&($_FILES["file"]["size"] < 100000000))
	{
		// Om det blir något error vid mottagning
		if($_FILES["file"]["error"] > 0)
		{
			echo "Error: " . $_FILES["file"]["error"] . "<br />";
			exit;
		}
		
		
		$tmp_filename = $_FILES["file"]["tmp_name"];
		$name_of_file = $_FILES["file"]["name"];
		//Flytta över filen spara kopia på serverside
		move_uploaded_file($tmp_filename, "upload_files/$name_of_file");
		
		// Om filen är en png bild 
		if($_FILES["file"]["type"] == "image/png")
		{	
			$image = imagecreatefrompng("upload_files/$name_of_file");
			header( "Content-type: image/png" );
			imagepng( $image );
			imagedestroy($image);
		}
		
		// Om den är en gif
		else if($_FILES["file"]["type"] == "image/gif")
		{
			header( "Content-type: image/gif" );
			$image = imagecreatefromgif("upload_files/$name_of_file");
			imagegif( $image );
			imagedestroy($image);
		}
		// annars är det än jpeg
		else 
		{
			header( "Content-type: image/jpeg" );
			$image = imagecreatefromjpeg("upload_files/$name_of_file");
			imagejpeg( $image );
			imagedestroy($image);
		}
		
	}
	// Om inte huvudkriterierna för fil uppfylls visas information om den istället
	else
	{
		echo "Upload: " . $_FILES["file"]["name"] . "<br />";
		echo "Type: " . $_FILES["file"]["type"] . "<br />";
		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		echo "Stored in: " . $_FILES["file"]["tmp_name"];
	}
}	
?> 