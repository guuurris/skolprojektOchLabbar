<?php /* Smarty version Smarty-3.0.6, created on 2011-03-23 01:09:55
         compiled from ".\templates\../../template/page.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:284084d893a53769b08-59672975%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a96da2953d119ee87e7e05527c35b6f95989cb48' => 
    array (
      0 => '.\\templates\\../../template/page.tpl.htm',
      1 => 1300747644,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '284084d893a53769b08-59672975',
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
<br/></p><p></p></td></tr></table><br/>
	<?php }} ?>

</body>
</html>