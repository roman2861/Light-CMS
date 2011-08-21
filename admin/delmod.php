<?

include (getenv ("DOCUMENT_ROOT")."/include/config.php");
include (getenv ("DOCUMENT_ROOT")."/include/functions.php");
include (getenv ("DOCUMENT_ROOT")."/lang/russian.php");
mysqlcon();
include('chklogin.php');
$idt = $_GET["id"];
$query = mysql_query("SELECT * FROM modules WHERE id = '"._filter($idt)."'")or die(m_error(mysql_error()));
$rowing = mysql_fetch_array($query);
$file = $rowing['dir'];
$open = @file_get_contents("../blocks/".$file."/install.txt", "r"); 
$rand = ('#<mysql>(.*?)</mysql>#is'); //(.*?) - рандомное значение
preg_match_all($rand,$open,$out); 
for($i = 0; $i < count($out[1]); $i++) 
{$up1 = "".$out[1][$i]."";} 
$up6 = $up1.$up6;
if($up6 == 1)
{
$file = @file_get_contents("../blocks/".$file."/del_db.sql", "r"); 
$query = '';

	foreach ($file AS $string)
	{
			$query .= $string;
			preg_match("/;\s?$/", $query);
			_filter($query);
				mysql_query($query) or die(m_error(mysql_error()));
				$query = '';
				echo "Test";
	}
}
else{
	echo "hi";
}

$rand = ('#<block>(.*?)</block>#is'); //(.*?) - рандомное значение
preg_match_all($rand,$open,$out); 
for($i = 0; $i < count($out[1]); $i++) 
{$up1 = "".$out[1][$i]."";} 
$up7 = $up1.$up7;
if($up7 == 1)
{
	
$q1 = mysql_query("DELETE FROM blocks WHERE mod_id = '"._filter($idt)."'")or die(m_error(mysql_error()));
if ($q1 == 'true')
{
}else { ?><?=$errorlang?> <? exit;}}
else{
	echo "hi";
}
$rand = ('#<page>(.*?)</page>#is'); //(.*?) - рандомное значение
preg_match_all($rand,$open,$out); 
for($i = 0; $i < count($out[1]); $i++) 
{$up1 = "".$out[1][$i]."";} 
$up8 = $up1.$up8;
if($up8 == 1 || $up8 == 2)
{
	
$q2 = mysql_query("DELETE FROM pages WHERE mod_id = '"._filter($idt)."'")or die(m_error(mysql_error()));
if ($q2 == 'true')
{
}else { ?><?=$errorlang?> <? exit;}}
else{
	echo "hi";
}

$delete = mysql_query("DELETE FROM modules WHERE id = '"._filter($idt)."'")or die(m_error(mysql_error()));
if ($delete == 'true')
{?>
ћодуль удалЄн!<? exit; }else { ?><?=$errorlang?> <? exit;}
?>