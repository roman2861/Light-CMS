<?php

ob_start();
session_start();





include (getenv ("DOCUMENT_ROOT")."/include/config.php");

include (getenv ("DOCUMENT_ROOT")."/include/functions.php");

include (getenv ("DOCUMENT_ROOT")."/lang/russian.php");

$pagename = $adminlang['addpage'];


mysqlcon();


include ("chklogin.php");

if ($_POST) {


if (empty($_POST['name']) || empty($_POST['text']) || empty($_POST['page'])) 
{
?>
��������� �� ��� ����!
<?
exit;
}
$name = htmlspecialchars($_POST['name']);
$name = iconv( "utf-8", "windows-1251", $name);
$text = $_POST['text'];
$text = iconv( "utf-8", "windows-1251", $text);
$page = $_POST['page'];
$page = iconv( "utf-8", "windows-1251", $page);

$rusname = rus2translit($name); 

$rusname = strtolower($rusname); 

$date = time();
$proverka = mysql_query("SELECT * FROM pages WHERE page='"._filter($page)."'");
if(mysql_num_rows($proverka) >= 1)
{
m_error("����� �������� ��� ����������");
exit;
}
$send = mysql_query("INSERT INTO pages VALUES(NULL,'"._filter($name)."','"._filter2($text)."','"._filter($date)."','"._filter($page)."', '0')");

if ($send == 'true')
{
?>
�������� ���������!
<?
exit;
}

else 

{
?>
����������� ������
<?
exit;
}
}



else {

require("adminskin/head.php");
?>
    <!-- Right Side/Main Content Start -->
    <div id="rightside">
    
           <!-- Graphs Box Start -->
<div class="contentcontainer ui-tabs ui-widget ui-widget-content ui-corner-all" id="graphs">            <div class="headings alt">
                <h2 class="left">����</h2>
                <ul class="smltabs ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
<li class="ui-state-default ui-corner-top"><a href="addmod.php">�������� ������</a></li>
                	<li class="ui-state-default ui-corner-top"><a href="index.php">�������� ����</a></li>
                    <li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"><a href="addpage.php">�������� ��������</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="addcat.php">�������� ���������</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="addblock.php">�������� ����</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="adduser.php">�������� ��������������</a></li>
                </ul>
            </div>
            <div class="contentbox ui-tabs-panel ui-widget-content ui-corner-bottom" id="graphs-1">
            <form id="form" action="addpage.php" method="post">
<p align="center">��������: 
  <input type="text" id="textfield" class="inputbox" name="name" />
</p>
<p align="center">�����(&#1089;&#1072;&#1081;&#1090;.&#1088;&#1092;/&#1072;&#1076;&#1088;&#1077;&#1089;): 
  <input type="text" id="textfield" class="inputbox" name="page" />
</p>
<p align="center"><textarea style="width:500px; height:300px" id='text' name="text"></textarea></p><br /><br>
<input name="posting" type="hidden" value="true">
<input type="submit" value="�������" class="btn" /><b id="otvet"></b>
</form>
            </div>
        </div>
        <!-- Graphs Box End -->
    </div>
    <!-- Right Side/Main Content End -->


<?
include("menu.php"); 
} ?>