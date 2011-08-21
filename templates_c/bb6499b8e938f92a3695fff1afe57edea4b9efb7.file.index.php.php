<?php /* Smarty version Smarty-3.0.8, created on 2011-07-07 20:57:03
         compiled from "index.php" */ ?>
<?php /*%%SmartyHeaderCode:49054e15e55f3d86d5-16823268%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bb6499b8e938f92a3695fff1afe57edea4b9efb7' => 
    array (
      0 => 'index.php',
      1 => 1310054883,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '49054e15e55f3d86d5-16823268',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<<?php ?>?php 

include("include/init.php");
mysqlcon();
$smarty->display('header.tpl');
// Получение данных их БД (в виде ассоциативного массива)
$result = mysql_query("SELECT * FROM posts ORDER BY id LIMIT 0,10");     
$rows=array();
while ($row=mysql_fetch_array($result))
   $rows[]=$row;
$smarty->assign('news', $rows);   
$smarty->display('right.tpl');
$smarty->display('content.tpl');
$smarty->display('footer.tpl');
?<?php ?>>