<?php /* Smarty version Smarty-3.0.6, created on 2011-02-21 14:38:54
         compiled from ".\templates\../emailaddress.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:79374d626aeef2d0f6-31725483%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8d1d2da246a13a9e361ef14b537dbe6901133101' => 
    array (
      0 => '.\\templates\\../emailaddress.tpl.html',
      1 => 1298295495,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '79374d626aeef2d0f6-31725483',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<html>
<head>
<title> 4.1.2 Information inbakad i formulär</title>

</head>
<body>
<form  method="post" action="email.php">
	<p>
        Mail-adress:  <input type="text" name="email" /> 
    </p>
	<input type="submit" value="Fortsätt" />
		
    <input type="hidden" name="knapp" value="1337">
	<p>
        <input type="hidden" name="namn" value="<?php echo $_smarty_tpl->getVariable('namn')->value;?>
" />
    </p>
</form>
</body>

</html>

