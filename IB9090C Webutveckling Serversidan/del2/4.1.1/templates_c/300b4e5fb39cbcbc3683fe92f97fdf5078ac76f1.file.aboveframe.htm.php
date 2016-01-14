<?php /* Smarty version Smarty-3.0.6, created on 2011-02-15 14:18:23
         compiled from ".\templates\../aboveframe.htm" */ ?>
<?php /*%%SmartyHeaderCode:44284d5a7d1fcc9fb6-74937332%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '300b4e5fb39cbcbc3683fe92f97fdf5078ac76f1' => 
    array (
      0 => '.\\templates\\../aboveframe.htm',
      1 => 1297774474,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '44284d5a7d1fcc9fb6-74937332',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<html>
<head>
<title><?php echo $_smarty_tpl->getVariable('home')->value;?>
</title>
<link rel="stylesheet" type="text/css" href="menutable.css" /> 
<script type="text/javascript" src="menuscript.js"></script>
</head>

<body>
<table width="50%" height="2,5%" align="center">
 <tr bgcolor="#400400">
  <td onmouseover="showmenu('home')" onmouseout="hidemenu('home')">
   <a href="/default.asp">Home</a><br />
   <table class="menu" id="home" width="120">
   </table>
  </td>
  <td onmouseover="showmenu('about')" onmouseout="hidemenu('about')">
   <a href="/default.asp">About</a><br />
   <table class="menu" id="about" width="120">
   <tr><td class="menu"><a href="/js/default.asp">Page</a></td></tr>
   <tr><td class="menu"><a href="/vbscript/default.asp">Contact Information</a></td></tr>

   </table>
  </td>
  <td onmouseover="showmenu('members')" onmouseout="hidemenu('members')">
   <a href="/site/site_validate.asp">Members Area</a><br />
   <table class="menu" id="members" width="120">
   <tr><td class="menu"><a href="/site/site_validate.asp">Upload file</a></td></tr>
   <tr><td class="menu"><a href="/site/site_validate.asp">Edit profile</a></td></tr>
   </table>
  </td>
    <td onmouseover="showmenu('login')" onmouseout="hidemenu('login')">
   <a href="/default.asp" color="Yellow">Login</a><br />
   <table class="menu" id="login" width="120">
   </table>
  </td>
 </tr>
</table>
</body>
</html>