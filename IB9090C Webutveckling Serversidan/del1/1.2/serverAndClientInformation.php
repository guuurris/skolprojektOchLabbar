<?php
header('Content-type: text/plain');
//Skriver ut alla server information f�r varje v�rde p� nyckeln k
foreach ($_SERVER as $k => $v)
{
    echo "$k: $v\n";
}
?>