<?

include (getenv ("DOCUMENT_ROOT")."/include/config.php");

include (getenv ("DOCUMENT_ROOT")."/include/functions.php");

include (getenv ("DOCUMENT_ROOT")."/lang/russian.php");
include('chklogin.php');
mysqlcon();
$file = $_GET['dir'];
$open = @file_get_contents("../blocks/".$file."/install.txt", "r"); 
if(empty($open))
{
	echo "<h2><p align='center'>Ошибка!</p></h2>";
	exit;
}
$rand = ('#<name>(.*?)</name>#is'); //(.*?) - рандомное значение
preg_match_all($rand,$open,$out); 
for($i = 0; $i < count($out[1]); $i++) 
{$up1 = "".$out[1][$i]."";} 
$up = $up1.$up;
$rand = ('#<desc>(.*?)</desc>#is'); //(.*?) - рандомное значение
preg_match_all($rand,$open,$out); 
for($i = 0; $i < count($out[1]); $i++) 
{$up1 = "".$out[1][$i]."";} 
$up2 = $up1.$up2;
$rand = ('#<author>(.*?)</author>#is'); //(.*?) - рандомное значение
preg_match_all($rand,$open,$out); 
for($i = 0; $i < count($out[1]); $i++) 
{$up1 = "".$out[1][$i]."";} 
$up3 = $up1.$up3;
$rand = ('#<version>(.*?)</version>#is'); //(.*?) - рандомное значение
preg_match_all($rand,$open,$out); 
for($i = 0; $i < count($out[1]); $i++) 
{$up1 = "".$out[1][$i]."";} 
$up4 = $up1.$up4;
$rand = ('#<image>(.*?)</image>#is'); //(.*?) - рандомное значение
preg_match_all($rand,$open,$out); 
for($i = 0; $i < count($out[1]); $i++) 
{$up1 = "".$out[1][$i]."";} 
$up5 = $up1.$up5;
$rand = ('#<mysql>(.*?)</mysql>#is'); //(.*?) - рандомное значение
preg_match_all($rand,$open,$out); 
for($i = 0; $i < count($out[1]); $i++) 
{$up1 = "".$out[1][$i]."";} 
$up6 = $up1.$up6;
$rand = ('#<block>(.*?)</block>#is'); //(.*?) - рандомное значение
preg_match_all($rand,$open,$out); 
for($i = 0; $i < count($out[1]); $i++) 
{$up1 = "".$out[1][$i]."";} 
$up7 = $up1.$up7;
$rand = ('#<inst_folder>(.*?)</inst_folder>#is'); //(.*?) - рандомное значение
preg_match_all($rand,$open,$out); 
for($i = 0; $i < count($out[1]); $i++) 
{$up1 = "".$out[1][$i]."";} 
$up9 = $up1.$up9;
$rand = ('#<page>(.*?)</page>#is'); //(.*?) - рандомное значение
preg_match_all($rand,$open,$out); 
for($i = 0; $i < count($out[1]); $i++) 
{$up1 = "".$out[1][$i]."";} 
$up8 = $up1.$up8;
$rand = ('#<need>(.*?)</need>#is'); //(.*?) - рандомное значение
preg_match_all($rand,$open,$out); 
for($i = 0; $i < count($out[1]); $i++) 
{$up1 = "".$out[1][$i]."";} 
$up10 = $up1.$up10;
if(empty($up10))
{
	$up10 = 'no';
}
$rand = ('#<pagev>(.*?)</pagev>#is'); //(.*?) - рандомное значение
preg_match_all($rand,$open,$out); 
for($i = 0; $i < count($out[1]); $i++) 
{$up1 = "".$out[1][$i]."";} 
$up11 = $up1.$up11;
$rand = ('#<admin>(.*?)</admin>#is'); //(.*?) - рандомное значение
preg_match_all($rand,$open,$out); 
for($i = 0; $i < count($out[1]); $i++) 
{$up1 = "".$out[1][$i]."";} 
$up12 = $up1.$up12;
if($up8 == 1)
{
	$upp8 = @file_get_contents("../blocks/".$file."/page.html", "r"); 
}
elseif($up8 == 2)
{
	$upp8 = '<iframe width="100%" id="myframe" name="myframe" class="autoHeight" scrolling="auto" frameborder="0" src="../modules/'.$up9.'/index.php">
Включите поддержку IFrame!
</iframe>';
}

