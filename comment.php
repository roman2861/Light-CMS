<?php

session_start();

include("include/init.php");


include("templates/$theme/header.php");


if (isset($_SESSION["captcha"]) && $_SESSION["captcha"]!==$_POST["captcha"]) 
{
bark ("�� ����� ������������ ����� � ��������");

unset($_SESSION["captcha"]);
}
if (empty($_POST['name']) || empty($_POST['postid']) || empty($_POST['text']))
	bark("�� �� ��������� ��� ����");
	
	


$name = htmlspecialchars($_POST['name']);


function validusername($username)
{
	if ($username == "")
	return false;

	$allowedchars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_. ";

	for ($i = 0; $i < strlen($username); ++$i)
	if (strpos($allowedchars, $username[$i]) === false)
	return false;

	return true;
}

if (!validusername($name))
{
bark("�� ����� ������������ ��� ������������.");
}


$email = htmlspecialchars($_POST['email']);
if (!empty($email)) { 
if (!validemail($email))
bark("�� ����� �������� email.");
}



$text = htmlspecialchars($_POST['text']);

$postid = htmlspecialchars($_POST['postid']);

$date = time();

$send = mysql_query("INSERT INTO comments VALUES(NULL,'$postid','$text','$name','$email','$date')");

if ($send == 'true')
{

mysql_query("UPDATE posts SET comments = comments + 1 WHERE id = $postid");

bark ('�� ������� �������� �����������!');
}

else 

{
bark ("������!");
}


?>

