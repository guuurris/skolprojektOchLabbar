<?php /* Smarty version Smarty-3.0.6, created on 2011-02-21 13:31:56
         compiled from ".\templates\../lank1.htm" */ ?>
<?php /*%%SmartyHeaderCode:132614d625b3c7f0174-08104883%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '327024bd1aa96df0d4bb7b0c121efcc1cca78b65' => 
    array (
      0 => '.\\templates\\../lank1.htm',
      1 => 1298291513,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '132614d625b3c7f0174-08104883',
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