<?php /* Smarty version Smarty-3.0.6, created on 2011-03-23 01:11:50
         compiled from ".\templates\../../template/status_message.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:53444d893ac6224052-07898570%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f0917a9faf8f1d6af2e257ad9984a1254a3d59f3' => 
    array (
      0 => '.\\templates\\../../template/status_message.tpl.htm',
      1 => 1300832255,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '53444d893ac6224052-07898570',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/pagesColoring.css" /> 
</head>
	<body>
		<table align=center>
			<tr>
				<td>
					<h1>	
						<?php echo $_smarty_tpl->getVariable('title')->value;?>

					</h1>
				</td>
			</tr>
			<tr>
				<td>
					<p>
						<?php echo $_smarty_tpl->getVariable('message')->value;?>

					</p>
				</td>
			</tr>
		
		</table>	
	</body>
</html>