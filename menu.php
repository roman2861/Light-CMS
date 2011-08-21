<?
include('include/init.php');
mysqlcon();

$query = mysql_query("SELECT id, name, page FROM pages WHERE visible='1' LIMIT 8") or die(mysql_error());
while ($rowing = mysql_fetch_array($query, MYSQL_NUM)) {
        printf ('<li><a href="./%s.html" class="fly">%s</a></li>
',$rowing[2], $rowing[1], $rowing[1]);  
    }

    mysql_free_result($query);
