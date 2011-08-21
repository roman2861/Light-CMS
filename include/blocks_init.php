<?php 
				
include ("api.php");				
$blockquery = mysql_query("SELECT * FROM blocks ORDER BY position ASC");





$brower = mysql_fetch_array($blockquery);
$brower2 = mysql_num_rows($blockquery);
if($brower2 >= 1)
{
do 
{

$name = $brower['name'];
$file = $brower['file'];
$array=file("templates/".$theme."/block.tpl");

$text = implode(null,$array); 

 $find ="/{name}/"; 
 $replace = $name; 

 echo preg_replace ($find, $replace, $text); 
include("blocks/$file");
}

while ($brower = mysql_fetch_array($blockquery));
}

					?>