<?php /* Smarty version Smarty-3.0.6, created on 2011-02-21 13:36:05
         compiled from ".\templates\../lank1.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:101314d625c358ca619-64055500%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '50621072b5c8d4cd0e6a6f59daab464e8034f372' => 
    array (
      0 => '.\\templates\\../lank1.tpl.htm',
      1 => 1298291513,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '101314d625c358ca619-64055500',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<html>
<head>
<title>4.1.1 Information inbakad i länkar andra html filen</title>
</head>
<body>
<A HREF="lank2.php?namn=<?php echo $_smarty_tpl->getVariable('namn')->value;?>
&adress=street-Avatar">
Namn: <?php echo $_smarty_tpl->getVariable('namn')->value;?>
, Adress: street-Avatar
</A>
<br/>
<A HREF="lank2.php?namn=<?php echo $_smarty_tpl->getVariable('namn')->value;?>
&adress=cpustreet">
Namn: <?php echo $_smarty_tpl->getVariable('namn')->value;?>
, Adress: cpustreet
</A>
</body>
</html>