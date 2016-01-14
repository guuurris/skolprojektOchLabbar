<?php 

//TODO generera resultat xml baserat på valda ingredienser osv
//TODO generera visnings xml i kategori center för att visa ett detaljerat enskilt recept eller preview 
	
	//Klass som kan generera xml för vår hemsida 	
	class xmlGen
	{
		public $user;
		public $xmlStr="";
		public $centerpagetype;
		public $ingredientList = array("Milk","Water","Meat","Flour"); 
		
		function __construct($centerpagetype, $userid=null)
		{
			$this->centerpagetype = $centerpagetype;
			$this->user = $userid;
			$this->generateXMLForAllIngrediensTypes();
			$this->xmlStr .= $this->generateXMLForAllCategoryTypes();
			
			//Om inloggad användare så generera xml som baseras på hans kategori premurationer
			if($userid!=null)
			{
				$this->xmlStr .= "<user id='".$this->user."'/> &#10;";
				$this->xmlStr .= $this->generateXMLForLeftorRightColm('right');
			}
			$this->xmlStr .= $this->generateXMLForLeftorRightColm('left');
			
		}
		
		function getGeneratedXML()
		{
			return $this->xmlStr;
		}
		
		//SQL frågan som hämtar alla tillgängla kategorier
		function getAllCategories()
		{
			return $query = "SELECT name FROM Category";
		}
		
		
		
		//SQL frågan för att hämta senaste rätterna som användare prenemurerar på.
		function getSubscribedContentByUsernameQuery()
		{
			// The SQL query
			$query = "SELECT Food.id as identifier, ". 
						"Food.name as food_name, ".
						"difficulty, ".
						"cookingTime, ".
						"description, ".
						"xprocedure, ".
						"urlToImage, ".
						"added ".
						"FROM Food ".
						"INNER JOIN Category ON Food.category_id=Category.id ".
						"INNER JOIN CategorySubscription ON Category.id=CategorySubscription.category_id ".
						"WHERE user_id='".$this->user."' ORDER BY added DESC";
			return $query;
		}
		//Hämtar ingrediens för en maträtt
		function getFoodIngrediensByFoodId($id)
		{
			return $query = "SELECT name, quanity, measureUnit FROM Ingredient WHERE food_id=".$id;
		}

		//SQL frågan för att hämta senaste tillagda rätterna från databasen.
		function getLatestAddedRecipes($nrOfResults)
		{
			return $query = "SELECT id as identifier, name as food_name, difficulty, cookingTime, description, xprocedure, urlToImage, added FROM Food ORDER BY added DESC LIMIT ".$nrOfResults;
		}

		//Kör sql query och ger tillback resultset
		function executeQuery($query)
		{
			$link = mysqli_connect('localhost', 'wiiala', 'wiiala-xmlpub13', 'wiiala');
			if (($result = mysqli_query($link, $query)) === false) 
			{
						   printf("Query failed: %s<br />\n%s", $query, mysqli_error($link));
						   exit();
			}
			return $result;
		}

		function generateXMLForAllCategoryTypes()
		{
			$query = $this->getAllCategories();
			$result = $this->executeQuery($query);
			$returnstring = "";
			 while ($line = $result->fetch_object()) 
			 {
				// Store results from each row in variables
				$name = $line->name;
				$returnstring .= "<category position='none'> &#10;";
						$returnstring .= "<name>";
							$returnstring .= $name;
						$returnstring .= "</name> &#10;";
				$returnstring .= "</category> &#10;";
			 }
			 mysqli_free_result($result);
			 return $returnstring;
			
		}
		
		function generateXMLForAllIngrediensTypes()
		{
			
			foreach($this->ingredientList as $ingredient)
			{
				$this->xmlStr .= "<ingredient> &#10;";
					$this->xmlStr .= "<name>";
						$this->xmlStr .= $ingredient;
					$this->xmlStr .= "</name> &#10;";	
				$this->xmlStr .= "</ingredient> &#10;";
			}
			
			
		}
		
		/*Vet inte än hur många typer av funktioner som behövs för att skapa en bra xml generering för centern*/
		function generateXMLInCenter()
		{
			if($this->centerpagetype == "newRecipe")
			{
			
			}
			if($this->centerpagetype == "previewRecipe")
			{
			
			}
			if($this->centerpagetype == "addCategory")
			{
			
			}
			if($this->centerpagetype == "searchRecipe" ||  $this->centerpagetype == "index")
			{
			
			}
			if($this->centerpagetype == "showRecipe")
			{
			
			}
		}
			
		//Genererar xml element för ingredienser, tar emot matens id
		function generateXMLStrForIngredients($food_id)
		{
			$query = $this->getFoodIngrediensByFoodId($food_id);
			$result = $this->executeQuery($query);
			$returnstring = "";
			 while ($line = $result->fetch_object()) 
			 {
				// Store results from each row in variables
				$name = $line->name;
				$quanity = $line->quanity;
				$measureUnit = $line->measureUnit;

				$returnstring .= "<ingredient> &#10;";
						$returnstring .= "<name>";
							$returnstring .= $name;
						$returnstring .= "</name> &#10;";
						$returnstring .= "<quantity measureUnit='".$measureUnit."'>";
							$returnstring .= $quanity;
						$returnstring .= "</quantity> &#10;";	
				$returnstring .= "</ingredient> &#10;";
			 }
			 mysqli_free_result($result);
			 return $returnstring;
		}

		//Genererar xml food element, tar emot de viktiga informationen som behövs för under element osv.
		function generateXMLForFood($id, $name, $difficulty, $CookingTime, $Description, $Procedure ,$urlToImage ,$added)
		{
			//TODO få ut added informationen också 
			
				$returnstring = "<food> &#10; ";

					$returnstring .= "<name>";
						$returnstring .= "$name";
					$returnstring .= "</name> &#10; ";
					
					$returnstring .= "<difficulty>";
						$returnstring .= "$difficulty";
					$returnstring .= "</difficulty> &#10;";
					
					$returnstring .= "<cookingTime>";
						$returnstring .= "$CookingTime";
					$returnstring .= "</cookingTime> &#10;";
					
					$returnstring .= "<description>";
						$returnstring .= "$Description";
					$returnstring .= "</description> &#10;";
					
					$returnstring .= "<procedure>";
						$returnstring .= "$Procedure";
					$returnstring .= "</procedure> &#10;";
					
					$returnstring .= "<image>";
						$returnstring .= "$urlToImage";
					$returnstring .= "</image> &#10;";
					
					//Ingredienser spottas ut!
					$returnstring .= $this->generateXMLStrForIngredients($id);
						
				$returnstring .= "</food> &#10;";
			
			return $returnstring;
		}

		//Genererar xml struktur för columen av typen left eller right, (left) vilket är de senaste tillagda recepten i databasen eller (right) vilket är de senaste premurationerna som ska visas för användaren.
		function generateXMLForLeftorRightColm($coltype , $nrOfResults=5)
		{
			if($coltype == "left")
			{
				$query = $this->getLatestAddedRecipes($nrOfResults);
			}
			else if($coltype == "right")
			{
				$query = $this->getSubscribedContentByUsernameQuery(); 
			}
			$result = $this->executeQuery($query);
			
			$returnstring = "<category position='".$coltype."'> &#10;";
			
			// Loppa ut resultat från query
			while ($line = $result->fetch_object()) {
				// Spara temporärt det som databasen ger tillbacka
				$id = $line->identifier;
				$name = $line->food_name;
				$difficulty = $line->difficulty;
				$CookingTime = $line->cookingTime;
				$Description = $line->description;
				$Procedure = $line->xprocedure;
				$urlToImage = $line->urlToImage;
				$added = $line->added;
				
				$returnstring .= $this->generateXMLForFood($id, $name, $difficulty, $CookingTime, $Description, $Procedure ,$urlToImage ,$added);
			}
			$returnstring .= "</category> &#10;";
			// släpp mysql resurserna
			mysqli_free_result($result);
			return $returnstring;
			
		}
	}
?>