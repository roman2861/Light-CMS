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


if (empty($_POST['name'])) 
{
?>
��������� �� ��� ����!
<?
exit;
}
$name = htmlspecialchars($_POST['name']);
$name = iconv( "utf-8", "windows-1251", $name);
$num=10;
function generate_password($number){
$arr = array(
'a','b','c','d','e','f',
'g','h','i','j','k','l',
'm','n','o','p','q','r',
's','t','u','v','w','x',
'y','z','A','B','C','D',
'E','F','G','H','I','J',
'K','L','M','N','O','P',
'Q','R','S','T','U','V',
'W','X','Y','Z','1','2',
'3','4','5','6','7','8',
'9','0');
// ���������� ������
$pass = "";
for($i = 0; $i < $number; $i++){// ��������� ��������� ������ �������
$index = rand(0, count($arr) - 1);
$pass .= $arr[$index];
}
return $pass;
}
$pass=generate_password($num);
$password = md5($pass);
 if ($_POST['vindex'] == 'on') {$vindex = 1; } else {$vindex = 0;};
$send = mysql_query("INSERT INTO users VALUES(NULL,'"._filter($name)."','"._filter($password)."','"._filter($vindex)."')");

if ($send == 'true')
{
?>
������������ ��������! ��� ����� - <?=$name?>, ������ - <?=$pass?>
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
                    <li class="ui-state-default ui-corner-top"><a href="addpage.php">�������� ��������</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="addcat.php">�������� ���������</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="addblock.php">�������� ����</a></li>
                    <li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"><a href="adduser.php">�������� ��������������</a></li>
                </ul>
            </div>
            <div class="contentbox ui-tabs-panel ui-widget-content ui-corner-bottom" id="graphs-1">
<form id="form" action="adduser.php" method="post">
<p align="center">�����: 
  <input type="text" id="textfield" class="inputbox" name="name" />
</p>
<p align="center">������� �����: 
  <input type="checkbox" id="textfield" class="inputbox" name="vindex" />
</p>
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