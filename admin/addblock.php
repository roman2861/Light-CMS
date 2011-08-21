<?php

ob_start();
session_start();





include (getenv ("DOCUMENT_ROOT")."/include/config.php");

include (getenv ("DOCUMENT_ROOT")."/include/functions.php");

include (getenv ("DOCUMENT_ROOT")."/lang/russian.php");


mysqlcon();

$pagename = $adminlang['addblock'];




include ("chklogin.php");

if ($_POST) {


if (empty($_POST['name'])) 
{
?>
Введите название блока!
<?
exit;
}
$name = htmlspecialchars($_POST['name']);
$name = iconv( "utf-8", "windows-1251", $name);
$file = htmlspecialchars($_POST['file']);
$file = iconv( "utf-8", "windows-1251", $file);
$pos = htmlspecialchars($_POST['pos']);
$pos = iconv( "utf-8", "windows-1251", $pos);



$send = mysql_query("INSERT INTO blocks VALUES(NULL, '"._filter($name)."', '"._filter($file)."', '"._filter($pos)."')");

if ($send == 'true')
{
?>
Блок добавлен!
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
                    <li class="ui-state-default ui-corner-top"><a href="addcat.php">Добавить категорию</a></li>
                    <li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"><a href="addblock.php">Добавить блок</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="adduser.php">Добавить администратора</a></li>
                </ul>
            </div>
            <div class="contentbox ui-tabs-panel ui-widget-content ui-corner-bottom" id="graphs-1">
<form id="form" action="addblock.php" method="post">
<?php echo $lang['name'] ?> <br><br><input type="text" id="textfield" class="inputbox" name="name" /><br /><br>
<?php echo $adminlang['filename'] ?><br><br /><select name="file">
<?php  

$temps = scandir(getenv ("DOCUMENT_ROOT").'/blocks');

$result = count($temps);

$i = 0;

while ($i < $result - 2) {
if ($temps[2 + $i] == $theme) {

echo "<option value='".$temps[2 + $i]."'selected>".$temps[2 + $i];
}

if ($temps[2 + $i] != $theme) {
echo "<option value='".$temps[2 + $i]."'>".$temps[2 + $i];
}


$i++;

}


?>
</select><br><br> 

<?php echo $lang['position'] ?> <br><br><input type="text" name="pos" id="textfield" class="inputbox" /><br /><br>

                <input type="submit" value="Submit" class="btn" /><b id="otvet"></b>
                </form>
            </div>
        </div>
        <!-- Graphs Box End -->
    </div>
<?php
include('menu.php');
 } ?>