<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns="http://www.w3.org/1999/xhtml">
<xsl:output method="html" indent="yes"/>
<xsl:template match="xrecipe">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Xrecipe mobile</title>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
<link rel="stylesheet" href="style.css" type="text/css" media="all" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$('.menu').hide();
	$('.menu-show').show();
	$('.menu-hide').hide();
	$('.menu-show').click(function(){
		$('.menu-show').toggle();
		$('.menu-hide').toggle();
		$('.menu').slideDown();
	});
	$('.menu-hide').click(function(){
		$('.menu-hide').toggle();
		$('.menu-show').toggle();
		$('.menu').slideUp();
	});
</script>
</head>
<body>
	<div class="logo">
		<a href="#"><img src="images/logo.png" alt="Xrecipe"/></a>
	</div>
		<xsl:apply-templates select="category[@site = 'showRecipe']"/>
		<xsl:apply-templates select="category[@site = 'searchRecipe']"/>
		<xsl:apply-templates select="category[@site = 'startPage']"/>
	<div class="footer">
		<div class="wrap bot-bar">
			Copyright; 2013 XRecipe. Designed by K.Orellana and G.Wiiala
			<div class="clear-both"></div>
		</div>
	</div>
</body>
</html>	
</xsl:template>

<xsl:template match="category[@site = 'showRecipe']">
	<div class="header">
		<div class="top-bar">
				<button class="menu-show"><img src="images/plus.png" alt="plus"/></button>
				<button class="menu-hide"><img src="images/minus.png" alt="minus"/></button>
			<div class="up-right">
				<h3><a href="#">Förra</a><span> | </span><a href="#">Nästa</a></h3>
			</div>
			<div class="clear-both"></div>
			<nav class="menu">
				<ul>
					<li><a href="#">Tillbaka till kategori: <xsl:value-of select="name"/></a></li>
					<li><a href="#">Visa alla kategorier</a></li>
					<li><a href="#">Visa datorversion</a></li>
				</ul>
			</nav>
		</div>
	</div>
	<div class="content">
		<div class="wrap">
			<div class="post">
				<h2><xsl:value-of select="food/name"/></h2>
				<figure>
					<img width="300px" alt="">
						<xsl:attribute name="src"><xsl:value-of select="food/image" /></xsl:attribute>
					</img>				
				</figure>
				<h5>Ingredienser</h5>
					<ul>
						<xsl:apply-templates select="food/ingredient" mode="A"/>
					</ul>
				<h5>Beskrivning</h5>
					<xsl:value-of select="food/description"/>
				<p></p>
				<h5>Procedur</h5>
					<xsl:value-of select="food/procedure"/>
				<p></p>
				<div class="date">Skapad: <xsl:value-of select="food/added"/></div>
			 </div>
		</div>
	</div>
</xsl:template>

<xsl:template match="category[@site = 'searchRecipe']">
	<div class="header">
		<div class="top-bar">
				<button class="menu-show"><img src="images/plus.png" alt="plus"/></button>
				<button class="menu-hide"><img src="images/minus.png" alt="minus"/></button>
			<div class="up-right">
				<h3>Kategori: <xsl:value-of select="name"/></h3>
			</div>
		<div class="clear-both"></div>
			<nav class="menu">
				<ul>
					<li><a href="#">Visa alla kategorier</a></li>
					<li><a href="#">Visa datorversion</a></li>
				</ul>
			</nav>
		</div>
	</div>
	<div class="content">
		<div class="wrap">
			<xsl:apply-templates select="food" mode="A" />
		</div>
	</div>
</xsl:template>

<xsl:template match="category[@site = 'startPage']">
	<div class="header">
		<div class="top-bar">
				<button class="menu-show"><img src="images/plus.png" alt="plus"/></button>
				<button class="menu-hide"><img src="images/minus.png" alt="minus"/></button>
			<div class="up-right">
				<h3>Kategorier</h3>
			</div>
		<div class="clear-both"></div>
			<nav class="menu">
				<ul>
					<li><a href="#">Visa datorversion</a></li>
				</ul>
			</nav>
		</div>
	</div>
	<div class="content">
		<div class="wrap">
			<xsl:apply-templates select="/xrecipe/category[@position = 'none']" />
		</div>
	</div>
</xsl:template>

<xsl:template match="food" mode="A">
	<div class="post">
		<a href="#"><h2><xsl:value-of select="name"/></h2></a>
		<p>
			<xsl:value-of select="description"/>
		</p>
		<div class="date">Skapad: <xsl:value-of select="added"/></div>
	 </div>
</xsl:template>

<xsl:template match="xrecipe/category[@position = 'none']">
	<div class="post">
		<h2><a href="#"><xsl:value-of select="name"/></a></h2>
	</div>
</xsl:template>

<xsl:template match="ingredient" mode="A">
	<li><xsl:value-of select="."/><xsl:value-of select="./quantity/@measureUnit"/></li>
</xsl:template>

</xsl:stylesheet>