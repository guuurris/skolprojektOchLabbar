function validateForm()
{
 var f=document.forms["createRecipe"];
 var p=document.getElementById("varning");

	if(f["namn_ratt"].value==null || 
	   f["namn_ratt"].value=="" || 
	   f["category"].value=="" ||
	   f["beskrivning"].value==null || 
	   f["beskrivning"].value=="" || 
	   f["procedur"].value==null || 
	   f["procedur"].value=="" || 
	   f["namn_ratt"].value=="(på rätten)")
	{
		p.innerHTML="Samtliga fält måste vara korrekt ifyllda"
		return false;
	}
	
	
	var ingredientAttributes=f.getElementsByTagName("select");
	
	for (var i=0;i<ingredientAttributes.length;i++)
	{
		if(ingredientAttributes[i].value == "")
		{
			p.innerHTML="Samtliga fält måste vara korrekt ifyllda"
			return false;
		}
	}

   return true;
}

function clear_input(toClear)
{
	toClear.value = "";
}

//Testar ingrediensrad, anropar andra metoder vid behov
function checkIngredientRow(element)
{
	var ingredientAttributes=element.getElementsByTagName("select");
	
	var newRow = true;
	for (var i=0;i<ingredientAttributes.length;i++)
	{
		if(ingredientAttributes[i].value == "")
		{
			newRow = false;
			break;
		}
	}
	if(newRow)
	{
		var copy = element.getElementsByTagName("tr")[1].cloneNode(true);
		addIngredientRow(copy);
	}
}
//Tar bort en ingrediensrad
function eraseRow(element)
{
	var row = element.parentNode.parentNode;
	var nrRows = document.getElementById("ingredientAdd").getElementsByTagName("tr").length;
	if(nrRows > 2)
	{	row.parentNode.removeChild(row);
	}
}
//Lägger till en rad för att specifiera en ingrediens som bygger på innehållet av värde
function addIngredientRow(element)
{
	var table=document.getElementById("ingredientAdd");
	//TODO ta bort möjligheten att välja samma Ingrediens flera gånger genom att ta bort den valmöjligheten
	table.appendChild(element);
}