<?php 

ob_start();
session_start();




include (getenv ("DOCUMENT_ROOT")."/include/config.php");

include (getenv ("DOCUMENT_ROOT")."/include/functions.php");

include (getenv ("DOCUMENT_ROOT")."/lang/russian.php");

mysqlcon();

include ("chklogin.php");

$pagename = $adminlang['editpage'];

if ($_GET["action"] == 'tdel') {

$idt = $_GET["id"];


$delete = mysql_query("DELETE FROM pages WHERE id = '"._filter($idt)."'");




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

if ($_POST) {


if (empty($_POST['name']) || empty($_POST['text']) || empty($_POST['page'])) 
	die("Все поля обязательны для заполнения."); 


$name = htmlspecialchars($_POST['name']);
$name = iconv( "utf-8", "windows-1251", $name);
$text = $_POST['text'];
$text = iconv( "utf-8", "windows-1251", $text);
$page = $_POST['page'];
$page = iconv( "utf-8", "windows-1251", $page);
$ids = $_POST['sid'];
$proverka = mysql_query("SELECT * FROM pages WHERE page='"._filter($page)."'");

if ($_POST['vis'] == 'yes') {$vindex = 1; } else {$vindex = 0;};
if(mysql_num_rows($proverka) >= 2)
{
m_error("Такая страница уже существует");
exit;
}

	$send = mysql_query("UPDATE pages SET  name = '"._filter($name)."', text='"._filter2($text)."', page='"._filter($page)."', visible='"._filter($vindex)."' WHERE id='"._filter($ids)."'");



if ($send == 'true')
{
?>Вы успешно отредактировали страницу
<?
}

else 

{
?>
Ошибка!
<?
}
exit;
}


if ($_GET["action"] == 'edit' || !empty($_GET["id"])) {

$id =$_GET["id"];
$query = mysql_query("SELECT * FROM pages WHERE id='"._filter($id)."'");


$rower = mysql_fetch_array($query);


if (mysql_num_rows($query) == 0)

{

die ("Страница не существует!");

}


$title = $rower["name"];
$text = $rower["text"];
$page = $rower["page"];
$vindex = $rower["visible"];
require("adminskin/head.php");
?>
    <div id="rightside">
            <div class="headings alt">
                <h2><?=$pagename?></h2>
            </div>
            <div class="contentbox">
<form action="editpage.php" method="post" id="form">
<p align="center">Название: <br><br><input type="text" name="name" id="textfield" class="inputbox" value="<?=$title?>" /><br /><br></p>
<p align="center">Адрес(сайт.рф/адрес): <br><br><input type="text" name="page" id="textfield" class="inputbox" value="<?=$page?>" /><br /><br></p>
<p align="center"><textarea style="width:500px; height:300px" id='input' name="text"><?=$text?></textarea></p><br /><br>
Видимость в верхнем меню: <input type="checkbox" name="vis" value="yes" <?php if ($vindex == 1) echo 'checked' ?>><br /><br />
<input name="sid" type="hidden" value="<?=$id?>">
<input type="submit" value="Добавить" class="btn" /><b id="otvet"></b>
</form>

</div>
</div>
<?php
require("menu.php");
exit;
}
require("adminskin/head.php");
$query = mysql_query("SELECT id,name FROM pages WHERE mod_id = '0' ORDER BY id DESC");
if (mysql_num_rows($query) > 0)
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
                        	<th>Название</th>
                            <th>Информация</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php		
do 
{
$id = $rower['id'];
$name = $rower['name'];
$rusname = rus2translit($name); 
$rusname = strtolower($rusname);
$comments = $rower['comments'];
$views = $rower['views'];
print ("
<tr><td><a href='/pages_$id_$rusname.html'>$name</a></td>
    <td id='status_$id'>Работает</td>
    <td><a href='editpage.php?action=edit&id=$id'><img SRC='images/icons/icon_edit.png' alt='Редактировать' /></a><a href='javascript://' onclick=\"$('#status_$id').load('delpage.php?id=$id');return false;\"><img SRC='images/icons/icon_delete.png' alt='Удалить' /></a> </td>
</tr>
");

}

while ($rower = mysql_fetch_array($query));
?>
                    </tbody>
                </table>

<?
print ("</table>");
}
else
{
?>
<div id="rightside">
            <div class="headings alt">
                <h2><?=$pagename?></h2>
            </div>
            <div class="contentbox">
<p align="center">Вы не создали ни одной страницы!</p>

<?
}
$query = mysql_query("SELECT id,name FROM pages WHERE mod_id not like '0' ORDER BY id DESC");
if (mysql_num_rows($query) > 0)
{
$rower = mysql_fetch_array($query);
?>
<h2><p align="center">Редактирование страниц в модулях</p></h2><br />
            	<table width="100%">
                	<thead>
                    	<tr>
                        	<th>Название</th>
                            <th>Информация</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php		
do 
{
$id = $rower['id'];
$name = $rower['name'];
$rusname = rus2translit($name); 
$rusname = strtolower($rusname);
$comments = $rower['comments'];
$views = $rower['views'];
print ("
<tr><td><a href='/pages_$id_$rusname.html'>$name</a></td>
    <td id='status_$id'>Работает</td>
    <td><a href='editpage.php?action=edit&id=$id'><img SRC='images/icons/icon_edit.png' alt='Редактировать' /></a></td>
</tr>
");

}

while ($rower = mysql_fetch_array($query));
?>
                    </tbody>
                </table>
            </div>
</div>
<?
print ("</table>");
}
?>
</div>
</div>
</div>
</div>
<?
include("menu.php");