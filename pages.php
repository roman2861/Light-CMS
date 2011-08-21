<?php 

include("include/init.php");


$id = $_GET["page"];


$news = mysql_query("SELECT * FROM pages WHERE page='"._filter($id)."'");

if (mysql_num_rows($news) == 0)

{

bark ("см");

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

?>
