<?php 
	echo "Rätt:" . $_POST['namn_ratt'];
	echo "<br/>";
	echo "Tillagningstid:" . $_POST['Tillagningstid'];
	echo "<br/>";
	echo "Serveringsmangd_antal:" . $_POST['Serveringsmangd_antal'];
	echo "<br/>";
	echo "Serveringsmangd_enhet:" . $_POST['Serveringsmangd_enhet'];
	echo "<br/>";
	echo "Svarighet:" . $_POST['Svarighet'];
	echo "<br/>";
	
	/*echo "Ingrediens:" . $_POST['Ingrediens'][0];
	echo "<br/>";
	echo "Ingrediens:" . $_POST['Ingrediens'][1];
	echo "<br/>";*/
	//echo "Antal Ingredienser: " . sizeof($_POST['Ingrediens']);
	//echo "Ingredient: " . $_POST['Ingrediens'][0][0] ."<br/>"; 
	if(isset( $_POST['Ingrediens'] ) )
	{	
		$c = count($_POST['Ingrediens']);
		for($i=0;$i<$c; $i++)
		{
			echo "<br/>"; 
			if( isset($_POST['Ingrediens'][0][$i] ) )
			{
				echo "Ingrediens nr $i <br/>"; 
				echo "Namn: " . $_POST['Ingrediens'][0][$i] ."<br/>"; 
				echo "Mängd: " . $_POST['Ingrediens'][1][$i]."<br/>"; 
				echo "Måttenhet: " . $_POST['Ingrediens'][2][$i] ."<br/>"; 
				echo "<br/>"; 
			
		}

	}
	
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 20000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
       $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
      }
    }
  }
else
  {
  echo "Invalid file";
  }

?>