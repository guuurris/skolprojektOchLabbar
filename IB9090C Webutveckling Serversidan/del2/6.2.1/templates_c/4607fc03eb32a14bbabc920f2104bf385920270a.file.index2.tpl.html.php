<?php /* Smarty version Smarty-3.0.6, created on 2011-03-07 08:43:45
         compiled from ".\templates\../index2.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:196854d748cb1332109-96556255%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4607fc03eb32a14bbabc920f2104bf385920270a' => 
    array (
      0 => '.\\templates\\../index2.tpl.html',
      1 => 1299483818,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '196854d748cb1332109-96556255',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title>6.2.1 Relationsdatabas</title>
	</head>
	<body>
		<form method="post" action="testclass.php">
			<table>

				<tr>
					<td>
						Namn:
					</td>
					<td>
						<input type="text" name="name"/>
					</td>		
				</tr>
				<tr>
					<td>
						Email:
					</td>
					<td>
						<input type="text" name="email"/>
					</td>
				</tr>
				<tr>
					<td>
						Hemsida: 
					</td>
					<td>
						<input type="text" name="website"/>
					</td>
				</tr>
				<tr>
					<td>
						Kommentar:
					</td>
					<td>
						<textarea  rows="10" cols="15" name="comment"></textarea>
					</td>
				</tr>
				</table>
				<p>
					<input type="submit" name="add" value="Lägg till kommentar"/>
				</p>
		</form>
		
		<?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('Posts')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value){
?>
		<p>_______________________________</p><p>Namn: <?php echo $_smarty_tpl->tpl_vars['post']->value['name'];?>
</p><p>Email: &#32;<A href=mailto:<?php echo $_smarty_tpl->tpl_vars['post']->value['email'];?>
><?php echo $_smarty_tpl->tpl_vars['post']->value['email'];?>
</A></p><p>Hemsida: &#32;<A href=<?php echo $_smarty_tpl->tpl_vars['post']->value['web'];?>
 ><?php echo $_smarty_tpl->tpl_vars['post']->value['web'];?>
</A></p><p>Kommentar: <?php echo $_smarty_tpl->tpl_vars['post']->value['comment'];?>
</p><p>-- <?php echo $_smarty_tpl->tpl_vars['post']->value['added'];?>
 --</p>
		<?php }} ?>


	</body>

</html>