<?php
header('Refresh: 3');
$image = imagecreatefrompng( "phpgen.png");
$time = time();
$text = str_split($time, 2);

//Bestämmer 4 Olika färger !
$text_colourA = imagecolorallocate( $image, 255 ,255 , 0 );
$text_colourB = imagecolorallocate( $image, 0 ,120 , 255 );
$text_colourC = imagecolorallocate( $image, 0 ,0 , 0 );
$text_colourD = imagecolorallocate( $image, 255 ,0 , 255 );

imagestring( $image, 12 , 45, 60, "$text[0]",
  $text_colourA );
  
imagestring( $image, 12 , 220, 60, "$text[1]",
  $text_colourB );
  
imagestring( $image, 12 , 45, 160, "$text[2]",
  $text_colourC );
  
imagestring( $image, 12 , 230, 160, "$text[3]",
  $text_colourC );
  
imagestring( $image, 12 , 140, 115, "$text[4]",
  $text_colourD );
// Placera ut nästa kommande siffrorna i andra hörnet (Högra) ! 

header( "Content-type: image/png" );
imagepng( $image );

imagecolordeallocate( $text_colorA );
imagecolordeallocate( $text_colorB );
imagecolordeallocate( $text_colorC );
imagecolordeallocate( $text_colorD );
imagecolordeallocate( $background );
imagedestroy( $image );
?>
