<?php 

ob_start();
session_start();




include (getenv ("DOCUMENT_ROOT")."/include/config.php");

include (getenv ("DOCUMENT_ROOT")."/include/functions.php");

include (getenv ("DOCUMENT_ROOT")."/lang/russian.php");

mysqlcon();

include ("chklogin.php");

$pagename = $adminlang['editpage'];


require("adminskin/head.php");
$dir = _filter($_GET['dir']);
if (!empty($dir))
{
?>
    <div id="rightside">
            <div class="headings alt">
                <h2><?=$pagename?></h2>
            </div>
            <div class="contentbox">
        <iframe width="100%" id="myframe" name="myframe" class="autoHeight" scrolling="auto" frameborder="0" src="modules/<?=$dir?>/index.php">
Включите поддержку IFrame!
</iframe>    
<?
}
else
{
?>
<div id="rightside">
            <div class="headings alt">
                <h2><?=$pagename?></h2>
            </div>
            <div class="contentbox">
<p align="center">Ошибка!</p>


<?
}
?>
</div>
</div>
<?
include("menu.php");