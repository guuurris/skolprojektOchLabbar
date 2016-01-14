<?php /* Smarty version Smarty-3.0.6, created on 2011-03-07 17:29:12
         compiled from ".\templates\../email.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:195354d7507d8c545b2-86076153%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '52f36a935c0370e7326173566b06b07edd055cfb' => 
    array (
      0 => '.\\templates\\../email.tpl.html',
      1 => 1298307136,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '195354d7507d8c545b2-86076153',
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
		<p>
			Namn: <?php echo $_smarty_tpl->getVariable('namn')->value;?>

		</p>
		<p>
			Email: <?php echo $_smarty_tpl->getVariable('emailadress')->value;?>

		</p>
		<form  method="post" action="mailto:<?php echo $_smarty_tpl->getVariable('emailadress')->value;?>
?subject=Meddelande från <?php echo $_smarty_tpl->getVariable('namn')->value;?>
 " >
			<input type="submit" value="Skicka mail" />
		</form>

	</body>

</html>