<?php

session_start();



include (getenv ("DOCUMENT_ROOT")."/include/config.php");

include (getenv ("DOCUMENT_ROOT")."/include/functions.php");

include (getenv ("DOCUMENT_ROOT")."/lang/russian.php");

$pagename = $adminlang['editcomm'];
include ("adminskin/head.php");

mysqlcon();

include ("chklogin.php");

if ($_GET["action"] == 'del') {

$idt = $_GET["id"];


$idp = $_GET["postid"];


$delete = mysql_query("DELETE FROM comments WHERE id = '"._filter($idt)."'");
mysql_query("UPDATE posts SET comments = comments - 1 WHERE id = '"._filter($idp)."'");


if ($delete == 'true')
{die ('<br><h2>Удаление комментариев</h2><br> Вы успешно удалили комментарий <a href="editcomm.php"> Назад</a>!'); }else {die ("Ошибка!");}


exit;

}

if (!empty($_POST['text'])) {



if (empty($_POST['text'])) 
	die( "<br><h2>".$adminlang['editcomm']."</h2><br>".$adminlang['addcat_empty']); 


$text = $_POST['text'];



$ids = $_POST['sid'];

	$send = mysql_query("UPDATE comments SET text ='"._filter2($text)."' WHERE id='"._filter($ids)."'");




if ($send == 'true')
{


die ("<br><h2>".$adminlang['editcomm']."</h2><br>".$adminlang['editcomm_suc']);
}

else 

{
die ("<br><h2>".$adminlang['editcomm']."</h2><br>".$errorlang);
}
exit;
}

if ($_GET["action"] == 'edit' || !empty($_GET["id"])) {

$id =$_GET["id"];
$query = mysql_query("SELECT * FROM comments WHERE id='"._filter($id)."'");


$rower = mysql_fetch_array($query);


if (mysql_num_rows($query) == 0)

{

die ("Категория не существует!");

}


$text = $rower["text"];


?>
    <div id="rightside">
            <div class="headings alt">
                <h2><?=mysql_real_escape_string($pagename)?></h2>
            </div>
            <div class="contentbox">
<form action="editcomm.php" method="post">
<p align="center"><textarea style="width:500px; height:300px" id='input' name="text"></textarea></p><br /><br>
<input name="sid" type="hidden" value="<?=$id?>">
<input type="submit" value="<?=$lang['add']?>" />
</form>
</div>
</div>
<?
include("menu.php");
exit;
}


if ($_GET["action"] == 'del') {

$idt = $_GET["id"];


$idp = $_GET["postid"];


$delete = mysql_query("DELETE FROM comments WHERE id = '"._filter($idt)."'");
mysql_query("UPDATE posts SET comments = comments - 1 WHERE id = '"._filter($idp)."'");


if ($delete == 'true')
{die ('    <div id="rightside">
            <div class="headings alt">
                <h2>$pagename</h2>
            </div>
            <div class="contentbox">Комментарий удалён!'); }else {die ("Ошибка!");}




}


$query = mysql_query("SELECT id,postid,text,author,date FROM comments ORDER BY id DESC");



if (mysql_num_rows($query) > 0)
{
?>
    <div id="rightside">
            <div class="headings alt">
                <h2><?=$pagename?></h2>
            </div>
            <div class="contentbox">
            	<table width="100%">
                	<thead>
                    	<tr>
                        	<th>Пост</th>
                            <th>Содержание</th>
                            <th>Автор</th>
                            <th>Дата</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>  
            
            <?php


$rower = mysql_fetch_array($query);

do 
{
$id = $rower['id'];

$name = $rower['text'];

$author = $rower['author'];

$date = $rower['date'];

$postid = $rower['postid'];

$postx = $post[$postid - 1];

$postquery = mysql_query("SELECT title FROM posts WHERE id='"._filter($postid)."'");
$prower = mysql_fetch_array($postquery);
$postx = $prower['title'];



$date = mkprettytime($date);



print ("
     <tr>
              <td>$postx</td>
              <td>$name</td>
              <td>$author</td>
              <td>$date</td>
			         <td><a href='editcomm.php?action=del&id=$id&postid=$postid'><img SRC='images/icons/icon_delete.png' alt='Удалить' /></a></td>
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
            <p align="center">Комментариев нет</p>
            </div>
            </div>
<?
}
include("menu.php");