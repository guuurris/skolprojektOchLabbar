<?php /* Smarty version Smarty-3.0.6, created on 2011-03-23 01:01:54
         compiled from ".\templates\../../template/aboveframe.tpl.htm" */ ?>
<?php /*%%SmartyHeaderCode:228814d893872b43991-25190243%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fb4e689bc039104ed58eb3bc531dbc376d95a264' => 
    array (
      0 => '.\\templates\\../../template/aboveframe.tpl.htm',
      1 => 1300737260,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '228814d893872b43991-25190243',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<html>
<head>
<title><?php echo $_smarty_tpl->getVariable('title')->value;?>
</title>
<link rel="stylesheet" type="text/css" href="../css/menutable.css" /> 
<script type="text/javascript" src="../javascript/menuscript.js"></script>
</head>

<body>
<table width="500px" height="2,5%" align="center">
 <tr bgcolor="#400400">
  <td onmouseover="showmenu('home')" onmouseout="hidemenu('home')">
   <a href="index.php" TARGET=pageFrame><?php echo $_smarty_tpl->getVariable('homebutton')->value;?>
</a><br />
   <table class="menu" id="home" width="120">
   </table>
  </td>
  <td onmouseover="showmenu('about')" onmouseout="hidemenu('about')">
   <a href="index.php?show=About" TARGET=pageFrame ><?php echo $_smarty_tpl->getVariable('aboutbutton')->value;?>
</a><br />
   <table class="menu" id="about" width="120">
   <tr><td class="menu"><a href="index.php?show=Page" TARGET=pageFrame ><?php echo $_smarty_tpl->getVariable('page')->value;?>
</a></td></tr>
   <tr><td class="menu"><a href="index.php?show=Information" TARGET=pageFrame><?php echo $_smarty_tpl->getVariable('contact')->value;?>
</a></td></tr>

   </table>
  </td>
  <td onmouseover="showmenu('members')" onmouseout="hidemenu('members')">
   <a href="index.php?show=Members" TARGET=pageFrame><?php echo $_smarty_tpl->getVariable('membersbutton')->value;?>
</a><br />
   <table class="menu" id="members" width="120">
   <tr><td class="menu"><a href="index.php?show=Upload" TARGET=pageFrame><?php echo $_smarty_tpl->getVariable('upload')->value;?>
</a></td></tr>
   <tr><td class="menu"><a href="index.php?show=Profile" TARGET=pageFrame><?php echo $_smarty_tpl->getVariable('profile')->value;?>
</a></td></tr>
   </table>
  </td>

   <td onmouseover="showmenu('login')" onmouseout="hidemenu('login')">
   <a href="index.php?show=Login" TARGET=pageFrame><?php echo $_smarty_tpl->getVariable('loginbutton')->value;?>
</a><br />
   <table class="menu" id="login" width="120"/>
  </td>
  
  </td>
 </tr>
</table>
</body>
</html>