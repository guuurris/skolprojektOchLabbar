<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns="http://www.w3.org/1999/xhtml">
<xsl:output method="html" indent="yes"/>

<xsl:template match="xrecipe">
<html>
<head>
<!-- OBS, soek pa NEEDLINK for att hitta tomma lankar -->
 <!-- OBS, iexplorer visar ingenting utan nedanstående funktionsdeklarering, digger function nedan -->
<script src="recipe.js">
function clear_input(toClear)
{
	toClear.value = "";
}
</script>
	<meta http-equiv="content-type" content="text/html" charset="utf-8" />
	<title>Xrecipe</title>
	<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="header">
		<h1><a href="?site=searchRecipe">XRecipe</a></h1>
		<xsl:choose>
			<xsl:when test="user">
				<h2><a href="?logout">Du Ã¤r inloggad(tryck fÃ¶r att logga ut)</a></h2>
			</xsl:when>
			<xsl:otherwise>
				<h2><a href="?login">Du Ã¤r inte inloggad(tryck fÃ¶r att logga in)</a></h2>
			</xsl:otherwise>
		</xsl:choose>
	</div>
	<div id="content">
			<xsl:apply-templates select="category[@position = 'left']"/>
			<xsl:apply-templates select="category[@position = 'center' and @site = 'addCategory']"/>
			<xsl:apply-templates select="category[@position = 'center' and @site = 'showRecipe']"/>
			<xsl:apply-templates select="category[@position = 'center' and @site = 'newRecipe']"/>
			<xsl:apply-templates select="category[@position = 'center' and @site = 'searchRecipe']"/>
			<xsl:apply-templates select="category[@position = 'center' and @site = 'previewRecipe']"/>
			<xsl:apply-templates select="category[@position = 'right']"/>
		<div style="clear: both;"/>
	</div>
	<div id="footer">
		<p>Copyright; 2013 XRecipe. Designed by K.Orellana and G.Wiiala</p>
	</div>
</body>
</html>	
</xsl:template>

<!-- skapar vansterkolumn -->
<xsl:template match="category[@position = 'left']">
	<div id="colOne">
	<br/><br/>
	<h3>Senaste tillagda recepten</h3><br/>
		<xsl:apply-templates select="food" />
	</div>
</xsl:template>

<!-- Skapar grund for showRecipe sidan -->
<xsl:template match="category[@position ='center' and @site = 'showRecipe']">
	<div id="colTwo">
		<table align="center" width="60%" class="noshow">
			<tr>
			<xsl:choose>
				<xsl:when test="../user">
					<td align="center" width="50%"><a href="?site=newRecipe">Nytt recept</a></td>
				</xsl:when>
				<xsl:otherwise>
					<td align="center" width="50%"></td>
				</xsl:otherwise>
			</xsl:choose>
				<td align="center" width="50%"><a href="?site=searchRecipe">SÃ¶k recept</a></td>
			</tr>
		</table>
		<p>
		<h2 align="center"><xsl:value-of select="./food/name" /></h2>
		</p>
		<div style="width:250;align:right;padding:8px;float:right;color:black;">
		<img width="250px">
		<xsl:attribute name="src">
			<xsl:value-of select="./food/image" />
		</xsl:attribute>
		</img><br/>
			SvÃ¥righet: <b><xsl:value-of select="./food/difficulty"/></b> (5)<span> |</span> Tillagningstid ca: <b><xsl:value-of select="./food/cookingTime"/></b> min
		</div>
		<p>
			<h3>Ingredienser:</h3>
			<br/>
			<ul>
				<xsl:apply-templates select="./food/ingredient" mode="A" />
			</ul>
		</p>
		<p>
			<br/><h3>Beskrivning:</h3><br/>
			<p>
				<xsl:value-of select="./food/description" />
			</p>
			<p>
			<br/><h3>Procedur:</h3><br/>
			</p>
			<p>
				<xsl:value-of select="./food/procedure" />
			</p>
		</p>
	</div>
</xsl:template>

