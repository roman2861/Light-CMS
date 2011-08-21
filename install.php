<?php

error_reporting(E_ALL);
include('./include/functions.php');
if ($_POST) {

$db_host = $_POST['server'];
$db_user = $_POST['user'];
$db_pass = $_POST['pass'];
$db_name = $_POST['name'];
$mail = $_POST['mail'];
$db_charset = 'cp1251';
$login = $_POST['login'];
$upass = $_POST['uspass'];
$upass = md5($upass);
if (isset($_POST['au']))
{ if ($_POST['au']=='on') { $au=1; } else { $au=0; }
}
$config = <<<HTML
<?
\$db_host = '$db_host';
\$db_user = '$db_user';
\$db_pass = '$db_pass';
\$db_name = '$db_name';
\$db_charset = 'cp1251';
\$install = '1';
HTML;
$file = file("indb.sql");
	if (!file_put_contents('./include/config.php', $config)) 
	{ not_e('<p align="center">Нет прав доступа на config.php</p>'); }
	mysqlcon();
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
				mysql_query($query) or die(m_error(mysql_error()));
				$query = '';
			}
		}
	}
$date = time();
mysql_query("INSERT INTO `categories` (`id`, `name`, `catvis`) VALUES
(NULL, 'Без категории', 1)") or die(m_error(mysql_error()));
mysql_query("INSERT INTO `posts` (`id`, `catid`, `title`, `text`, `date`, `views`, `comments`) VALUES
(NULL, 1, 'Добро пожаловать!', '<p>Поздравляем с успешной установкой Light CMS!</p>', '"._filter($data)."', 0, 0)") or die(m_error(mysql_error()));


mysql_query("INSERT INTO `users` (`login`, `password`, `admin`) VALUES
('"._filter($login)."', '"._filter($upass)."', 1)") or die(m_error(mysql_error()));


$date = date('Y-m-d H:i:s', $date);

mysql_query("INSERT INTO `config` (`id`, `name`, `value`) VALUES
(1, 'theme', 'lcms'),
(2, 'sitename', 'Light Cms'),
(3, 'siteslogan', 'Тест)))'),
(4, 'posts_num', '10'),
(5, 'cutpostcount', '1000'),
(6, 'cmsname', 'Light CMS'),
(7, 'curcmsver', '0.5.0 RC2'),
(8, 'mail', '"._filter($mail)."'),
(9, 'aupdate', '"._filter($au)."'),
(10, 'notworking', '0'),
(11, 'sp', '')") or die(m_error(mysql_error()));
?>
            <script>
			location="index.php";
document.location.href="index.php";
window.location.reload("index.php");
document.location.replace("index.php");
</script>
<?
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head>
<title>Light CMS - Установка</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link href="install/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
</head>
<body>
<center>
<div class="bx">
<!--Заголовок-->
<div class="cap">Установка Light CMS</div>
<!--Блок-->
<div class="block"><form action="install.php" method="post">

<br>
<table width="579" height="295" align="center">
<tr>
<td colspan="2">Установка</td><td colspan="2">Прочее</td>
</tr>
<tr>
<td width="117">
Сервер БД:</td><td width="144"><br><input type="text" name="server" /><br></td>
<td width="154">
Логин:</td><td width="144"><br><input type="text" name="login" /><br></td></tr>
<tr>
<td>
Пользователь БД:</td><td> <br><input type="text" name="user" /><br></td><td>
Пароль: </td><td> <br><input tyяpe="password" name="uspass" /><br></td></tr>
<tr>
<td>
Пароль БД:</td><td><br><input type="password" name="pass" /><br></td><td>
Ваш почтовый адрес: </td><td> <br><input type="mail" name="mail" /><br></td></tr>
<tr>
<td height="42">
Имя БД:</td><td> <br><input type="text" name="name" /><br></td><td>
Автообновление: </td><td> <br><input type="checkbox" name="au" /><br></td></tr>
<tr><td align="center" colspan="4"><input type="submit" value="Продолжить" /></td></tr>
</table>

</form></div>
</div>
</center>
</body>
</html>