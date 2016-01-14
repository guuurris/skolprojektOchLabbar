<?php /* Smarty version Smarty-3.0.6, created on 2011-03-23 01:09:58
         compiled from ".\templates\../../template/login.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:109094d893a56e89b24-41807406%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0fad25fe99e0d6ee06a6f2fbf34585e661dd1822' => 
    array (
      0 => '.\\templates\\../../template/login.tpl.htm',
      1 => 1300831103,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '109094d893a56e89b24-41807406',
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
						<td>
						<p>
							<?php echo $_smarty_tpl->getVariable('username')->value;?>

						</p>
							<input type="text" name="user"/>
						</td>
					</td>
				<td>
					<td>
						<p>
							<?php echo $_smarty_tpl->getVariable('password')->value;?>

						</p>
						<input type="password" name="passwd"/>
					</td>
				</tr>
				<tr>
					<td>
						<td>
							<td>
								<td>
									<input type="submit" name="login" value=<?php echo $_smarty_tpl->getVariable('title')->value;?>
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