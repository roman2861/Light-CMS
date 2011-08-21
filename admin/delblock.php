<?

include (getenv ("DOCUMENT_ROOT")."/include/config.php");
include (getenv ("DOCUMENT_ROOT")."/include/functions.php");
include (getenv ("DOCUMENT_ROOT")."/lang/russian.php");
mysqlcon();
include('chklogin.php');
$idt = $_GET["id"];
$delete = mysql_query("DELETE FROM blocks WHERE id = '"._filter($idt)."'");
if ($delete == 'true')
{?>
Ѕлок удалЄн!<? exit; }else { ?><?=$errorlang?> <? exit;}
?>