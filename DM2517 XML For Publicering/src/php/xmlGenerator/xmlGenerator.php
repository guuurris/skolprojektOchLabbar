<?php 
include 'prefix.php'; ?>
	
<xrecipe>
<?php
	include_once('CAS-1.3.2/CAS.php');
	include 'xmlGen.php';
	$user = null;
	//Skall ändras till post i slutversionen
	if(isset($_REQUEST['login']) or isset($_REQUEST['logout']) ) 
	{
		// initialize phpCAS
		phpCAS::client(CAS_VERSION_2_0,'login.kth.se',443,'');

		phpCAS::setNoCasServerValidation();

		// If you want the redirect back from the login server to enter your application by some 
		// specfic URL rather than just back to the current request URI, call setFixedCallbackURL.
		phpCAS::setFixedCallbackURL('http://xml.csc.kth.se/~wiiala/DM2517/project/php/index.php');

		// force CAS authentication
		phpCAS::forceAuthentication();

		// at this step, the user has been authenticated by the CAS server
		// and the user's login name can be read with phpCAS::getUser().
		
		$user = phpCAS::getUser();
		
			// logout if desired
		if (isset($_REQUEST['logout'])) {
		 phpCAS::logout();
		}
	}
	
	
	
	
	
	
	$xml = new xmlGen("",$user); 
	$returnstring = $xml->getGeneratedXML();
	
    print utf8_encode($returnstring);
?>
</xrecipe>

<?php include 'postfix.php';?>