<?php
	  header("Content-type: text/plain");	
      $realm = 'Private Site'; // sets this realm
      $nonce = uniqid();// Create a random unique id

	  $loggin = loggin();
      // If there was no loggin, require login
      if (is_null($loggin)) requireLogin($realm,$nonce);

      $digestParts = parser($loggin);

	  // User and password
      $user = 'admin';
      $passwd = '1234';

      // Based on all the info we gathered we can figure out what the response should be
      $A1 = md5("{$user}:{$realm}:{$passwd}");
      $A2 = md5("{$_SERVER['REQUEST_METHOD']}:{$digestParts['uri']}");
  
	  // Make validations	
      $validate = md5("{$A1}:{$digestParts['nonce']}:{$digestParts['nc']}:{$digestParts['cnonce']}:{$digestParts['qop']}:{$A2}");

	  // If the credential subscribed was not correct requier new login
      if ($digestParts['response'] != $validate) 
		requireLogin($realm,$nonce);
	  
	  // The right password and username was given
	  else 
		echo "Welcome $user!";

      // function that returns the login
      function loggin() 
	  {
		  $loggin = "";
		  // mod_php
		  if (isset($_SERVER['PHP_AUTH_DIGEST'])) 
		  {
			$loggin = $_SERVER['PHP_AUTH_DIGEST'];
		  } 
		  return $loggin;  
      }
  // This function forces a login prompt
  function requireLogin($realm,$nonce) 
  {
	  header('WWW-Authenticate: Digest realm="' . $realm . '",qop="auth",nonce="' . $nonce . '",opaque="' . md5($realm) . '"');
	  header('HTTP/1.0 401 Unauthorized');
	  echo "Loggin was aborted!";
  }
  
       
  // This function extracts the separate values from the digest string
  function parser($digest) 
  {
  
	  // protect against missing data
	  $needed_parts = array('nonce'=>1, 'nc'=>1, 'cnonce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1);

	  $data = array();
	  
	  //Match digest array with a new array	in the same order as before
	  preg_match_all('@(\w+)=(?:(?:")([^"]+)"|([^\s,$]+))@', $digest, $matches, PREG_SET_ORDER);
		
	  // Loop through all the matches	
	  foreach ($matches as $m) 
	  {
		  $data[$m[1]] = $m[2] ? $m[2] : $m[3];
		  unset($needed_parts[$m[1]]);
	  }
		// if no of the needed parts where found return empty array
		if(!$needed_parts)
			return $data;
  }
?>