<!-- Grund for addCategory sidan -->
<xsl:template match="category[@position = 'center' and @site = 'addCategory']">
	<div id="colTwo">
		<table align="center" width="60%" class="noshow">
			<tr>
			<xsl:choose>
				<xsl:when test="../user">
					<td align="center" width="50%"><a href="?site=newRecipe">Nytt recept</a></td>
				</xsl:when>
				<xsl:otherwise>
					<td align="center" width="50%"></td>
				</xsl:otherwise>
			</xsl:choose>
				<td align="center" width="50%"><a href="?site=searchRecipe">SÃ¶k recept</a></td>
			</tr>
		</table>
		<center><p><h2> Vilka recept vill du prenumerera pÃ¥? </h2></p></center>
		<form name="prenumerate" action="NEEDLINK" method="post" id="prenumform">
			<div style="width:50%;float:left;" class="mobile"><br/>
			
			<!-- TODO: Lagg till stt det skrivs ut i tva kolumner, if sats finns i templaten -->
				<xsl:apply-templates select="../category[@position = 'none']" mode="list"/>
			</div>
			<div style="width:50%;float:right;" class="mobile">
				<br/><input type="submit" value="Skicka" />
			</div>
		</form>
	</div>
</xsl:template>

<!-- skapar hogerkolumn -->
<xsl:template match="category[@position ='right']">
	<div id="colThree">
	<xsl:choose>
		<xsl:when test="../user">
			<h3>Rekommenderade for dig, baserade pÃ¥ dina prenumerationer</h3>
			<xsl:apply-templates select="food" />
		</xsl:when>
		<xsl:otherwise>
		</xsl:otherwise>
	</xsl:choose>
	<br/>
	<center><a href="?site=addCategory">LÃ¤gg till/Ã¤ndra prenumerationer</a></center>
	</div>
  </xsl:template>

<!-- skapar sma boxar med recept i -->
<xsl:template match="food">
<!-- OBS! Hur ser lankarna ut for dessa recept? -->
	<a class="simpleRecipeBox"> 
	<xsl:attribute name="href"> ?site=showRecipe&#38;byId=<xsl:value-of select="id"/></xsl:attribute>
		<div>
		<img> 
			<xsl:attribute name="src">
				<xsl:value-of select="image" />
			</xsl:attribute>
		</img>
		<h2><xsl:value-of select="name" /></h2>
		<p><xsl:value-of select="description" /></p>
		<p class="date"><xsl:value-of select="added" /></p>
		</div>
	</a>
</xsl:template>

<!-- skriver ut ingredienser for showRecipe -->
<xsl:template match="ingredient" mode="A">
	<li>
		<xsl:value-of select="."/><xsl:value-of select="./quantity/@measureUnit"/>
	</li>
</xsl:template>

<!-- radar upp checkboxes av kategorier for addCategory sidan -->
<xsl:template match="category[@position = 'none']" mode="list">
	<xsl:if test="position() = 1">
	</xsl:if>
	<xsl:if test="position() = floor(last() div 2 + 0.5)">
	</xsl:if>
	<input>
		<xsl:attribute name="type">checkbox</xsl:attribute>
		<xsl:attribute name="value"><xsl:value-of select="."/></xsl:attribute>
	</input><xsl:value-of select="."/><br/>
	<xsl:if test="position() = last()">
	</xsl:if>
</xsl:template>

