<?php 
include 'prefix.php'; ?>
	
<xrecipe>
<?php
	include_once('CAS-1.3.2/CAS.php');
	include 'xmlGen.php';
	session_start();
	
	checkAndSetUserSession();//här sköts in- och utloggnings proceduren
	
	$xml = new xmlGen(siteToDisplay(), getFoodValues(), $_SESSION['user']); 
	$returnstring = $xml->getGeneratedXML();
    print utf8_encode($returnstring);
	
	
	//Loggar in och ut användare, när inloggad så sparas värdet i session-kakan 'user' annars sätts värdet null till kakan.
	function checkAndSetUserSession()
	{
			// store session data
		if(!isset($_SESSION['user']) )
		{
			$_SESSION['user']=null;
		}
		
		if(isset($_REQUEST['login']) or isset($_REQUEST['logout']) ) 
		{
			// initialize phpCAS
			phpCAS::client(CAS_VERSION_2_0,'login.kth.se',443,'');
			//phpCAS::proxy(CAS_VERSION_2_0,'login.kth.se',443,'');
			phpCAS::setNoCasServerValidation();

			// If you want the redirect back from the login server to enter your application by some 
			// specfic URL rather than just back to the current request URI, call setFixedCallbackURL.
			//phpCAS::setFixedCallbackURL('http://xml.csc.kth.se/~wiiala/DM2517/project/php/index.php');

			// force CAS authentication
			phpCAS::forceAuthentication();

			// at this step, the user has been authenticated by the CAS server
			// and the user's login name can be read with phpCAS::getUser().
			$_SESSION['user'] = phpCAS::getUser();
			
			//Logga ut och redirecta till vår standardsida
			if (isset($_REQUEST['logout'])) {
				unset($_SESSION['user']);
				
				phpCAS::logoutWithRedirectService('http://kth.kribba.com/');
			}
		}
	}
	
	//Väljer vilken sida som skall genereras
	function siteToDisplay()
	{
		if( isset($_REQUEST['site']) )
		{
			//inloggad
			if($_SESSION['user'] !=null)
			{
				if($_REQUEST['site'] == "newRecipe")
				{
					return "newRecipe";
				}
				if($_REQUEST['site'] == "previewRecipe")
				{
					return "previewRecipe";
				}
				if($_REQUEST['site'] == "addCategory")
				{
					return "addCategory";
				}
			}
			if($_REQUEST['site'] == "showRecipe")
			{
				return "showRecipe";
			}
			else //visar searchRecipe som default
			{
				return "searchRecipe";
			}
		}
		else
		{
			return "searchRecipe";
		}
		
	}
	
	function checkForRecipeImage()
	{
		 $food_values['image'] = "";
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
			//echo "Return Code: " . $_FILES["img"]["error"] . "<br>";
			}
		  else
			{
			$c=1;
			$old_name = $_FILES["img"]["name"];
			while (file_exists("./temp_image/" . $_FILES["img"]["name"]))
			  {					
				$_FILES["img"]["name"] =  substr($old_name, 0, strlen($old_name) - strlen(pathinfo($old_name,PATHINFO_EXTENSION)) - 1)
					. $c . "." 
					. pathinfo($old_name,PATHINFO_EXTENSION);
				$c++;
			  }
			
			  
			    move_uploaded_file($_FILES["img"]["tmp_name"],
			   "./temp_image/".$_FILES["img"]["name"]);
			   $food_values['image'] = "./temp_image/".$_FILES["img"]["name"];
			  //echo "Stored in: " . "../image/" . $_FILES["img"]["name"];
			  
			}
		  }
		  return  $food_values['image'];
		
	}
	
	
	//Behandlar det som html formulär skickar genom exempelvis nytt recept formuläret
	//returnera null om inga värden togs emot annars information om en maträtt 
	function getFoodValues()
	{
		$food_values = null;
		
		if(isset($_SESSION['food']))
		{
			//testa om användare tryckte på ångra eller Spara Recept if(
			$food_values =  $_SESSION['food'];
			//
			if(isset($_REQUEST['saveRecipe']))
			{
				$food_values['save'] = "save";
				unset($_SESSION['food']);
			}
			else if(isset($_REQUEST['changeRecipe']))
			{
				$food_values['reverse'] = "reverse";
				unset($_SESSION['food']);
			}
			//$food_values['saveOrReverseRecipe'] = "save";
			
		}
		
		elseif(isset($_POST['namn_ratt']) and isset($_POST['namn_ratt']) and
		isset($_POST['namn_ratt']) and  isset($_POST['namn_ratt']) and
		isset($_POST['namn_ratt']) and isset($_POST['namn_ratt']) and
		isset($_POST['procedure']) and isset($_POST['description']) 	)
		{
			$food_values['category'] = $_POST['category'];
			$food_values['name'] = $_POST['namn_ratt'];
			$food_values['difficulty'] = $_POST['Svarighet'];
			$food_values['cookingTime'] = $_POST['Tillagningstid'];
			$food_values['description'] = $_POST['description'];
			$food_values['procedure'] = $_POST['procedure'];
			//$food_values['image'] = ""; //TODO fixa till
			$food_values['image'] = checkForRecipeImage();
			$food_values['added'] = "2013-12-04" ; //TODO fixa till
			$food_values['portions'] = $_POST['Serveringsmangd_antal'];
			$food_values['portionType'] = $_POST['Serveringsmangd_enhet'];
			//TODO lägg till portions och portiontype
			if(isset( $_POST['Ingrediens'] ) )
			{	
				$food_values['ingredient'] = $_POST['Ingrediens'];
			}
			if(isset($_SESSION['food']))
			{
				//ta bort sessions bilden 
				//TODO ta bort bild från server
			}
			$_SESSION['food'] = $food_values;
		}
		
		
		//Användare vill visa recept efter food id, klicka på ett recept
		elseif(isset($_REQUEST['site']) and isset($_REQUEST['byId']))
		{
			$food_values['identifier'] = $_REQUEST['byId'];
		}
		
		elseif(isset($_POST['searchRecipe'] ))
		{
			$food_values['searchRecipe'] = true;
			if(isset($_POST['sok_kategori']) and isset($_POST['Tillagningstid']) and
				isset($_POST['Svarighet']) and  isset($_POST['har_bild']))
			{
				$food_values['category'] = $_POST['sok_kategori'];
				$food_values['cookingTime'] = $_POST['Tillagningstid'];
				$food_values['difficulty'] = $_POST['Svarighet'];
				
				$food_values['has_image'] = $_POST['har_bild'];

			}
			
			
			$food_values['name'] = "";
			$food_values['description'] = "ff";
			$food_values['procedure'] = "aadad";
			
			if(isset( $_POST['Ingrediens'] ) )
			{	
				$food_values['ingredient'] = $_POST['Ingrediens'];
			}
		}
		
		
		/*elseif(isset($_REQUEST['submit']))
		{
			if($_REQUEST['submit'] == "Visa")
			{
				$food_values['searchRecipe'] = true;
			}
		}*/
		return $food_values;
	}
	
?>
</xrecipe>

<?php include 'postfix.php';?>