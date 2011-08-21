<?php 

ob_start();
session_start();




include (getenv ("DOCUMENT_ROOT")."/include/config.php");

include (getenv ("DOCUMENT_ROOT")."/include/functions.php");

include (getenv ("DOCUMENT_ROOT")."/lang/russian.php");

mysqlcon();

include ("chklogin.php");

$pagename = $adminlang['edit_config'];


if (!empty($_POST['sitename'])) {



	
$name = htmlspecialchars($_POST['sitename']);
$name = iconv( "utf-8", "windows-1251", $name);
$slogan = htmlspecialchars($_POST['slogan']);
$slogan = iconv( "utf-8", "windows-1251", $slogan);
$theme = htmlspecialchars($_POST['theme']);
$theme = iconv( "utf-8", "windows-1251", $theme);
$sp = htmlspecialchars($_POST['startpage']);
$sp = iconv( "utf-8", "windows-1251", $sp);
	
if ($_POST['on'] == 'on') {$vindex = 1; } else {$vindex = 0;};
	
	$send = mysql_query("UPDATE config SET  value = '"._filter($name)."' WHERE name = 'sitename'");
		$send = mysql_query("UPDATE config SET  value = '"._filter($slogan)."' WHERE name = 'siteslogan'");
			$send = mysql_query("UPDATE config SET  value = '"._filter($theme)."' WHERE name = 'theme'");
				$send = mysql_query("UPDATE config SET  value = '"._filter($vindex)."' WHERE name = 'notworking'");
					$send = mysql_query("UPDATE config SET  value = '"._filter($sp)."' WHERE name = 'sp'");


if ($send == 'true')
{
?>
Настройки сохранены
<?
die;
}
else
{
	?>
    Ошибка
    <?
}


}

$query = mysql_query("SELECT * FROM config");

$roc = mysql_fetch_array($query);

do 
{

$config[] = $roc['value'];

}

while ($roc = mysql_fetch_array($query));



$sitename = $config[1];

$theme = $config[0];

$siteslogan = $config[2];

$nw = $config[9];

	


require("adminskin/head.php");
?>
    <div id="rightside">
            <div class="headings alt">
                <h2><?=$pagename?></h2>
            </div>
            <div class="contentbox">
<form id="form" action="editconfig.php" method="post">
<?php echo $adminlang['site_name'] ?><br><input id="textfield" class="inputbox" type="text" name="sitename" value="<?php echo $sitename?>" /><br /><br />
<?php echo $adminlang['site_slogan'] ?> <br><input id="textfield" class="inputbox" type="text" name="slogan" value="<?php echo $siteslogan?>"  /><br /><br />
<?php echo $adminlang['site_theme'] ?><br><br /><select id="textfield" class="inputbox" name="theme">
<?php  

$temps = scandir(getenv ("DOCUMENT_ROOT").'/templates');

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
</select>
<br /><br>
Отключить сайт: <input type="checkbox" id="checkbox" name="on" <?php if ($nw == 1) echo 'checked' ?>>
<br /><br>
<select id="textfield" class="inputbox" name="startpage">
<option value="">Стандартная</option>
<?
$query = mysql_query("SELECT id, name, page FROM pages") or die(mysql_error());
while ($rowing = mysql_fetch_array($query, MYSQL_NUM)) {
        printf ('<option value="%s">%s</option>',$rowing[2], $rowing[1]);  
    }

    mysql_free_result($query);
?>
</select>
<input type="submit" value="Изменить" class="btn" /><b id="otvet"></b>
</form>
</div>
</div>
<?
include('menu.php');