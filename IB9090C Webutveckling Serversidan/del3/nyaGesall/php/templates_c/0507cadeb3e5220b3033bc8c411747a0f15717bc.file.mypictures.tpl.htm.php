<?php /* Smarty version Smarty-3.0.6, created on 2011-03-23 01:13:34
         compiled from ".\templates\../../template/mypictures.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:6764d893b2e537024-17684473%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0507cadeb3e5220b3033bc8c411747a0f15717bc' => 
    array (
      0 => '.\\templates\\../../template/mypictures.tpl.htm',
      1 => 1300835067,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6764d893b2e537024-17684473',
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
	<?php  $_smarty_tpl->tpl_vars['pic'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('pictures')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['pic']->key => $_smarty_tpl->tpl_vars['pic']->value){
?>
		<table border="0" align="center"  ><tr><td height=5%; ><h1><?php echo $_smarty_tpl->tpl_vars['pic']->value['title'];?>
</h1></td></tr><tr><td><img src="../upload_files/<?php echo $_smarty_tpl->tpl_vars['pic']->value['src'];?>
" alt="picture" width="500"  /></td></tr><tr><td valign="top"> <p><?php echo $_smarty_tpl->tpl_vars['pic']->value['size'];?>
<br/></p><p></p></td></tr></table><br/>
	<?php }} ?>

</body>
</html>