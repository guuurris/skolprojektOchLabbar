<?php
header("Content-type: text/plain");

if (!isset($_SERVER['PHP_AUTH_USER']))
{
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
	echo "You aborted the authorisation";
}
else if ($_SERVER['PHP_AUTH_USER'] == "ADMIN" && ($_SERVER['PHP_AUTH_PW'] == "12344" ))
{
	echo "Hello " .  $_SERVER['PHP_AUTH_USER'] . " welcome back!";

}
else 
{
	header('HTTP/1.0 401 Unauthorized');
	header('WWW-Authenticate: Basic realm="My Realm"');
}	
?>