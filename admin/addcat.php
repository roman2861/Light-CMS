<?php

ob_start();
session_start();





include (getenv ("DOCUMENT_ROOT")."/include/config.php");

include (getenv ("DOCUMENT_ROOT")."/include/functions.php");

include (getenv ("DOCUMENT_ROOT")."/lang/russian.php");


mysqlcon();

$pagename = $adminlang['addcat'];




include ("chklogin.php");

if ($_POST) {


if (empty($_POST['name'])) 
{
?>
Введите название категории!
<?
exit;
}
$name = htmlspecialchars($_POST['name']);
$name = iconv( "utf-8", "windows-1251", $name);
 if ($_POST['vindex'] == 'on') {$vindex = 1; } else {$vindex = 0;};

$send = mysql_query("INSERT INTO categories VALUES(NULL, '"._filter($name)."', '"._filter($vindex)."')");

if ($send == 'true')
{
?>
Категория добавлена!
<?
exit;
}

else 

{
?>
<?=$errorlang?>
<?
exit;
}
}



else {

require("adminskin/head.php");
?>
    <!-- Right Side/Main Content Start -->
    <div id="rightside">
    
           <!-- Graphs Box Start -->
<div class="contentcontainer ui-tabs ui-widget ui-widget-content ui-corner-all" id="graphs">            <div class="headings alt">
                <h2 class="left">Меню</h2>
                <ul class="smltabs ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
<li class="ui-state-default ui-corner-top"><a href="addmod.php">Добавить модуль</a></li>
                	<li class="ui-state-default ui-corner-top"><a href="index.php">Добавить пост</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="addpage.php">Добавить страницу</a></li>
                    <li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"><a href="addcat.php">Добавить категорию</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="addblock.php">Добавить блок</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="adduser.php">Добавить администратора</a></li>
                </ul>
            </div>
            <div class="contentbox ui-tabs-panel ui-widget-content ui-corner-bottom" id="graphs-1">
<form id="form" action="addcat.php" method="post">
<?php echo $lang['name'] ?> <br><br><input type="text" id="textfield" class="inputbox" name="name" /><br /><br>
<br><br> 
<input type="checkbox" name="vindex" value="yes">Показывать посты из категории на главной странице<br><br>
<input name="posting" type="hidden" value="true">
<input type="submit" value="Submit" class="btn" /><b id="otvet"></b>
</form>
            </div>
        </div>
        <!-- Graphs Box End -->
    </div>
    <!-- Right Side/Main Content End -->
<?
include("menu.php"); } ?>