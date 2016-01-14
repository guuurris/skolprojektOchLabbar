<?php 
	addRecipe();
	
	function addRecipe()
	{
		
		if(isset($_POST['namn_ratt']) and isset($_POST['namn_ratt']) and
		isset($_POST['namn_ratt']) and  isset($_POST['namn_ratt']) and
		isset($_POST['namn_ratt']) and isset($_POST['namn_ratt']) and
		isset($_POST['procedure']) and isset($_POST['description']) 	)
		{
			echo "Rätt:" . $_POST['namn_ratt'];
			echo "<br/>";
			echo "Kategori:" . $_POST['category'];
			echo "<br/>";
			echo "Tillagningstid:" . $_POST['Tillagningstid'];
			echo "<br/>";
			echo "Serveringsmangd_antal:" . $_POST['Serveringsmangd_antal'];
			echo "<br/>";
			echo "Serveringsmangd_enhet:" . $_POST['Serveringsmangd_enhet'];
			echo "<br/>";
			echo "Svarighet:" . $_POST['Svarighet'];
			echo "<br/>";
			
			$query = insertNewFoodQuery($_POST['namn_ratt'], $_POST['category'],$_POST['Svarighet'],$_POST['Tillagningstid'], $_POST['description'], $_POST['procedure']);

			$id = executeInsertQuery($query);
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
					if( !empty($_POST['Ingrediens'][0][$i]) )
					{
						if($id > 0)
						{
							$query = insertIngredientForFoodByIdQuery( $id, $_POST['Ingrediens'][0][$i] , $_POST['Ingrediens'][1][$i], $_POST['Ingrediens'][2][$i]);
							executeInsertQuery($query);
							echo "<br/>"; 
							echo "Ingrediens nr $i <br/>"; 
							echo "Namn: " . $_POST['Ingrediens'][0][$i] ."<br/>"; 
							echo "Mängd: " . $_POST['Ingrediens'][1][$i]."<br/>"; 
							echo "Måttenhet: " . $_POST['Ingrediens'][2][$i] ."<br/>"; 
							echo "<br/>"; 
						} 
					}
				}

			}
			checkForRecipeImage();
			
		}
		else 
		{
			echo "Invalid form!";
		}
	}
	
	//Koden i funktionen verkar inte fungera som det ska eller så tillåts vi inte att ladda upp filer på skolans server genom php.
	function checkForRecipeImage()
	{
		/*if(isset($_FILES["img"]["name"]))
		{	
			echo "Image added:<br/>";
			echo "Upload: " . $_FILES["img"]["name"] . "<br/>";
			echo "Type: " . $_FILES["img"]["type"] . "<br/>";
			echo "Size: " . ($_FILES["img"]["size"] / 1024) . " kB<br/>";
			echo "Stored in: " . $_FILES["img"]["tmp_name"];
		}*/
		
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["img"]["name"]);
		$extension = end($temp);
		if ((($_FILES["img"]["type"] == "image/gif")
		|| ($_FILES["img"]["type"] == "image/jpeg")
		|| ($_FILES["img"]["type"] == "image/jpg")
		|| ($_FILES["img"]["type"] == "image/pjpeg")
		|| ($_FILES["img"]["type"] == "image/x-png")
		|| ($_FILES["img"]["type"] == "image/png"))
		&& ($_FILES["img"]["size"] < 1000000)
		&& in_array($extension, $allowedExts))
		  {
		  if ($_FILES["img"]["error"] > 0)
			{
			echo "Return Code: " . $_FILES["img"]["error"] . "<br>";
			}
		  else
			{
			echo "Upload: " . $_FILES["img"]["name"] . "<br>";
			echo "Type: " . $_FILES["img"]["type"] . "<br>";
			echo "Size: " . ($_FILES["img"]["size"] / 1024) . " kB<br>";
			echo "Temp file: " . $_FILES["img"]["tmp_name"] . "<br>";

			if (file_exists("../image/" . $_FILES["img"]["name"]))
			  {
			  echo $_FILES["img"]["name"] . " already exists. ";
			  }
			else
			  {
			  move_uploaded_file($_FILES["img"]["tmp_name"],
			   $_FILES["img"]["name"]);
			  echo "Stored in: " . "../image/" . $_FILES["img"]["name"];
			  }
			}
		  }
		else
		  {
		  echo "Invalid file";
		  }
	}
	
	function insertNewFoodQuery($name, $category,$level,$cookingT, $desc, $proce)
	{
		// The SQL query	
		$query = "INSERT INTO Food(name, difficulty, cookingTime, description, xprocedure, category_id, added) " . 
				"SELECT '$name',$level , $cookingT ,'$desc','$proce', id , CURRENT_TIMESTAMP " .
				"FROM Category WHERE name='$category'";	
		return $query;
	}
	
	function insertIngredientForFoodByIdQuery($foodId,$name, $amount, $measureUnit)
	{
		// The SQL query	
		$query = "INSERT INTO Ingredient(name, quanity, measureUnit, food_id) " . 
				"VALUES( '$name',$amount ,'$measureUnit', $foodId)";
		return $query;
	}
	
	function executeInsertQuery($query)
	{
		$link = mysqli_connect('localhost', 'wiiala', 'wiiala-xmlpub13', 'wiiala');
		
		if(mysqli_query($link, $query))
		{
			echo "Success" . mysqli_affected_rows($link) . " row";
		}
		else 
		{
			echo "Row doesn't work: SQL ['$query']" ;
		}
		
		return mysqli_insert_id($link);
	}
?>