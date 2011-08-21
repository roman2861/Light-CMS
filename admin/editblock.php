<?php 

ob_start();
session_start();




include (getenv ("DOCUMENT_ROOT")."/include/config.php");

include (getenv ("DOCUMENT_ROOT")."/include/functions.php");

include (getenv ("DOCUMENT_ROOT")."/lang/russian.php");

mysqlcon();

include ("chklogin.php");

$pagename = $adminlang['editblock'];


if ($_GET["action"] == 'del') {

$idt = $_GET["id"];

print( "<br><h2>".$adminlang['editblock']."</h2><br>".$adminlang['delblock_chk']."<br><br> <a href='editblock.php?action=tdel&id=$idt'>".$lang['yes']."</a> <a href='editblock.php'>".$lang['no']."</a>");

exit;

}



if (!empty($_POST['name'])) {



if (empty($_POST['name'])) 
	die( "<br><h2>".$adminlang['editblock']."</h2><br>".$adminlang['addcat_empty']); 


$name = htmlspecialchars($_POST['name']);
$name = iconv( "utf-8", "windows-1251", $name);
$file = htmlspecialchars($_POST['file']);
$file = iconv( "utf-8", "windows-1251", $file);
$pos = htmlspecialchars($_POST['pos']);
$pos = iconv( "utf-8", "windows-1251", $pos);
$ids = $_POST['sid'];
$q = mysql_query("SELECT * FROM blocks WHERE id='"._filter($ids)."' AND mod_id='0'");
if(mysql_num_rows($q) == 0)
{
	$send = mysql_query("UPDATE blocks SET name ='"._filter($name)."', position = '"._filter($pos)."' WHERE id='".$ids."'");
}
else
{
	$send = mysql_query("UPDATE blocks SET name ='"._filter($name)."', file = '"._filter($file)."', position = '"._filter($pos)."' WHERE id='"._filter($ids)."'");
}
if ($send == 'true')
{
?>
Блок изменён!
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
$query = mysql_query("SELECT * FROM blocks WHERE id='"._filter($id)."'");


$rower = mysql_fetch_array($query);


if (mysql_num_rows($query) == 0)

{
?>
Блока не существует!
<?
exit;
}


$name = $rower["name"];
$file = $rower["file"];
$pos = $rower["position"];
require("adminskin/head.php");
$q = mysql_query("SELECT * FROM blocks WHERE id='"._filter($id)."' AND mod_id='0'");
if(mysql_num_rows($q) == 0)
{
	$q = 1;
}
?>
    <div id="rightside">
            <div class="headings alt">
                <h2><?=$pagename?></h2>
            </div>
            <div class="contentbox">
<form action="editblock.php" method="post" id="form">
<?=mysql_real_escape_string($lang['name'])?>  <br><br><input type="text" id="textfield" class="inputbox" name="name" value="<?=mysql_real_escape_string($name)?>" />
<br /><br>
<?
if($q == 1)
{
}
else
{
?>

<?=mysql_real_escape_string($adminlang['filename'])?><br><br /><select name="file">
<?php  

$temps = scandir(getenv ("DOCUMENT_ROOT").'/blocks');

$result = count($temps);

$i = 0;

while ($i < $result - 2) {
if ($temps[2 + $i] == $file) {

echo "<option value='".$temps[2 + $i]."'selected>".$temps[2 + $i];
}

if ($temps[2 + $i] != $file) {
echo "<option value='".$temps[2 + $i]."'>".$temps[2 + $i];
}


$i++;

}


?>
</select><br><br> 
<?
}
?>
<?=mysql_real_escape_string($lang['position'])?> <br><br><input type="text" id="textfield" class="inputbox" name="pos" value="<?=_filter($pos)?>"/><br /><br>

<br><br> 

<input name="sid" type="hidden" value="<?=$id?>">
<input type="submit" value="Submit" class="btn" />
</form>
</div>
</div>
<?php
include("menu.php");
exit;
}

$query = mysql_query("SELECT * FROM blocks WHERE mod_id='0'");


require("adminskin/head.php");
?>
    <div id="rightside">
            <div class="headings alt">
                <h2><?=$pagename?></h2>
            </div>
            <div class="contentbox">
            <?
if (mysql_num_rows($query) > 0)
{
$rower = mysql_fetch_array($query);

?>
            	<table width="100%">
                	<thead>
                    	<tr>
                        	<th>Название</th>
                            <th>Файл</th>
                            <th>Позиция</th>
                            <th>Состояние</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php
			
do 
{
$id = $rower['id'];

$name = $rower['name'];

$file = $rower['file'];

$pos = $rower['position'];

print ("
<tr>
         
              <td>$name</td>
			  <td>$file</td>
			  <td>$pos</td>
              <td id='status_$id'>Работает</td>
              <td><a href='editblock.php?action=edit&id=$id'><img SRC='images/icons/icon_edit.png' alt='Редактировать' /></a><a href='javascript://' onclick=\"$('#status_$id').load('delblock.php?id=$id');return false;\"><img SRC='images/icons/icon_delete.png' alt='Удалить' /></a></td>
            </tr>
");

}

while ($rower = mysql_fetch_array($query));

}

?>
</tbody>
</table>
<?
$query1 = mysql_query("SELECT * FROM blocks WHERE mod_id not like '0'");
if (mysql_num_rows($query1) > 0)
{
$rower = mysql_fetch_array($query1);
?>
<h2><p align="center">Редактирование блоков в модулях</p></h2><br />
            	<table width="100%">
                	<thead>
                    	<tr>
                        	<th>Название</th>
                            <th>Файл</th>
                            <th>Позиция</th>
                            <th>Состояние</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php
			
do 
{
$id = $rower['id'];

$name = $rower['name'];

$file = $rower['file'];

$pos = $rower['position'];

print ("
<tr>
         
              <td>$name</td>
			  <td>$file</td>
			  <td>$pos</td>
              <td id='status_$id'>Работает</td>
              <td><a href='editblock.php?action=edit&id=$id'><img SRC='images/icons/icon_edit.png' alt='Редактировать' /></a></td>
            </tr>
");

}

while ($rower = mysql_fetch_array($query));
?>
</tbody>
</table>
<?
}
else
{
?>
            <p align="center">Блоков нет</p>
<?
}
?>
            </div>
            </div>
            <?
            include("menu.php");