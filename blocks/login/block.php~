< ?
/*!!!Чтобы не повредить работоспособности 
    скрипта выше этого комментария 
    не размещайте вообще ничего!!!*/
include('connectdb.php');// подключение к серверу MySql и выбор БД
$userinfo='';
$state='0';
if( (isset($_COOKIE['login'])) & (isset($_COOKIE['pass'])) ) {// если в куках лежит логин и зашифрованый пароля
  if (!isset($_GET['exit'])) {// если кнопка выход не была нажата
    $login=$_COOKIE['login'];
    $pass=$_COOKIE['pass'];
 
    // проверяем наличие пользователя в БД и достаём оттуда пароль
    $sql="SELECT id, pass FROM users WHERE login='$login'";
    $res=mysql_query($sql);
    if(mysql_num_rows($res)>0){// если пользователь есть в БД
      $userinfo = mysql_fetch_array($res);// в этой переменной лежит пароль из БД
      if(strcmp($pass,md5($userinfo['pass'])) == 0) { //проверяем схожесть пароля из БД с паролем из куков
 
	// достаём все данные из БД
	$sql="SELECT * FROM users WHERE login='$login'";
	$res=mysql_query($sql);
	$userinfo=mysql_fetch_array($res); // в этой переменной будет лежать вся информация о пользователе из БД
	$time=time();
	// устанавливаем куки для запоминания статуса пользователя
	setcookie("login",$login,$time+1800);
	setcookie("pass",$pass,$time+1800);
	$state = 1;// статус, если 1, тогда пользователь авторизован
      }
    }
  } else {
    //обнуляем куки, если была нажата кнопка выход
    setcookie("login");
    setcookie("pass");
  }
}
if($state != 1) {// если после проверки куков, оказалось, что пользователь не авторизован, то идем дальше
  if( (isset($_POST['login'])) & (isset($_POST['pass'])) ){ // если пользователь ввёл логин и пароль
  $login = $_POST['login'];	
 
  // проверяем наличие пользователя в БД и достаём оттуда пароль
  $sql = "SELECT id, pass FROM users WHERE login='$login'";
  $res = mysql_query($sql);
    if(mysql_num_rows($res)>0) {// если пользователь есть в БД
      $userinfo = mysql_fetch_array($res);// в этой переменной лежит пароль из БД и номер пользователя
      $pass = $_POST['pass'];
      if(strcmp($pass,$userinfo['pass'])==0){
 
	// достаём все данные из БД
	$sql="SELECT * FROM users WHERE login='$login'";
	$res=mysql_query($sql);
	$userinfo=mysql_fetch_array($res);// в этой переменной будет лежать вся информация о пользователе из БД
	$time=time();
	// устанавливаем куки для запоминания статуса пользователя, пароль шифруем
	setcookie("login", $login, $time+1800);
	setcookie("pass", md5($pass), $time+1800);
	$state = 1;// статус, если 1, тогда пользователь авторизован
      }
    }
  }
}
if($state != 1) {
?>
<form method="post" action="/index.php">
Логин: <input type="text" size="30" name="login"/><br />
Пароль: <input type="password" name="pass" size="30"/><br />
<input type="submit" value="Войти"/>
</form>
<br /><a href="/register.php">Регистрация</a>
< ?
} else {
  echo 'Вы вошли на сайт!<br /> Ваш Логин: '.$userinfo["login"].'<br />Выш E-mail: '.$userinfo["email"].'<br /> <a href="/index.php?exit=y">Выход</a>';
}
?>