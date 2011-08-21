<?php 

ob_start();
session_start();




include (getenv ("DOCUMENT_ROOT")."/include/config.php");

include (getenv ("DOCUMENT_ROOT")."/include/functions.php");

include (getenv ("DOCUMENT_ROOT")."/lang/russian.php");

mysqlcon();

include ("chklogin.php");

$pagename = $adminlang['con_posts'];


require("adminskin/head.php");

if (!empty($_POST['pnum'])) {



	
$pnum = htmlspecialchars($_POST['pnum']);
	
$cutcount = htmlspecialchars($_POST['cutcount']);


	

	
	$send = mysql_query("UPDATE config SET  value = '"._filter($pnum)."' WHERE name = 'posts_num'");
		$send = mysql_query("UPDATE config SET  value = '"._filter($cutcount)."' WHERE name = 'cutpostcount'");




if ($send == 'true')
{



print ('<br><h2>'.$adminlang['con_posts'].'</h2><br>'.$adminlang['edit_config_suc']);

die;
}



}

$query = mysql_query("SELECT * FROM config");

$roc = mysql_fetch_array($query);

do 
{

$config[] = $roc['value'];

}

while ($roc = mysql_fetch_array($query));



$pnum =  $config[3];

$cutcount =  $config[4];
	

?>

<br><h2><?php echo $adminlang['con_posts'] ?></h2><br>
<form action="postconfig.php" method="post">
<?php echo $adminlang['con_posts_pnum'] ?><br><input type="text" name="pnum" value="<?php echo $pnum?>" /><br /><br />
<?php echo $adminlang['con_posts_cut'] ?> <br><input type="text" name="cutcount" value="<?php echo $cutcount?>"  /><br /><br />

<br /><br>

<input type="submit" value="Изменить" />
</form>