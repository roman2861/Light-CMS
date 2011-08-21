<?php 

ob_start();
session_start();




include (getenv ("DOCUMENT_ROOT")."/include/config.php");

include (getenv ("DOCUMENT_ROOT")."/include/functions.php");

include (getenv ("DOCUMENT_ROOT")."/lang/russian.php");

mysqlcon();

include ("chklogin.php");

$pagename = 'Редактирование модулей';

if ($_GET["action"] == 'tdel') {

$idt = $_GET["id"];


$delete = mysql_query("DELETE FROM pages WHERE id = "._filter($idt)."");




if ($delete == 'true')
{
	?>
    Страница удалена!
    <?
	exit;
}
else
{
	?>
    Ошибка системы!
    <?
}
}
require("adminskin/head.php");
$query = mysql_query("SELECT id,dir FROM modules WHERE aedit='0' ORDER BY id DESC");
$query2 = mysql_query("SELECT id,dir FROM modules WHERE aedit='1' ORDER BY id DESC");
if (mysql_num_rows($query) > 0 || mysql_num_rows($query2) > 0)
{
$rower = mysql_fetch_array($query);
?>
    <div id="rightside">
            <div class="headings alt">
                <h2><?=$pagename?></h2>
            </div>
            <div class="contentbox">
            	<table width="100%">
                	<thead>
                    	<tr>
                        	<th>Директория</th>
                            <th>Информация</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php		
if (mysql_num_rows($query) > 0)
{
	do 
{
$id = $rower['id'];
$name = $rower['dir'];
print ("
<tr><td>$name</td>
    <td id='status_$id'>Работает</td>
    <td><a href='javascript://' onclick=\"$('#status_$id').load('delmod.php?id=$id');return false;\"><img SRC='images/icons/icon_delete.png' alt='Удалить' /></a> </td>
</tr>
");

}

while ($rower = mysql_fetch_array($query));
}
if (mysql_num_rows($query2) > 0)
{
$rower2 = mysql_fetch_array($query2);
do 
{
$id = $rower2['id'];
$name = $rower2['dir'];
print ("
<tr><td><a href='adminmod.php?dir=$name'>$name</a></td>
    <td id='status_$id'>Работает</td>
    <td><a href='javascript://' onclick=\"$('#status_$id').load('delmod.php?id=$id');return false;\"><img SRC='images/icons/icon_delete.png' alt='Удалить' /></a> </td>
</tr>
");

}

while ($rower2 = mysql_fetch_array($query2));
}
?>
                    </tbody>
                </table>

<?

?>
</div>
</div>
</div>
</div>
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
            <p align="center">Модов нет</p>
            </div>
            </div>
<?
}
include("menu.php");