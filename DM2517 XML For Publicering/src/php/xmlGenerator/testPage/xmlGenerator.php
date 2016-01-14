<?php 
include 'prefix.php'; ?>
	
<xrecipe>
<?php
	include 'xmlGen.php';
	
	$user = "u1sk2ewj";
	$xml = new xmlGen("",$user); 
	$returnstring = $xml->getGeneratedXML();
	
    print utf8_encode($returnstring);
?>
</xrecipe>

<?php include 'postfix.php';?>