<!--skapar grund for newRecipe sidan-->
<xsl:template match="category[@position = 'center' and @site = 'newRecipe']">
<div id="colTwo">
		<table align="center" width="60%" class="noshow">
			<tr>
			<xsl:choose>
				<xsl:when test="../user">
					<td align="center" width="50%"><a href="?site=newRecipe">Nytt recept</a></td>
				</xsl:when>
				<xsl:otherwise>
					<td align="center" width="50%"></td>
				</xsl:otherwise>
			</xsl:choose>
				<td align="center" width="50%"><a href="?site=searchRecipe">SÃ¶k recept</a></td>
			</tr>
		</table>
	<div class="recept">
	<br/>
		<h2 class="indent">Nytt Recept</h2>
		<p class="indent" id="varning"/>
		<form name="createRecipe" onsubmit="return validateForm()"  action="?site=previewRecipe" enctype="multipart/form-data" method="post" id="recipeform">
			<xsl:choose>
				<xsl:when test="food/name !=''">
					<p>Namn: <input type="text" name="namn_ratt">
						<xsl:attribute name="value"><xsl:value-of select="food/name/."/></xsl:attribute>
					</input>
					</p>
				</xsl:when>
				<xsl:otherwise>
					<p>Namn: <input type="text" name="namn_ratt" value="(pÃ¥ rÃ¤tten)" onclick="clear_input(this)"/> 
					</p>
				</xsl:otherwise>
			</xsl:choose>
			
			<p>Kategori: 
				<xsl:choose>
					<xsl:when test="name/. !=''">
						<select name="category" class="mobile">
							<option>
								<xsl:attribute name="value"><xsl:value-of select="name/."/></xsl:attribute>
								<xsl:value-of select="name/."/>
							</option>
							<xsl:apply-templates select="../category[@position = 'none']" mode="Custom"/>
						</select>
					</xsl:when>
				<xsl:otherwise>			
				<select  name="category" class="mobile">
					<option value="">(vÃ¤lj)</option>
					<!-- kallar pa att skapa lista av kategorier -->
					<xsl:apply-templates select="../category[@position = 'none']" mode="Custom"/>
				</select>
				</xsl:otherwise>
				</xsl:choose>
				</p>
			<table class="nytt">
				<tr>
					<th align="left" class="mobile">
						Tillagningstid
					</th>
					<th align="left" class="mobile">
						ServeringsmÃ¤ngd
					</th>
					<th align="left" class="mobile">
						SvÃ¥righet
					</th>
					<th align="left" class="noshow">
						Bild pÃ¥ matrÃ¤tten
					</th>
				</tr>
				<tr>
				<td align="top" class="mobile">
					<xsl:choose>
						<xsl:when test="food/cookingTime !=''">
							<select name="Tillagningstid">
								<option>
									<xsl:attribute name="value"><xsl:value-of select="food/cookingTime"/></xsl:attribute>
									<xsl:value-of select="food/cookingTime"/>
								</option>
								<xsl:call-template name="cookingTimes"/>
							</select>
						</xsl:when>
						<xsl:otherwise>			
							<select name="Tillagningstid">
								<xsl:call-template name="cookingTimes"/>
							</select>
						</xsl:otherwise>
					</xsl:choose>
				</td>
				<td class="mobile">
					<xsl:choose>
						<xsl:when test="food/portions != ''">
							<select name="Serveringsmangd_antal">
								<option>
									<xsl:attribute name="value">
										<xsl:value-of select="food/portions"/>
									</xsl:attribute>
										<xsl:value-of select="food/portions"/>
								</option>
									<xsl:call-template name="servingQuantitys"/>
							</select>
							<select name="Serveringsmangd_enhet">
								<option>
									<xsl:attribute name="value">
										<xsl:value-of select="food/portionType"/>
									</xsl:attribute>
										<xsl:value-of select="food/portionType"/>
								</option>
									<xsl:call-template name="servingQuantitysUnits"/>
							</select>
						</xsl:when>
						<xsl:otherwise>
							<select name="Serveringsmangd_antal">
								<xsl:call-template name="servingQuantitys"/>
							</select>
							<select name="Serveringsmangd_enhet">
								<xsl:call-template name="servingQuantitysUnits"/>
							</select>
						</xsl:otherwise>
					</xsl:choose>
				</td>
				<td class="mobile">
					<xsl:choose>
						<xsl:when test="food/difficulty !=''">
							<select name="Svarighet">
								<option>
									<xsl:attribute name="value"><xsl:value-of select="food/difficulty"/></xsl:attribute>
									<xsl:value-of select="food/difficulty"/>
								</option>
								<xsl:call-template name="difficulties"/>
							</select>
						</xsl:when>
						<xsl:otherwise>			
							<select name="Svarighet">
								<xsl:call-template name="difficulties"/>
							</select>
						</xsl:otherwise>
					</xsl:choose>
				</td>
				<td class="noshow">	
					<input type="file" name="img" accept="image/*" />
				</td>
				</tr>
			</table>
			<br/>
			<p class="noformat">Ingredienser:</p>
			<div class="ingrediens">
			<table onchange="checkIngredientRow(this)" id="ingredientAdd">
			<tr id="tableHead">
				<th>Ta bort</th>
				<th>Ingrediens</th>
				<th>MÃ¤ngd</th>
				<th>MÃ¥ttenhet</th>
			</tr>
			<xsl:choose>
				<xsl:when test="food/ingredient/name != ''">
					<xsl:for-each select="food/ingredient/name">
						<tr >
						<td>
							<button onclick="eraseRow(this)" type="button">x</button>
						</td>
						<td>
							<select  name="Ingrediens[0][]">
								<option>
									<xsl:attribute name="value">
										<xsl:value-of select="."/>
									</xsl:attribute>
										<xsl:value-of select="."/>
								</option>
								<xsl:apply-templates select="../../../../ingredient" mode="B"/>
							</select>
						</td>
						<td>
							<select  name="Ingrediens[1][]">					
								<option>
									<xsl:attribute name="value">
										<xsl:value-of select="../quantity"/>
									</xsl:attribute>
										<xsl:value-of select="../quantity"/>
								</option>

								<xsl:call-template name="quantitys"/>
							</select>
						</td>
						<td>
							<select  name="Ingrediens[2][]">
								<option>
									<xsl:attribute name="value">
										<xsl:value-of select="../quantity/@measureUnit"/>
									</xsl:attribute>
										<xsl:value-of select="../quantity/@measureUnit"/>
								</option>

								<xsl:call-template name="measures"/>
							</select>
						</td>
						</tr>
					</xsl:for-each>
				</xsl:when>
				<xsl:otherwise>
					<tr >
					<td>
						<button onclick="eraseRow(this)" type="button">x</button>
					</td>

					<td>
						<select  name="Ingrediens[0][]">
							<option value="">(vÃ¤lj)</option>
							<xsl:apply-templates select="../ingredient" mode="B"/>
						</select>
					</td>
					<td>
						
						<select  name="Ingrediens[1][]">
							<xsl:call-template name="quantitys"/>
						</select>
					</td>
					<td>
						<select  name="Ingrediens[2][]">
							<xsl:call-template name="measures"/>
						</select>
					</td>
					</tr>
				</xsl:otherwise>
			</xsl:choose>
		</table>
		</div>
		<p>
			<xsl:choose>
				<xsl:when test="food/description !=''">
					Beskrivning (max 45 tecken):<br/>
					<textarea rows="2" cols="62" name="description"  maxlength="45"><xsl:value-of select="food/description"/></textarea>
				</xsl:when>
				<xsl:otherwise>
					Beskrivning (max 45 tecken):<br/>
					<textarea rows="2" cols="62" name="description"  maxlength="45"></textarea>
				</xsl:otherwise>
			</xsl:choose>
		</p>
		<p>
			<xsl:choose>
				<xsl:when test="food/procedure !=''">
					Matlagningsprocedur:<br/>
					<textarea rows="6" cols="62" name="procedure" maxlength="1024"><xsl:value-of select="food/procedure"/></textarea>
				</xsl:when>
				<xsl:otherwise>
					Matlagningsprocedur:<br/>
					<textarea rows="6" cols="62" name="procedure" maxlength="1024"></textarea>
				</xsl:otherwise>
			</xsl:choose>
		</p>
		<p align="right">
			<input type="submit" value="FÃ¶rhandsgranska" action="NEEDLINK"/>
		</p>
		</form>
	</div>
