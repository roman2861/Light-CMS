<?php 

$page =0 + (int)$_GET["page"];
$catn =0 + (int)$_GET["cat"];
include("include/init.php");
mysqlcon();
if(empty($frompage))
{
if(!empty($catn))
{
$smarty->display('header.tpl');
$smarty->display('right.tpl');
$pnum = 10;
$curp = $pnum * $page;
$news = mysql_query ("SELECT * FROM posts WHERE vindex = 0 AND catid = $catn ORDER BY id DESC LIMIT $curp , $pnum");
$rows=array();
while ($row=mysql_fetch_array($news))
   $rows[]=$row;
$smarty->assign('news', $rows);
$smarty->display('content.tpl');
$smarty->display('footer.tpl');
}
else
{
$smarty->display('header.tpl');
$smarty->display('right.tpl');
$pnum = 10;
$curp = $pnum * $page;
$news = mysql_query ("SELECT * FROM posts WHERE vindex = 0 ORDER BY id DESC LIMIT $curp , $pnum");
$rows=array();
while ($row=mysql_fetch_array($news))
   $rows[]=$row;
$smarty->assign('news', $rows);
$smarty->display('content.tpl');
$smarty->display('footer.tpl');
}
}
else
{
$news = mysql_query("SELECT * FROM pages WHERE page='$frompage'");

if (mysql_num_rows($news) == 0)

{

bark ("!");

}
$smarty->display('header.tpl');
$smarty->display('right.tpl');
$pnum = 10;
$curp = $pnum * $page;
$rows=array();
while ($row=mysql_fetch_array($news))
   $rows[]=$row;
$smarty->assign('news', $rows);
$smarty->display('pages.tpl');
$smarty->display('footer.tpl');
}
?>