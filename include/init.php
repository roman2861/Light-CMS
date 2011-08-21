<?php

include ("config.php");
if(empty($install))
{
	        ?>
             <script>
			location="install.php";
document.location.href="install.php";
window.location.reload("install.php");
document.location.replace("install.php");
</script>
<?
}
include ("functions.php");
mysqlcon();
include ("template.php");

include (getenv ("DOCUMENT_ROOT")."/lang/russian.php");



include('api.php');
?>