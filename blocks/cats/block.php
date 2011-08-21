<?php 
				
				
$catquery = mysql_query("SELECT * FROM categories");



if (mysql_num_rows($catquery) > 0)
{
$crower = mysql_fetch_array($catquery);

do 
{

$id = $crower['id'];
$name = $crower['name'];

print ("<li><a href='cat_$id.html'>$name</a></li>");


}

while ($crower = mysql_fetch_array($catquery));

}
					?>
					</div>