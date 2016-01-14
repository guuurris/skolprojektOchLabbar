<?php

//Ser efter om n�gon fil tas emot
if(!empty($_FILES["file"]))
{
	//Filen ska vara en bild av vis typ och under en viss storlek
	if((($_FILES["file"]["type"] == "image/png") 
		|| ($_FILES["file"]["type"] == "image/gif")
		||($_FILES["file"]["type"] == "image/jpeg"))
		&&($_FILES["file"]["size"] < 100000000))
	{
		// Om det blir n�got error vid mottagning
		if($_FILES["file"]["error"] > 0)
		{
			echo "Error: " . $_FILES["file"]["error"] . "<br />";
			exit;
		}
		
		
		$tmp_filename = $_FILES["file"]["tmp_name"];
		$name_of_file = $_FILES["file"]["name"];
		//Flytta �ver filen spara kopia p� serverside
		move_uploaded_file($tmp_filename, "upload_files/$name_of_file");
		
		// Om filen �r en png bild 
		if($_FILES["file"]["type"] == "image/png")
		{	
			$image = imagecreatefrompng("upload_files/$name_of_file");
			header( "Content-type: image/png" );
			imagepng( $image );
			imagedestroy($image);
		}
		
		// Om den �r en gif
		else if($_FILES["file"]["type"] == "image/gif")
		{
			header( "Content-type: image/gif" );
			$image = imagecreatefromgif("upload_files/$name_of_file");
			imagegif( $image );
			imagedestroy($image);
		}
		// annars �r det �n jpeg
		else 
		{
			header( "Content-type: image/jpeg" );
			$image = imagecreatefromjpeg("upload_files/$name_of_file");
			imagejpeg( $image );
			imagedestroy($image);
		}
		
	}
	// Om inte huvudkriterierna f�r fil uppfylls visas information om den ist�llet
	else
	{
		echo "Upload: " . $_FILES["file"]["name"] . "<br />";
		echo "Type: " . $_FILES["file"]["type"] . "<br />";
		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		echo "Stored in: " . $_FILES["file"]["tmp_name"];
	}
}	
?> 