</div>
</xsl:template>

<!-- for att skapa lista av kategorierna -->
<xsl:template match="category[@position = 'none']" mode="Custom">
	<option>
		<xsl:attribute name="value">
			<xsl:value-of select="."/>
		</xsl:attribute>
		<xsl:value-of select="."/>
	</option>
</xsl:template>

<!-- for att skapa lista av ingredienserna -->
<xsl:template match="ingredient" mode="B">
	<option>
		<xsl:attribute name="value">
			<xsl:value-of select="."/>
		</xsl:attribute>
		<xsl:value-of select="."/>
	</option>
</xsl:template>

<!-- Skapar grund for searchRecipe sidan -->
<xsl:template match="category[@position = 'center' and @site = 'searchRecipe']">
	<div id="colTwo">
		<table align="center" width="60%" class="noshow">
			<tr>
			<xsl:choose>
				<xsl:when test="../user">
					<td align="center" width="50%"><a href="?site=newRecipe">Nytt recept</a></td>
				</xsl:when>
				<xsl:otherwise>
					<td align="center" width="50%"></td>
				</xsl:otherwise>
			</xsl:choose>
				<td align="center" width="50%"><a href="?site=searchRecipe">SÃ¶k recept</a></td>
			</tr>
		</table>
	<div class="sokrecept">
		<br/>
			<h2 class="mobile">SÃ¶k Recept</h2>
			<form name="searchRecipe" action="?site=showRecipe" method="post" id="searchform">
				<table class="nytt">
					<tr>
						<th align="left">
							Kategori
						</th>
						<th align="left">
							Tillagningstid
						</th>
						<th align="left">
							SvÃ¥righet
						</th>
						<th align="left">
							MatrÃ¤tt har bild
						</th>
					</tr>
					<tr>
					<td>
						<select name="sok_kategori">
							<option value="alla">Alla</option>
							<!-- laser in ingredienser fran xml i java-drop down listan-->
							<xsl:apply-templates select="../category[@position = 'none']" mode="Custom"/>
						</select>	
					</td>
					<td align="top">
						<select name="Tillagningstid">
							<xsl:call-template name="cookingTimes"/>
						</select>
					</td>
					<td>
						<select name="Svarighet">
							<xsl:call-template name="difficulties"/>
						</select>
					</td>
					<td>	
						<select name="har_bild">
							<option value="any">KrÃ¤vs inte</option>
							<option value="ja">Ja</option>
						</select>
					</td>
					</tr>
				</table>
				<br/>
				<p class="noformat">Ingredienser som ska finns i recepten</p>
			<div class="ingrediens">
			<table onchange="checkIngredientRow(this)" id="ingredientAdd">
			<tr id="tableHead">
				<th>Ta bort</th>
				<th>Ingrediens</th>
			</tr>
			<tr >
			<td>
				<button onclick="eraseRow(this)" type="button">x</button>
			</td>
			<td>
				<select  name="Ingrediens[0][]">
					<option value="">(vÃ¤lj)</option>
						<xsl:apply-templates select="../ingredient" mode="B"/>
				</select>
			</td>
			
			</tr>
		</table>
		</div>
			<p align="right">
				<input type="button" value="Rensa kriterier" onclick="" /> <input type="submit" value="Visa"  />
			</p>
			</form>
	</div>
	</div>
