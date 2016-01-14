<?php
	header('Content-type: text/plain');
	$Sscript = $_SERVER["PHP_SELF"];
	$Sname =  $_SERVER["SERVER_NAME"];
	//$Srefer = $_SERVER["HTTP_REFERER"];
	$Sadmin = $_SERVER["SERVER_ADMIN"];
	$Sencoding = $_SERVER["HTTP_ACCEPT_ENCODING"];
	$Scon = $_SERVER["HTTP_CONNECTION"];
	$Sreqme = $_SERVER["REQUEST_METHOD"];
	$Saccept = $_SERVER["HTTP_ACCEPT"];
	//$Suri = $_SERVER["SCRIPT_URI"];
	$Sscriptfilename = $_SERVER["SCRIPT_FILENAME"];
	$Sx = $_SERVER["HTTP_X_BEHAVIORAL_AD_OPT_OUT"];
	$Ssoftware = $_SERVER["SERVER_SOFTWARE"];
	$Sacceptcharset = $_SERVER["HTTP_ACCEPT_CHARSET"];
	$Squery = $_SERVER["QUERY_STRING"];
	$SRport = $_SERVER["REMOTE_PORT"];
	$Suseragent = $_SERVER["HTTP_USER_AGENT"];
	$Sport = $_SERVER["SERVER_PORT"];
	$Ssignature = $_SERVER["SERVER_SIGNATURE"];
	
	
	echo "SCRIPT NAME:  $Sscript \n" . 
	     "SERVER NAME:  $Sname \n" .
		 "SERVER ADMIN: $Sadmin \n" . 
		 "HTTP ACCEPT ENCODING: $Sencoding \n" .
		 "HTTP CONNECTION: $Scon \n" .
		 "REQUEST METHOD: $Sreqme \n" .
		 "HTTP ACCEPT: $Saccept \n" .
		 "SCRIPT FILENAME: $Sscriptfilename \n" .
		 "HTTP X BEHAVIOR AD OPT OUT: $Sx \n" .
		 "SERVER SOFTWARE: $Ssoftware \n" .
	     "HTTP ACCEPT CHARSET: $Sacceptcharset \n" . 
		 "QUERY STRING: $Squery \n" .
		 "REMOTE_PORT: $SRport \n" .
		 "HTTP USER AGENT: $Suseragent \n" .
		 "SERVER PORT: $Sport \n" .
		 "SERVER SIGNATURE: $Ssignature \n\n"; 
	
	$Clanguage = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
	//$Ccookie = $_SERVER["HTTP_COOKIE"];
	$CrAddr = $_SERVER["REMOTE_ADDR"];
	$Cnotrack = $_SERVER["HTTP_X_DO_NOT_TRACK"];
	$Ckalive = $_SERVER["HTTP_KEEP_ALIVE"];
	$Cserverproto = $_SERVER["SERVER_PROTOCOL"];
	$Cpath = $_SERVER["PATH"];
	$Curi = $_SERVER["REQUEST_URI"];
	
	$Cgateway = $_SERVER["GATEWAY_INTERFACE"];
	$Cserveraddr = $_SERVER["SERVER_ADDR"];
//	$Cscripturl = $_SERVER["SCRIPT_URL"];
	$Cdocroot = $_SERVER["DOCUMENT_ROOT"];
	$Chost = $_SERVER["HTTP_HOST"];
	
	echo "HTTP ACCEPT LANGUAGE:   \n" .
		 //"HTTP COOKIE: $Ccookie \n" .
	     "REMOTE ADDR: $CrAddr \n" .
		 "HTTP X DO NOT TRACK: $Cnotrack \n" .
		 "HTTP KEEP ALIVE: $Ckalive \n"	.
		 "SERVER PROTOCOL: $Cserverproto \n" .
		 "PATH: $Cpath \n" . 
		 "REQUEST_URI: $Curi \n" . 
		 "GATEWAY INTERFACE: $Cgateway \n" .
		 "SERVER ADDR: $Cserveraddr\n" .
		 //"SCRIPT URL: $Cscripturl \n" .
		 "DOCUMENT ROOT: $Cdocroot \n" .
		 "HTTP HOST: $Chost ";
?>