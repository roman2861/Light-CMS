<?php 

ob_start();
session_start();


include (getenv ("DOCUMENT_ROOT")."/include/config.php");

include (getenv ("DOCUMENT_ROOT")."/include/functions.php");

include (getenv ("DOCUMENT_ROOT")."/lang/russian.php");

mysqlcon();



$pagename = $adminlang['index'];


require("adminskin/head.php");

include ("chklogin.php");

?>
    <!-- Right Side/Main Content Start -->
    <div id="rightside">
    
           <!-- Graphs Box Start -->
<div class="contentcontainer ui-tabs ui-widget ui-widget-content ui-corner-all" id="graphs">            <div class="headings alt">
                <h2 class="left">����</h2>
                <ul class="smltabs ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
<li class="ui-state-default ui-corner-top"><a href="addmod.php">�������� ������</a></li>
                	<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"><a href="#graphs-1">�������� ����</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="addpage.php">�������� ��������</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="addcat.php">�������� ���������</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="addblock.php">�������� ����</a></li>
                    <li class="ui-state-default ui-corner-top"><a href="adduser.php">�������� ��������������</a></li>
                </ul>
            </div>
            <div class="contentbox ui-tabs-panel ui-widget-content ui-corner-bottom" id="graphs-1">
            <? include('addpost.php'); ?>
            </div>
        </div>
        <!-- Graphs Box End -->
    </div>
    <!-- Right Side/Main Content End -->
<?
include('menu.php');