<?php /* Smarty version Smarty-3.0.6, created on 2011-02-28 19:28:05
         compiled from ".\templates\../index.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:85074d6be9357240c4-53466955%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1bb1f250fcbe39e40eec0a6cce6478fe4f4f7537' => 
    array (
      0 => '.\\templates\\../index.tpl.html',
      1 => 1298917678,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '85074d6be9357240c4-53466955',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<html>
<head>
<title>Frivillig 4.3</title>
</head>
<body>
<p>
Vid den tioende uppdateringen av sidan så återställs räknaren för sidan
</p>
<p>
Antalbesök under denna Session <?php echo $_smarty_tpl->getVariable('visits')->value;?>

</p>
<form method="post" action="index.php">
<input name="counter" type="submit"  value="reset"/>
<input name="" type="submit" value="Uppdatera huvudsidan"/>
<input name="counter" type="submit" value="destroy"/>
</form>
</body>
</html>