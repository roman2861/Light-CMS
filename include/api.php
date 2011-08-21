<?
mysqlcon();
$query = mysql_query("SELECT * FROM config");
$roc = mysql_fetch_array($query);
do 
{
$config[] = $roc['value'];
}
while ($roc = mysql_fetch_array($query));

require_once('smarty/Smarty.class.php');
$smarty = new Smarty();
$smarty->template_dir = 'templates/lcms/';
$smarty->compile_dir = 'templates_c/';
$smarty->cache_dir = 'cache/';
$smarty->allow_php_tag=true;  
$smarty->assign('title', $config[1]);
$smarty->assign('theme', $config[0]);
$smarty->assign('siteslogan', $config[2]);
$smarty->assign('pnum', $config[3]);
$smarty->assign('cutcount', $config[4]);
$smarty->assign('curver', '$config[5] $config[6]');
$smarty->assign('a_mail', $config[7]);
$smarty->assign('au', $config[8]);
$sitename = $config[1];
$theme = $config[0];
$siteslogan = $config[2];
$pnum =  $config[3];
$cutcount =  $config[4];
$curver = "$config[5] $config[6]";
$a_mail =  $config[7];
$au =  $config[8];
$nw =  $config[9];
$frompage =  $config[10];
$host = $config[11];
if($nw == 1)
{
session_start();

if (!isset($_SESSION['admin_id'])) {

    if (isset($_COOKIE['minibo_login']) && isset($_COOKIE['minibo_password'])) {

        $login = mysql_real_escape_string($_COOKIE['minibo_login']);
        $password = mysql_real_escape_string($_COOKIE['minibo_password']);



        $query = mysql_query("SELECT id FROM users WHERE login='{"._filter($login)."}' AND password='{"._filter($password)."}' LIMIT 1") or die(m_error(mysql_error()));
	

    if (mysql_num_rows($query) == 1) {
     

        $sqlrow = mysql_fetch_array($query);
        $_SESSION['admin_id'] = $sqlrow['id'];


           
        }
        else {

        }
    }
	$smarty->display('notwork.tpl');
	die;
}
}