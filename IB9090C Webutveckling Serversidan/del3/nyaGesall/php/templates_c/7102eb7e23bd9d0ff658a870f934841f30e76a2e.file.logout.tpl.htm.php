<?php /* Smarty version Smarty-3.0.6, created on 2011-03-23 01:39:58
         compiled from ".\templates\../../template/logout.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:184454d89415e2ba6c7-06508442%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7102eb7e23bd9d0ff658a870f934841f30e76a2e' => 
    array (
      0 => '.\\templates\\../../template/logout.tpl.htm',
      1 => 1300738286,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '184454d89415e2ba6c7-06508442',
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
		<form action="logmein.php" method="Post">
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
				<tr>
					<td>
						<td>
							<td>
								<td>
									<input type="submit" name="logout" value=<?php echo $_smarty_tpl->getVariable('title')->value;?>
>
								</td>
							</td>
						</td>
					</td>
				<tr/>
				
			</table>
		</form>
	</body>
</html>