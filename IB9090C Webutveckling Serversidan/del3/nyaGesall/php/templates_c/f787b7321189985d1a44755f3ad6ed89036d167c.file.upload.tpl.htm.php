<?php /* Smarty version Smarty-3.0.6, created on 2011-03-23 01:13:07
         compiled from ".\templates\../../template/upload.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:156714d893b13ddfba9-95683224%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f787b7321189985d1a44755f3ad6ed89036d167c' => 
    array (
      0 => '.\\templates\\../../template/upload.tpl.htm',
      1 => 1300746816,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '156714d893b13ddfba9-95683224',
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
		<form action="logmein.php" enctype="multipart/form-data" method="Post">
			<table align=center>
				<tr>
					<td>
					<h1> 
						<?php echo $_smarty_tpl->getVariable('upload')->value;?>

					<h1>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $_smarty_tpl->getVariable('file')->value;?>

					</td>
					<td>
						<input type="file" name="file"/>
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" name="upload" value="<?php echo $_smarty_tpl->getVariable('sendFile')->value;?>
"/>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>