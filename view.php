<?php 

include("include/init.php");


$id =0 + (int)$_GET["id"];
if (!mkglobal("id"))
bark("Прямой доступ к этому файлу не разрешен.");
$ip = $_SERVER['REMOTE_ADDR'];
$ipquery = mysql_query("SELECT * FROM views WHERE ip='"._filter($ip)."' AND postid = '"._filter($id)."'");
if (mysql_num_rows($ipquery) == 0)
{
mysql_query("INSERT INTO views VALUES(NULL,'"._filter($id)."','"._filter($ip)."')");
mysql_query("UPDATE posts SET views = views + 1 WHERE id = "._filter($id)."");
}
$smarty->display('header.tpl');
$smarty->display('right.tpl');
$pnum = 10;
$curp = $pnum * $page;
$news = mysql_query("SELECT * FROM posts WHERE id='"._filter($id)."'");
$rows=array();
while ($row=mysql_fetch_array($news))
   $rows[]=$row;
$smarty->assign('news', $rows);
$smarty->display('content.tpl');
$comm = mysql_query ("SELECT * FROM comments WHERE postid = '"._filter($id)."' ORDER BY id DESC ");
$com=array();
while ($row=mysql_fetch_array($comm))
   $com[]=$row;
$smarty->assign('comments', $com);
$smarty->display('comment.tpl');
?>
<hr />
<?
include ("templates/$theme/addcomment.php");
$smarty->display('footer.tpl');