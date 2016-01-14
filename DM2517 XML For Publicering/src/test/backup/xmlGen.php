<?php 

//TODO generera resultat xml baserat på valda ingredienser osv
//TODO (delvis gjord eller avklarad?) generera visnings xml i kategori center för att visa ett detaljerat enskilt recept eller preview 
	
	//Klass som kan generera xml för hemsidan Xrecipe	
	class xmlGen
	{
		public $user;
		public $xmlStr="";
		public $centerpagetype;
		
		//Hårdkodad ingredienslista över de ingredienser som man kan välja emellan
		public $ingredientList = array("Milk","Water","Meat","Flour","Salt","Onion","fish fillet"); 
		
		function __construct($centerpagetype,$food_values, $userid=null)
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
			$this->generateXMLInCenter($food_values);
			
			//TODO för addCategory: berätta vilka kategorier som är valda för tillfället
		}
		
		function getGeneratedXML()
		{
			return $this->xmlStr;
		}
		
/********************SQL Queries nedanför********************/
		
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

		
		function getFoodById($id)
		{
			return $query = "SELECT id as identifier, name as food_name, difficulty, cookingTime, description, xprocedure, urlToImage, added, portions, portionType FROM Food WHERE id=".$id;
		}
		
/********************SQL Queries ovanför********************/
		
		
		//Kör sql query och ger tillback resultset
		function executeQuery($query)
		{
			$link = mysqli_connect('mydb17.surf-town.net', 'kribba_kthproj', 'pr0ject', 'kribba_kthproj');
			if (($result = mysqli_query($link, $query)) === false) 
			{
						   printf("Query failed: %s<br />\n%s", $query, mysqli_error($link));
						   exit();
			}
			return $result;
		}

		//Genererar xml element för samtliga categorier som hittas i databasen
		function generateXMLForAllCategoryTypes()
		{
			$query = $this->getAllCategories();
			$result = $this->executeQuery($query);
			$returnstring = "";
			 while ($line = $result->fetch_object()) 
			 {
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
		function generateXMLInCenter($food_values=null)
		{
		//<!ELEMENT food (name, difficulty, cookingTime, description, procedure, image+, ingredient+, added)>
		//<!ELEMENT ingredient (name, quantity?)>

				if($this->centerpagetype == "newRecipe" || $this->centerpagetype == "previewRecipe" || $this->centerpagetype == "showRecipe")
				{
					//Om en id till receptet (food) togs emot 
					if(isset($food_values['identifier']))
					{
						$this->xmlStr .= "<category position='center' site='".$this->centerpagetype."'> &#10;";
							$this->xmlStr .= $this->generateXMLForFoodById($food_values['identifier']);
						$this->xmlStr .= "</category> &#10;";
					}
					
					elseif(isset($food_values['searchRecipe']))
					{
						$this->xmlStr .= "<category position='center' site='".$this->centerpagetype."'> &#10;";
						  $this->xmlStr .= "<name>";
									$this->xmlStr .= $food_values['category'];
						  $this->xmlStr .= "</name> &#10;";
						  
						  $this->xmlStr .= "<food> &#10; ";

							$this->xmlStr .= "<name>";
								$this->xmlStr .= $food_values['name'];
							$this->xmlStr .= "</name> &#10; ";
							
							$this->xmlStr .= "<difficulty>";
								$this->xmlStr .= $food_values['difficulty'];
							$this->xmlStr .= "</difficulty> &#10;";
							
							$this->xmlStr .= "<cookingTime>";
								$this->xmlStr .= $food_values['cookingTime'];
							$this->xmlStr .= "</cookingTime> &#10;";
							
							$this->xmlStr .= "<description>";
								$this->xmlStr .= $food_values['description'];
							$this->xmlStr .= "</description> &#10;";
							
							$this->xmlStr .= "<procedure>";
								$this->xmlStr .= $food_values['procedure'];
							$this->xmlStr .= "</procedure> &#10;";
							
							$this->xmlStr .= "<image>";
								$this->xmlStr .= "";
							$this->xmlStr .= "</image> &#10;";
							
							if(isset($food_values['ingredient']))
							{
							$c = count($food_values['ingredient']);
							for($i=0;$i<$c; $i++)
							{
								if( !empty($food_values['ingredient'][$i]) )
								{								
									$this->xmlStr .= "<ingredient> &#10;";
										$this->xmlStr .= "<name>";
											$this->xmlStr .= $food_values['ingredient'][$i];
										$this->xmlStr .= "</name> &#10;";
									$this->xmlStr .= "</ingredient> &#10;";
			 
								}
							}
							}
								
							$this->xmlStr .= "<added>";
								$this->xmlStr .= "";
							$this->xmlStr .= "</added> &#10;";
							
						  $this->xmlStr .= "</food> &#10;";
						
						$this->xmlStr .= "</category> &#10;";
					}
					
					//Om vi tog emot alla delarna av receptet (food), recept som inte existerar i databasen än!
					else
					{
						$this->xmlStr .= "<category position='center' site='".$this->centerpagetype."'> &#10;";
						  $this->xmlStr .= "<name>";
									$this->xmlStr .= $food_values['category'];
						  $this->xmlStr .= "</name> &#10;";
						  
						  $this->xmlStr .= "<food> &#10; ";

							$this->xmlStr .= "<name>";
								$this->xmlStr .= $food_values['name'];
							$this->xmlStr .= "</name> &#10; ";
							
							$this->xmlStr .= "<difficulty>";
								$this->xmlStr .= $food_values['difficulty'];
							$this->xmlStr .= "</difficulty> &#10;";
							
							$this->xmlStr .= "<cookingTime>";
								$this->xmlStr .= $food_values['cookingTime'];
							$this->xmlStr .= "</cookingTime> &#10;";
							
							$this->xmlStr .= "<description>";
								$this->xmlStr .= $food_values['description'];
							$this->xmlStr .= "</description> &#10;";
							
							$this->xmlStr .= "<procedure>";
								$this->xmlStr .= $food_values['procedure'];
							$this->xmlStr .= "</procedure> &#10;";
							
							$this->xmlStr .= "<image>";
								$this->xmlStr .= $food_values['image'];
							$this->xmlStr .= "</image> &#10;";
							
							
							$c = count($food_values['ingredient']);
							for($i=0;$i<$c; $i++)
							{
								if( !empty($food_values['ingredient'][0][$i]) )
								{								
									$this->xmlStr .= "<ingredient> &#10;";
										$this->xmlStr .= "<name>";
											$this->xmlStr .= $food_values['ingredient'][0][$i];
										$this->xmlStr .= "</name> &#10;";
										$this->xmlStr .= "<quantity measureUnit='".$food_values['ingredient'][2][$i]."'>";
											$this->xmlStr .= $food_values['ingredient'][1][$i];
										$this->xmlStr .= "</quantity> &#10;";
									$this->xmlStr .= "</ingredient> &#10;";
			 
								}
							}
								
							$this->xmlStr .= "<added>";
								$this->xmlStr .= $food_values['added'];
							$this->xmlStr .= "</added> &#10;";
							
						  $this->xmlStr .= "</food> &#10;";
						
						$this->xmlStr .= "</category> &#10;";
					}
				}
				
				//TODO addCategory kommer spottas ut många ggr en för varje nuvarande vald kategori?
				if($this->centerpagetype == "addCategory" || $this->centerpagetype == "searchRecipe" )
				{
					$this->xmlStr .= "<category position='center' site='".$this->centerpagetype."'> &#10;";
					$this->xmlStr .= "</category> &#10;";
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

		//TODO EJ KLART
		function generateXMLForFoodById($id)
		{
			$query = $this->getFoodById($id);
			$result = $this->executeQuery($query);
			$returnstring = "";
			while ($line = $result->fetch_object()) //ska egentligen alltid bara returnera ett resultat
			{
				//TODO dessa behöver egentligen skickas med
				$portions = $line->portions;
				$portionType = $line->portionType;
				
				$returnstring .= $this->generateXMLForFood($line->identifier,
													$line->food_name,
													$line->difficulty,
													$line->cookingTime, 
													$line->description, 
													$line->xprocedure ,
													$line->urlToImage ,
													$line->added);
			}
			 mysqli_free_result($result);
			 return $returnstring;
		}
		
		//Genererar xml food element, tar emot de viktiga informationen som behövs för under element osv.
		function generateXMLForFood($id, $name, $difficulty, $CookingTime, $Description, $Procedure ,$urlToImage ,$added)
		{	
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
					
					$returnstring  .= "<added>";
						$returnstring  .= $added;
					$returnstring  .= "</added> &#10;";
				
					$returnstring  .= "<id>";
						$returnstring  .= "$id";
					$returnstring  .= "</id> &#10;";
					
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
				
				//TODO portions och portiontype saknas
				
				$returnstring .= $this->generateXMLForFood($id, $name, $difficulty, $CookingTime, $Description, $Procedure ,$urlToImage ,$added);
			}
			$returnstring .= "</category> &#10;";
			// släpp mysql resurserna
			mysqli_free_result($result);
			return $returnstring;
			
		}
	}
?>