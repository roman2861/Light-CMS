<?php 

session_start();

if (!isset($_SESSION['admin_id'])) {

    if (isset($_COOKIE['minibo_login']) && isset($_COOKIE['minibo_password']) && !empty($_SESSION['admin_id'])) {

        $login = mysql_real_escape_string($_COOKIE['minibo_login']);
        $password = mysql_real_escape_string($_COOKIE['minibo_password']);



        $query = mysql_query("SELECT id FROM users WHERE login='{"._filter($login)."}' AND password='{"._filter($password)."}' LIMIT 1") or die(m_error(mysql_error()));
	

    if (mysql_num_rows($query) == 1) {
     

        $sqlrow = mysql_fetch_array($query);
        $_SESSION['admin_id'] = $sqlrow['id'];
	}
    }
	header("Location: login.php");
	die;
}
?>