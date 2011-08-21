<?

include (getenv ("DOCUMENT_ROOT")."/include/config.php");
include (getenv ("DOCUMENT_ROOT")."/include/functions.php");
include (getenv ("DOCUMENT_ROOT")."/lang/russian.php");
mysqlcon();
include('chklogin.php');
$idt = $_GET["id"];
$delete = mysql_query("DELETE FROM categories WHERE id = '"._filter($idt)."'");
mysql_query("UPDATE posts SET catid = 1 WHERE catid = '"._filter($idt)."'");
if ($delete == 'true')
{?>
Категория удалена!<? exit; }else { ?><?=$errorlang?> <? exit;}
?>