<?php

ob_start();
session_start();





include (getenv ("DOCUMENT_ROOT")."/include/config.php");

include (getenv ("DOCUMENT_ROOT")."/include/functions.php");

include (getenv ("DOCUMENT_ROOT")."/lang/russian.php");


mysqlcon();

$pagename = $adminlang['addblock'];




include ("chklogin.php");
if($_POST)
{
$file = $_POST['query'];
$file = iconv( "utf-8", "windows-1251", $file);
$array=file("./blocks/".$file."/install.txt");

$text = implode(null,$array); 
 if(!empty($text))
 {
	 
$open = @file_get_contents("../blocks/".$file."/install.txt", "r"); 
$rand = ('#<installed>(.*?)</installed>#is'); //(.*?) - рандомное значение
preg_match_all($rand,$open,$out); 
for($i = 0; $i < count($out[1]); $i++) 
{$up1 = "".$out[1][$i]."";} 
$up0 = $up1.$up0; 
$rand = ('#<name>(.*?)</name>#is'); //(.*?) - рандомное значение
preg_match_all($rand,$open,$out); 
for($i = 0; $i < count($out[1]); $i++) 
{$up1 = "".$out[1][$i]."";} 
$up = $up1.$up; 
$rand = ('#<desc>(.*?)</desc>#is'); //(.*?) - рандомное значение
preg_match_all($rand,$open,$out); 
for($i = 0; $i < count($out[1]); $i++) 
{$up1 = "".$out[1][$i]."";} 
$up2 = $up1.$up2; 
 ?>
 <div class="contentbox">
            	<table width="100%">
                	<thead>
                    	<tr>
                        	<th>Название</th>
                            <th>Описание</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<tr>
                        	<td id="status"><?=$up?></td>
                            <td><?=$up2?></td>
                            <td>
                            <script>
                            	var popUpWin=0;
									function popUpPic(URLStr)
								{
								  if(popUpWin)
								  {
    if(!popUpWin.closed) popUpWin.close();
  }
  popUpWin = open(URLStr, '&#212;&#238;&#242;&#238;', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=yes, width=600, height=400');
}
</script>
                            	<a href="installmod.php?dir=<?=$file?>" onclick="popUpPic(this.href); return false;"><img SRC="images/icons/icon_approve.png" alt="Установить" /></a>
                                <a href="#" title=""><img SRC="images/icons/icon_delete.png" alt="Удалить безвозвратно" /></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
 <?
	}
	else
	{
	?>
	<p align="center" style="color:#CCCCCC; font-size:16px">Результатов нет</p>
	<?
	}
	}
	else
	{
	require("adminskin/head.php");
?>
 <!-- Right Side/Main Content Start -->
    <div id="rightside">
    
           <!-- Graphs Box Start -->
<div class="contentcontainer ui-tabs ui-widget ui-widget-content ui-corner-all" id="graphs">            <div class="headings alt">
                <h2 class="left">Меню</h2>
                <ul class="smltabs ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
					<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"><a href="addmod.php">Добавить модуль</a></li>
                	<li class="ui-state-default ui-corner-top"><a href="index.php">Добавить пост</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="addpage.php">Добавить страницу</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="addcat.php">Добавить категорию</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="addblock.php">Добавить блок</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="adduser.php">Добавить администратора</a></li>
                </ul>
            </div>
            <div class="contentbox ui-tabs-panel ui-widget-content ui-corner-bottom" id="graphs-1">
<script type="text/javascript">
// prepare the form when the DOM is ready 
$(document).ready(function() { 
    // bind form using ajaxForm 
    $('#myForm').ajaxForm({ 
        // target identifies the element(s) to update with the server response 
        target: '#gav', 
 
        // success identifies the function to invoke when the server response 
        // has been received; here we apply a fade-in effect to the new content 
        success: function() { 
            $('#gav').fadeIn('slow'); 
        } 
    }); 
});
</script>

		<form id="myForm" method="post" action="">
					<table style="width:100%"><tr>
<td style="width:100%; height:45px;">
                            <input name="query" type="text" class="search_box"  id="query" onclick="$('#myForm').submit();" value="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1087;&#1072;&#1087;&#1082;&#1091; &#1089; &#1084;&#1086;&#1076;&#1091;&#1083;&#1077;&#1084;" />
</td>
						</tr>
		  </table>
		<br/><br/>
</form>
<div id="gav">
</div>

                </div>
        </div>
        <!-- Graphs Box End -->
    </div>
<?php
include('menu.php');
	}
?>