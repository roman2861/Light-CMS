<?

include (getenv ("DOCUMENT_ROOT")."/include/config.php");
include (getenv ("DOCUMENT_ROOT")."/include/functions.php");
include (getenv ("DOCUMENT_ROOT")."/lang/russian.php");
mysqlcon();
include('chklogin.php');
$idt = $_GET["id"];
$query1 = mysql_query("SELECT *  FROM users WHERE login = '"._filter($_COOKIE['minibo_login'])."' AND password = '"._filter($_COOKIE['minibo_password'])."' AND admin = '1' ORDER BY id DESC");
if(mysql_num_rows($query1) == 1)
$delete = mysql_query("DELETE FROM users WHERE id = '"._filter($idt)."'");
if ($delete == 'true')
{
	?>
Администратор удалён!
    <?
	exit;
}
else
{
	?>
    Ошибка системы!
    <?
}