<?php /* Smarty version Smarty-3.0.8, created on 2011-07-07 02:17:31
         compiled from "menu.php" */ ?>
<?php /*%%SmartyHeaderCode:99604e14defb805f02-14548744%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3f52e01d7da8c692bc9085a151022341ced05b87' => 
    array (
      0 => 'menu.php',
      1 => 1309793024,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '99604e14defb805f02-14548744',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<<?php ?>?

mysqlcon();

$query = mysql_query("SELECT id, name FROM pages LIMIT 8") or die(mysql_error());
while ($rowing = mysql_fetch_array($query, MYSQL_NUM)) {
        printf ('<li><a href="./pages_%s_%s.html" class="fly">%s</a></li>
',$rowing[0], $rowing[1], $rowing[1]);  
    }

    mysql_free_result($query);
