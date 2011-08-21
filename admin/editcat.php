<?php 

ob_start();
session_start();




include (getenv ("DOCUMENT_ROOT")."/include/config.php");

include (getenv ("DOCUMENT_ROOT")."/include/functions.php");

include (getenv ("DOCUMENT_ROOT")."/lang/russian.php");

mysqlcon();

include ("chklogin.php");

$pagename = $adminlang['editcat_edit'];

if ($_GET["action"] == 'del') {

$idt = $_GET["id"];

print( "<br><h2>".$adminlang['editcat_del']."</h2><br>".$adminlang['delcat_chk']."<br><br> <a href='editcat.php?action=tdel&id=$idt'>".$lang['yes']."</a> <a href='editcat.php'>".$lang['no']."</a>");

exit;

}



if ($_POST) {



if (empty($_POST['name'])) 
	die( "<br><h2>".$adminlang['addcat']."</h2><br>".$adminlang['addcat_empty']); 


$name = htmlspecialchars($_POST['name']);
$name = iconv( "utf-8", "windows-1251", $name);
 if ($_POST['vсindex'] == 'yes') {$vindex = 1; } else {$vindex = 0;};

$ids = $_POST['sid'];

	$send = mysql_query("UPDATE categories SET name ='"._filter($name)."', catvis = '"._filter($vindex)."' WHERE id='"._filter($ids)."'");
	mysql_query("UPDATE posts SET vindex = '"._filter($vindex)."' WHERE catid = '"._filter($ids)."'");



if ($send == 'true')
{
?>
Категория изменена!
<?
exit;
}

else 

{
?>
Ошибка!
<?
exit;
}
exit;
}


if ($_GET["action"] == 'edit' || !empty($_GET["id"])) {

$id =$_GET["id"];
$query = mysql_query("SELECT * FROM categories WHERE id='"._filter($id)."'");


$rower = mysql_fetch_array($query);


if (mysql_num_rows($query) == 0)

{
?>
Таких тут нет:)
<?
exit;
}


$name = $rower["name"];
$vindex = $rower["catvis"];
require("adminskin/head.php");

?>
    <div id="rightside">
            <div class="headings alt">
                <h2><?=$pagename?></h2>
            </div>
            <div class="contentbox">
<form action="editcat.php" id="form" method="post">
<?=mysql_real_escape_string($lang['name'])?>  <br><br><input id="textfield" class="inputbox" type="text" name="name" value="<?=mysql_real_escape_string($name)?>" /><br /><br>


<br><br> 

<input type="checkbox" name="vсindex" value="yes" <?php if ($vindex == 1) echo 'checked' ?>>Показывать посты из категории на главной странице<br><br>
<input name="sid" type="hidden" value="<?=$id?>">
<input type="submit" value="<?=mysql_real_escape_string($lang['add'])?>" class="btn" /><b id="otvet"></b>
</form>
</div>
</div>
<?php
include("menu.php");
exit;
}

$query = mysql_query("SELECT * FROM categories");

require("adminskin/head.php");

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
                            <th>Состояние</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>            <?php
			
do 
{
$id = $rower['id'];

$name = $rower['name'];


print ("
<tr>
         
              <td><a href='/posts_$id.html'>$name</a></td>
              <td id='status_$id'>Работает</td>
              <td><a href='editcat.php?action=edit&id=$id'><img SRC='images/icons/icon_edit.png' alt='Редактировать' /></a><a href='javascript://' onclick=\"$('#status_$id').load('delcat.php?id=$id');return false;\"><img SRC='images/icons/icon_delete.png' alt='Удалить' /></a></td>
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
}
else
{
?>
    <div id="rightside">
            <div class="headings alt">
                <h2><?=$pagename?></h2>
            </div>
            <div class="contentbox">
            <p align="center">Категорий нет</p>
            </div>
            </div>
<?
}
include("menu.php");