<?php
header('Content-type: text/plain');
//Skriver ut alla server information för varje värde på nyckeln k
foreach ($_SERVER as $k => $v)
{
    echo "$k: $v\n";
}
?>