</xsl:template>

<!-- skapar grund for previewRecipe sidan -->
<xsl:template match="category[@position ='center' and @site = 'previewRecipe']">
	<div id="colTwo">
		<table align="center" width="60%" class="noshow">
			<tr>
			<xsl:choose>
				<xsl:when test="../user">
					<td align="center" width="50%"><a href="?site=newRecipe">Nytt recept</a></td>
				</xsl:when>
				<xsl:otherwise>
					<td align="center" width="50%"></td>
				</xsl:otherwise>
			</xsl:choose>
				<td align="center" width="50%"><a href="?site=searchRecipe">SÃ¶k recept</a></td>
			</tr>
		</table>
		<p>
		<h2 align="center"><xsl:value-of select="./food/name" /></h2>
		</p>
		<div style="width:250;align:right;padding:8px;float:right;color:black;">
		<img width="250px">
		<xsl:attribute name="src">
			<xsl:value-of select="./food/image" />
		</xsl:attribute>
		</img><br/>
			SvÃ¥righet: <b><xsl:value-of select="./food/difficulty"/></b> (5)<span> |</span> Tillagningstid ca: <b><xsl:value-of select="./food/cookingTime"/></b> min
		</div>
		<p>
			<h3>Ingredienser:</h3>
			<br/>
			<ul>
				<xsl:apply-templates select="./food/ingredient" mode="A" />
			</ul>
		</p>
		<p>
			<br/><h3>Beskrivning:</h3><br/>
			<p>
				<xsl:value-of select="./food/description" />
			</p>
			<p>
			<br/><h3>Procedur:</h3><br/>
			</p>
			<p>
				<xsl:value-of select="./food/procedure" />
			</p>
		</p>
		<div style="float:right;">
			<!-- Input button ska onClick ga tillbaks till newRecipe fast redan ha ifyllda varden-->
			<button type="button" value="andra" onClick="NEEDLINK"/> Tillbacka<button type="button" onclick="?site=showRecipe" value="Spara Recept">Spara</button>
			
		</div>
	</div>
	