if($_GET['step'] == 2)
{
?>
<div>
<div style="height:100px">
<?
if($up5 == 1)
{
	?>
<img src="../blocks/<?=$up9?>/logo.png">
<?
}
else
{
	?>
<img src="http://img194.imageshack.us/img194/5166/10555585.png">
<?
}
?>

</div>
<hr><h2 align="center"><strong>Мастер установки плагинов</strong></h2>
<?
$sel = mysql_query("SELECT * FROM modules WHERE dir='"._filter($up10)."'");
if(mysql_num_rows($sql) >= 1 || $up10 == 'no')
{
	?>
<p align="left">Требования плагина :</p>
<p align="left">
<?
if($up6 == 1)
{
?>
Mysql базы<br>
<?
}
?>
<?
if($up7 == 1)
{
?>
Создания блока<br>
<?
}
?>
<?
if($up8 == 1 || $up8 == 2)
{
?>
Создания страницы<br>
<?
}
?>
<?
if($up12 == 1)
{
?>
Управление через панель администратора<br>
<?
}
?>
    </p>
<br>
<p align="center"><a href="?step=3&dir=<?=$file?>">Продолжить</a></p>
</div>
<?
}
else
{
	?>
<p align="left">Плагин зависим от модуля <?=$up10?>. Пожалуйста, сначала установите <?=$up10?>!</p>
<?
}  
}
elseif($_GET['step'] == 3)
{
?>
<div>
<div style="height:100px">
<?
if($up5 == 1)
{
	?>
<img src="../blocks/<?=$up9?>/logo.png">
<?
}
else
{
	?>
<img src="http://img194.imageshack.us/img194/5166/10555585.png">
<?
}
?>

</div>
<hr><h2 align="center"><strong>Мастер установки плагинов</strong></h2>
<?
$sel = mysql_query("SELECT * FROM modules WHERE dir='"._filter($up10)."'");
if(mysql_num_rows($sql) >= 1 || $up10 == 'no')
{
	?>
<p align="left">Выполненные действия :</p>
<p align="left">
<?
mysql_query("INSERT INTO modules VALUES(NULL, '"._filter($up9)."', '$up', '$up3', '$up4', '$up12')")or die(mysql_error());
$id = mysql_query("SELECT * FROM modules WHERE dir='"._filter($up9)."'");
$row = mysql_fetch_array($id);

if($up6 == 1)
{
$file = file("../blocks/".$file."/db.sql");
$query = '';
	foreach ($file AS $string)
	{
		if (preg_match("/^\s?#/", $string) || !preg_match("/[^\s]/", $string))
		continue;
		else
		{
			$query .= $string;
			if (preg_match("/;\s?$/", $query))
			{
				mysql_query(_filter($query)) or die(m_error(mysql_error()));
				$query = '';
			}
		}
	}	
?>
Mysql запросы выполнены<br>
<?
}
?>
<?
if($up7 == 1)
{
$name = $up;
$file = $up9."/block.php";



mysql_query("INSERT INTO blocks VALUES(NULL, '"._filter($name)."', '"._filter($file)."', '0', '"._filter($row['id'])."')");
?>
Блок создан!<br>
<?
}
?>
<?
if($up8 == 1 || $up8 == 2)
{
	$date = time();
	mysql_query("INSERT INTO pages VALUES(NULL,'"._filter($up)."','"._filter($upp8)."','"._filter($date)."','"._filter($up9)."', '"._filter($row['id'])."', '"._filter($up11)."')");
?>
Страница создана!<br>
<?
}
?>
    </p>
<br>
<p align="center"><a href="javascript:window.close();">Продолжить</a></p>
</div>
<?
}
else
{
	?>
<p align="left">Плагин зависим от модуля <?=$up10?>. Пожалуйста, сначала установите <?=$up10?>!</p>
<?
} 
}
else
{
?>
<div>
<div style="height:100px">
<?
if($up5 == 1)
{
	?>
<img src="../blocks/<?=$up9?>/logo.png">
<?
}
else
{
	?>
<img src="http://img194.imageshack.us/img194/5166/10555585.png">
<?
}
?>
</div>
<hr><h2 align="center"><strong>Мастер установки плагинов</strong></h2>
<?
$sel = mysql_query("SELECT * FROM modules WHERE dir='"._filter($up10)."'");
if(mysql_num_rows($sql) >= 1 || $up10 == 'no')
{
	?>
<p align="left">1. Плагин распространяется &quot;as is&quot;, и Light CMS не ответственна за любые возможные изменения.</p>
<p align="left">2.	Только покупка в LightStore обеспечит Вам полную поддержку при покупке <strong>платного плагина</strong>!</p>
<br>
<p align="center"><a href="?step=2&dir=<?=$file?>">Продолжить</a></p>
</div>
<?
}
else
{
	?>
<p align="left">Плагин зависим от модуля <?=$up10?>. Пожалуйста, сначала установите <?=$up10?>!</p>
<?
}    
}
?>