<?php 

ob_start();
session_start();




include (getenv ("DOCUMENT_ROOT")."/include/config.php");

include (getenv ("DOCUMENT_ROOT")."/include/functions.php");

include (getenv ("DOCUMENT_ROOT")."/lang/russian.php");

mysqlcon();

include ("chklogin.php");

if ($_GET["action"] == 'tdel') {

$idt = $_GET["id"];


$delete = mysql_query("DELETE FROM posts WHERE id = '"._filter($idt)."'");
mysql_query("DELETE FROM comments WHERE postid = '"._filter($idt)."'");
mysql_query("DELETE FROM views WHERE postid = "._filter($idt)."'");



if ($delete == 'true')
{die ('<br><h2>Удаление поста</h2><br>Вы успешно удалили пост <a href="editpost.php"> Назад</a>!'); }else {die ("Ошибка!");}



}

$pagename = $adminlang['editpost'];
if (!empty($_POST['name'])) {


if (empty($_POST['name']) || empty($_POST['text'])) 
{
?>
Все поля обязательны для заполнения!
<?
exit;
}
$name = htmlspecialchars($_POST['name']);
$name = iconv( "utf-8", "windows-1251", $name);
$category = htmlspecialchars($_POST['category']);
$category = iconv( "utf-8", "windows-1251", $category);
$text = $_POST['text'];
$text = iconv( "utf-8", "windows-1251", $text);


if ($_POST['vindex'] == 'yes') {$vindex = 1; } else {$vindex = 0;};

$ids = $_POST['sid'];

	$send = mysql_query("UPDATE posts SET catid ='"._filter($category)."', title = '"._filter($name)."', text='"._filter2($text)."',vindex = '"._filter($vindex)."' WHERE id='"._filter($ids)."'");



if ($send == 'true')
{
?>
Пост отредактирован!
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
$query = mysql_query("SELECT * FROM posts WHERE id='"._filter($id)."'");


$rower = mysql_fetch_array($query);


if (mysql_num_rows($query) == 0)

{
?>
Пост не существует!
<?
exit;

}

$cat = $rower["catid"];
$title = $rower["title"];
$text = $rower["text"];
$vindex = $rower["vindex"];

require("adminskin/head.php");
?>
    <div id="rightside">
            <div class="headings alt">
                <h2><?=$pagename?></h2>
            </div>
            <div class="contentbox">
<form action="editpost.php" id="form" method="post">
<p align="center">Название: <br><br><input type="text" id="textfield" class="inputbox" name="name" value="<?=$title?>" /><br /><br></p>
<p align="center">Категория:<br><br>
<select name="category"> <?php
$catquery = mysql_query("SELECT * FROM categories");


if (mysql_num_rows($catquery) > 0)
{
$crower = mysql_fetch_array($catquery);

do 
{
$i = $i + 1;


if ($i == $cat) {
echo "<option value='".$crower['id']."' selected>".$crower['name'];
}

if ($crower['id'] != $cat) {
echo "<option value='".$crower['id']."'>".$crower['name'];
}
}

while ($crower = mysql_fetch_array($catquery));

}

?>


</select></p>
<p align="center"><textarea style="width:500px; height:300px" id='input' name="text"><?=$text?></textarea></p><br /><br>
<input type="checkbox" name="vindex" value="yes" <?php if ($vindex == 1) echo 'checked' ?>>
&#1053;&#1072; &#1075;&#1083;&#1072;&#1074;&#1085;&#1091;&#1102;
<br><br>

<input name="sid" type="hidden" value="<?=$id?>">
<input type="submit" value="Добавить" class="btn" /><b id="otvet"></b>
</form>
</div>
</div>
<?php
include("menu.php");
exit;
}

$query = mysql_query("SELECT id,catid,title FROM posts ORDER BY id DESC");


$catquery = mysql_query("SELECT * FROM categories");



if (mysql_num_rows($catquery) > 0)
{
$crower = mysql_fetch_array($catquery);

do 
{

$category[] = $crower['name'];

}

while ($crower = mysql_fetch_array($catquery));

}

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
                        	<th>Категория</th>
                            <th>Название</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php
			
do 
{
$id = $rower['id'];

$name = $rower['title'];

$catid = $rower['catid'];

$cat = $category[$catid - 1];


$rusname = rus2translit($name); 

$rusname = strtolower($rusname);


  
			
		

print ("
<tr>
              <td>$cat</td>
              <td><a href='/posts_$id");
			  
			print ("_$rusname.html'>$name</a></td>
              <td><a href='editpost.php?action=edit&id=$id'>Редактировать</a> </td>
              <td><a href='editpost.php?action=tdel&id=$id'>Удалить</a>  </td>
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
            <p align="center">Постов нет</p>
            </div>
            </div>
<?
}
include("menu.php");