</xsl:template>

<!-- for att skapa lista av mattenheter -->
<xsl:template name="measures">
		<option value="">(max)</option>
		<option value="dl">dl</option>
		<option value="l">l</option>
		<option value="cl">cl</option>
		<option value="ml">ml</option>
		<option value="msk">msk</option>
		<option value="tsk">tsk</option>
		<option value="g">g</option>
		<option value="kg">kg</option>
		<option value="krm">krm</option>
		<option value="st">st</option>
</xsl:template>

<!-- for att skapa lista av mangder -->
<xsl:template name="quantitys">
		<option value="">(max)</option>
		<option value="1">1</option>
		<option value="1.5">1.5</option>
		<option value="2">2</option>
		<option value="2.5">2.5</option>
		<option value="3">3</option>
		<option value="3.5">3.5</option>
		<option value="4">4</option>
		<option value="4.5">4.5</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="15">15</option>
		<option value="20">20</option>
		<option value="25">25</option>
		<option value="30">30</option>
		<option value="35">35</option>
		<option value="40">40</option>
		<option value="45">45</option>
		<option value="50">50</option>
		<option value="60">60</option>
		<option value="70">70</option>
		<option value="80">80</option>
		<option value="90">90</option>
		<option value="100">100</option>
		<option value="200">200</option>
		<option value="300">300</option>
		<option value="400">400</option>
		<option value="500">500</option>
</xsl:template>

<!-- for att skapa lista av tillagningstider -->
<xsl:template name="cookingTimes">
		<option value="">(max)</option>
		<option value="5">5 min</option>
		<option value="10">10 min</option>
		<option value="15">15 min</option>
		<option value="20">20 min</option>
		<option value="25">25 min</option>
		<option value="30">30 min</option>
		<option value="40">40 min</option>
		<option value="50">50 min</option>
		<option value="60">60 min</option>
		<option value="90">90 min</option>
		<option value="120">120 min</option>
		<option value="150">150 min</option>
		<option value="180">180 min</option>
		<option value="240">240 min</option>
		<option value="300">300 min</option>
		<option value="360">360 min</option>
		<option value="420">420 min</option>
		<option value="480">480 min</option>
</xsl:template>

<!-- for att skapa lista av serveringsmangder -->
<xsl:template name="servingQuantitys">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="6">6</option>
		<option value="8">8</option>
		<option value="10">10</option>
</xsl:template>

<!-- for att skapa lista  serveringsmangders enheter -->
<xsl:template name="servingQuantitysUnits">
		<option value="st">styck</option>
		<option value="port">port</option>
</xsl:template>

<!-- for att skapa lista  svarighetsgrader -->
<xsl:template name="difficulties">
		<option value="1">1 (lÃ¤tt)</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5 (svÃ¥r)</option>
</xsl:template>

</xsl:stylesheet>