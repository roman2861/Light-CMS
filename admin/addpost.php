<?php

ob_start();
session_start();




include (getenv ("DOCUMENT_ROOT")."/include/config.php");

include (getenv ("DOCUMENT_ROOT")."/include/functions.php");

include (getenv ("DOCUMENT_ROOT")."/lang/russian.php");

mysqlcon();

include ("chklogin.php");

$pagename = $adminlang['addpost'];




if ($_POST) {
if (empty($_POST['name']) || empty($_POST['text'])) 
{
	?>
    Вы заполнили не всё
    <?
	exit;
}




$name = htmlspecialchars($_POST['name']);
$name = iconv( "utf-8", "windows-1251", $name);
$category = htmlspecialchars($_POST['category']);
$category = iconv( "utf-8", "windows-1251", $category);


$text = $_POST['text'];
$text = iconv( "utf-8", "windows-1251", $text);
 if ($_POST['vindex'] == 'on') {$vindex = 1; } else {$vindex = 0;};
 
 $catquery = mysql_query("SELECT catvis FROM categories WHERE id = "._filter($category)."");


$rower = mysql_fetch_array($catquery);

if ($rower['catvis'] == 1) {$vindex = 1;}

$date = time();

$send = mysql_query("INSERT INTO posts VALUES(NULL, '"._filter($category)."','"._filter($name)."','"._filter2($text)."','"._filter($date)."', 0, 0, "._filter($vindex).", 0)");

if ($send == 'true')
{
	?>
    Вы добавили новость!
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
}



else {
?>
            	<form id="form" action="addpost.php" method="post">
                
<input name="posting" type="hidden" value="true">
            		<p align="center">
                        <label for="textfield"><strong>&#1048;&#1084;&#1103;:</strong></label>
                        <input type="text" name="name" id="textfield" class="inputbox" />
            		</p>
            		<p align="center">
                  <label for="smallbox"><strong>&#1050;&#1072;&#1090;&#1077;&#1075;&#1086;&#1088;&#1080;&#1103;:</strong></label>
<select name="category"> <?php
$catquery = mysql_query("SELECT * FROM categories");
if (mysql_num_rows($catquery) > 0)
{
$crower = mysql_fetch_array($catquery);
do 
{
echo "<option value='".$crower['id']."'>".$crower['name'];
}
while ($crower = mysql_fetch_array($catquery));
}
?>
</select><br /><br />
            	<p align="center"><textarea style="width:500px; height:300px" id='text' name="text"></textarea></p>
<p align="center">Показывать на главной: <input type="checkbox" name="vindex" value="yes"></p>
<br />
<br />
                <input type="submit" value="Сохранить" class="btn" /><b id="otvet"></b>
                </form>

<?php
 } ?>