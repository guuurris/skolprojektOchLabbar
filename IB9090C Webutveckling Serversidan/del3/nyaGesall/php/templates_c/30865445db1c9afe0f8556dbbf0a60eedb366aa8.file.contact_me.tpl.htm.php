<?php /* Smarty version Smarty-3.0.6, created on 2011-03-23 02:07:34
         compiled from ".\templates\../../template/contact_me.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:271994d8947d6591947-29656496%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '30865445db1c9afe0f8556dbbf0a60eedb366aa8' => 
    array (
      0 => '.\\templates\\../../template/contact_me.tpl.htm',
      1 => 1300842451,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '271994d8947d6591947-29656496',
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
	<?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('posts')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value){
?>
		<table border="0" align="center"  ><tr><td height=5%; ><h1><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</h1></td></tr><tr><td height=5%;><h2><?php echo $_smarty_tpl->tpl_vars['post']->value['subtitle'];?>
</h2></td></tr><tr><td valign="top"> <p><?php echo $_smarty_tpl->tpl_vars['post']->value['message'];?>
<br/></p><p></p></td></tr><tr><td valign="top"> <h3> <A HREF="mailto:<?php echo $_smarty_tpl->tpl_vars['post']->value['mail'];?>
?subject=<?php echo $_smarty_tpl->tpl_vars['post']->value['subject'];?>
&body=<?php echo $_smarty_tpl->tpl_vars['post']->value['body'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['mail'];?>
</A> <h3/></td><p></p></td></tr></table><br/>
	<?php }} ?>

</body>
</html>