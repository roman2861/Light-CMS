<?php

ob_start();
session_start();





include (getenv ("DOCUMENT_ROOT")."/include/config.php");

include (getenv ("DOCUMENT_ROOT")."/include/functions.php");


include (getenv ("DOCUMENT_ROOT")."/lang/russian.php");

$pagename = $adminlang['login'];



mysqlcon();
if($_GET['act'] == 'del')
{
unset($_SESSION['admin_id']);
  foreach($_COOKIE as $ind=>$val)
	@setcookie($ind,'',time()-99999999);
header("Location: login.php");
die;
}
if (isset($_SESSION['admin_id']) && isset($_COOKIE['minibo_login'])) {
header("Location: index.php");
die; }

if (isset($_POST['login']) && isset($_POST['password']))
{
    $login = mysql_real_escape_string($_POST['login']);
    $password = md5($_POST['password']);

	$query = mysql_query("SELECT id FROM users WHERE login='"._filter($login)."' AND password='"._filter($password)."' LIMIT 1") or die(m_error(mysql_error()));
	

    if (mysql_num_rows($query) == 1) {
     

        $sqlrow = mysql_fetch_array($query);
        $_SESSION['admin_id'] = $sqlrow['id'];
		$_SESSION['login'] = $login;
		$_SESSION['password'] = $password;
		setCookie("minibo_login", $login, time()  + 3600);
				setCookie("minibo_password", $password, time()  + 3600);
				?>
                <a href="index.php">Вы вошли!</a>
                <?
		
exit;
    }
    else {
				?>
Что-то не так. Вы ошиблись!                <?
exit;
    }
}
ob_flush();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title><?=$pagename?></title>
<link href="login/screen.css" rel="stylesheet" type="text/css" />
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js?ver=1.3.2'></script>
<script type='text/javascript' src='http://github.com/malsup/form/raw/master/jquery.form.js'></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(document).mouseup(function() {
			$("#loginform").mouseup(function() {
				return false
			});
			$("a.close").click(function(e){
				e.preventDefault();
				$("#loginform").hide();
				$(".lock").fadeIn();
			});
			if ($("#loginform").is(":hidden"))
			{
				$(".lock").fadeOut();
			} else {
				$(".lock").fadeIn();
			}
			$("#loginform").toggle();
		});
		// I dont want this form be submitted
		$("form#signin").submit(function() {
		  return false;
		});
		// This is example of other button
		$("input#cancel_submit").click(function(e) {
				$("#loginform").hide();
				$(".lock").fadeIn();
		});
	});
</script>
<script type="text/javascript">
// prepare the form when the DOM is ready 
$(document).ready(function() { 
    // bind form using ajaxForm 
    $('#login').ajaxForm({ 
        // target identifies the element(s) to update with the server response 
        target: '.message', 
 
        // success identifies the function to invoke when the server response 
        // has been received; here we apply a fade-in effect to the new content 
        success: function() { 
            $('.message').fadeIn('slow'); 
        } 
    }); 
});
</script>
</head>
<body>
<div id="cont">
  <div class="box lock"> </div>
  <div id="loginform" class="box form">
    <h2>Вход в панель управления сайтом</h2>
    <div class="formcont">
    <form action="login.php" method="post" id="login">
      <fieldset id="signin_menu">
      <span class="message">Пожалуйста, Введите ваш логин и пароль:</span>
      <form  name="login" action="" method="post"><input type="hidden" name="subaction" value="dologin">
        <label for="username"><?=$adminlang['log_in']?></label>
        <input id="username" name="login" value="" title="<?=$adminlang['log_in']?>" class="required" tabindex="4" type="text">
        </p>
        <p>
          <label for="password"><?=$adminlang['password']?></label>
          <input id="password" name="password" value="" title="<?=$adminlang['password']?>" class="required" tabindex="5" type="password">
        </p>
		<!-- /* {$select_language} */ -->
        <p class="clear"></p>
        <p class="remember">
          <input id="signin_submit" value="Отправить" tabindex="6" type="submit">
        </p>
      </form>
      </fieldset>
    </div>
    <div class="formfooter"></div>
  </div>
</div>
<div id="bg">
  <div>
    <table cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="login/images/bg.jpg" alt=""/> </td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>
