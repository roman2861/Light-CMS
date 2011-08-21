<?php 

ob_start();
session_start();




include (getenv ("DOCUMENT_ROOT")."/include/config.php");

include (getenv ("DOCUMENT_ROOT")."/include/functions.php");

include (getenv ("DOCUMENT_ROOT")."/lang/russian.php");

mysqlcon();

include ("chklogin.php");

$pagename = $adminlang['edituser'];


require("adminskin/head.php");

if (!empty($_POST['name'])) {

if (empty($_POST['name']) || empty($_POST['new']) || empty($_POST['old'])) 
	die( "<br><h2>".$adminlang['edituser']."</h2><br>".$adminlang['addcat_empty']); 

	
$name = htmlspecialchars($_POST['namenew']);

$pass = htmlspecialchars($_POST['new']);
	
$passold = htmlspecialchars($_POST['old']);

$passold = md5($passold);

$pass = md5($pass);


$query = mysql_query("SELECT * FROM users WHERE login = '"._filter($name)."' AND password = '"._filter($passold)."' ") or die(m_error(mysql_error()));
	
	if (mysql_num_rows($query) == 1) {
	
	$rower = mysql_fetch_array($query);

$id = $rower['id'];
	
	$send = mysql_query("UPDATE users SET  login = '"._filter($name)."', password='"._filter($pass)."' WHERE id='"._filter($id)."'");



if ($send == 'true')
{



print ('<br><h2>'.$adminlang['edituser'].'</h2><br>'.$adminlang['edituser_suc']);
unset($_SESSION['admin_id']);
die;
}



}
	
	
}

?>
    <div id="rightside">
            <div class="headings alt">
                <h2><?=$pagename?></h2>
            </div>
            <div class="contentbox">
                        	<?
							$query = mysql_query("SELECT id,login FROM users WHERE admin = '0' ORDER BY id DESC");
							$query1 = mysql_query("SELECT *  FROM users WHERE login = '"._filter($_COOKIE['minibo_login'])."' AND password = '"._filter($_COOKIE['minibo_password'])."' AND admin = '1' ORDER BY id DESC");
                            if (mysql_num_rows($query) > 0 && mysql_num_rows($query1) == 1)
{
$rower = mysql_fetch_array($query);
?>
<table width="100%">
                	<thead>
                    	<tr>
                        	<th>Администратор</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php
			
do 
{
$id = $rower['id'];

$login = $rower['login'];



  
			
		

print ("
<tr>
              <td id='status_$id'>$login</td>
    <td><a href='javascript://' onclick=\"$('#status_$id').load('deluser.php?id=$id');return false;\"><img SRC='images/icons/icon_delete.png' alt='Удалить' /></a> </td>
            </tr>
");

}

while ($rower = mysql_fetch_array($query));
?>
</tbody>
</table>
<?
}
?>
<form action="edituser.php" method="post">
<?php echo $adminlang['edituser_log']?> <br><input id="textfield" disabled="disabled" class="inputbox" type="text" name="name" value="<?=$_SESSION['login']?>"  /><br />
<?php echo $adminlang['edituser_pass']?> <br><input id="textfield" class="inputbox" type="password" name="old"  /><br />
<?php echo $adminlang['edituser_passn']?> <br><input id="textfield" class="inputbox" type="password" name="new"  /><br />

<br /><br>

<input type="submit" value="Изменить" class="btn" />
</form>
</div>
</div>
<?
include("menu.php");