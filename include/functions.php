<?php
include ("config.php");
function m_error($err) {
	?>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
    <link href="../install/style.css" rel="stylesheet" type="text/css">
    <div class="cap" align="center" style="border:solid 1px; width:500px; margin-left:30%;">
    <a href="javascript://" onclick="$('#error').slideToggle('fast')">Ошибка. Подробности - кликните на текст.</a>
    <div id="error" align="center" style="border-top:solid 1px; display:none">
    <?=$err?>
    </div>
    </div>
    <?
	die;
}
function mysqlcon() {
	global $db_host, $db_user, $db_pass, $db_name, $db_charset;
	if (!@mysql_connect($db_host, $db_user, $db_pass))
		die(m_error(mysql_error()));
mysql_select_db($db_name);
mysql_query("SET NAMES "._filter($db_charset)."");
}
 function rus2translit($string)  
 {  
     $converter = array(  
        'а' => 'a',   'б' => 'b',   'в' => 'v',  
        'г' => 'g',   'д' => 'd',   'е' => 'e',  
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',  
        'и' => 'i',   'й' => 'y',   'к' => 'k',  
        'л' => 'l',   'м' => 'm',   'н' => 'n',       
		'о' => 'o',   'п' => 'p',   'р' => 'r',  
        'с' => 's',   'т' => 't',   'у' => 'u',  
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',  
		'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',  
        'ь' => "",  'ы' => 'y',   'ъ' => "",  
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',  
		' ' => '_', ':' => '', '!' => '', 
		'@' => '', '#' => '', '$' => '',
		'%'=> '', '^' => '', '&' => '', 
	'*' => '', '(' => '', ')' => '',
  
       'А' => 'A',   'Б' => 'B',   'В' => 'V',  
       'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
       'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',  
       'И' => 'I',   'Й' => 'Y',   'К' => 'K',  
       'Л' => 'L',   'М' => 'M',   'Н' => 'N',  
       'О' => 'O',   'П' => 'P',   'Р' => 'R',  
       'С' => 'S',   'Т' => 'T',   'У' => 'U',  
       'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',  
       'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',  
       'Ь' => "",  'Ы' => 'Y',   'Ъ' => "",  
       'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',  
    );  
    return strtr($string, $converter);  
 }  

      function closetags($html)

      {

      $arr_single_tags = array('meta','img','br','link','area');
 
      preg_match_all('#<([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
   $openedtags = $result[1];
 
      preg_match_all('#</([a-z]+)>#iU', $html, $result);
$closedtags = $result[1];

      $len_opened = count($openedtags);
 
      if (count($closedtags) == $len_opened)

      {

      return $html;

      }

      $openedtags = array_reverse($openedtags);

      for ($i=0; $i < $len_opened; $i++)

      {

      if (!in_array($openedtags[$i],$arr_single_tags))

      {

      if (!in_array($openedtags[$i], $closedtags))

      {

      if ($next_tag = $openedtags[$i+1])

      {

      $html = preg_replace('#</'.$next_tag.'#iU','</'.$openedtags[$i].'></'.$next_tag,$html);

      }

      else

      {

      $html .= '</'.$openedtags[$i].'>';

      }

      }
 }

      }

       

      return $html;

      }   

function breakword ($txt,$len,$delim='\s;,.!?:#') {
    $txt = preg_replace_callback ("#(</?[a-z]+(?:>|\s[^>]*>)|[^<]+)#mi"
                                  ,create_function('$a'
                                                  ,'static $len = '.$len.';'
                                                  .'$len1 = $len-1;'
                                                  .'$delim = \''.str_replace("#","\\#",$delim).'\';'
                                                  .'if ("<" == $a[0]{0}) return $a[0];'
                                                  .'if ($len<=0) return "";'
                                                  .'$res = preg_split("#(.{0,$len1}+(?=[$delim]))|(.{0,$len}[^$delim]*)#ms",$a[0],2,PREG_SPLIT_DELIM_CAPTURE);'
                                                  .'if ($res[1]) { $len -= strlen($res[1])+1; $res = $res[1];}'
                                                  .'else         { $len -= strlen($res[2]); $res = $res[2];}'
                                                  .'$res = rtrim($res);/*preg_replace("#[$delim]+$#m","",$res);*/'
                                                  .'return $res;')
                                  ,$txt);
     while (preg_match("#<([a-z]+)[^>]*>\s*</\\1>#mi",$txt)) {
         $txt = preg_replace("#<([a-z]+)[^>]*>\s*</\\1>#mi","",$txt);
     }
     return $txt;
}



function mkglobal($vars) {
	if (!is_array($vars))
		$vars = explode(":", $vars);
	foreach ($vars as $v) {
		if (isset($_GET[$v]))
			$GLOBALS[$v] = unesc($_GET[$v]);
		elseif (isset($_POST[$v]))
			$GLOBALS[$v] = unesc($_POST[$v]);
		else
			return 0;
	}
	return 1;
}

function bark($msg) {

include('config.php');

	echo $msg;
	

include("templates/$theme/right.php");

include("templates/$theme/footer.php");
exit;
}



function validemail($email)
{

if(eregi('^([a-z0-9_]|\\-|\\.)+'.'@'.'(([a-z0-9_]|\\-)+\\.)+'.'[a-z0-9]{2,4}$', $email)):
{
return true;
};
else:
{
return false;
};endif;
}


function mkprettytime($seconds, $time = true) {
	global $CURUSER;

	$seconds = $seconds-date("Z")+$CURUSER['timezone']*3600;
	$search = array('January','February','March','April','May','June','July','August','September','October','November','December');
	$replace = array('января','февраля','марта','апреля','мая','июня','июля','августа','сентября','октября','ноября','декабря');
	if ($time == true)
	$data = @date("j F Y в H:i", $seconds);
	else
	$data = @date("j F Y", $seconds);
	if (!$data) $data = 'N/A'; else
	$data = str_replace($search, $replace, $data);
	return $data;
}
function unesc($x) {
	if (get_magic_quotes_gpc())
		return stripslashes($x);
	return $x;
}

function RemoveDir($path)
{
	if(file_exists($path) && is_dir($path))
	{
		$dirHandle = opendir($path);
		while (false !== ($file = readdir($dirHandle))) 
		{
			if ($file!='.' && $file!='..')// исключаем папки с назварием '.' и '..' 
			{
				$tmpPath=$path.'/'.$file;
				chmod($tmpPath, 0777);
				
				if (is_dir($tmpPath))
	  			{  // если папка
					RemoveDir($tmpPath);
			   	} 
	  			else 
	  			{ 
	  				if(file_exists($tmpPath))
					{
						// удаляем файл 
	  					unlink($tmpPath);
					}
	  			}
			}
		}
		closedir($dirHandle);
		
		// удаляем текущую папку
		if(file_exists($path))
		{
			rmdir($path);
		}
	}
	else
	{
		echo "Удаляемой папки не существует или это файл!";
	}
}
 
function _filter( $var , $sql = 0) {
 
	$var = strip_tags($var);
	$var=str_replace ("\n"," ", $var);
    $var=str_replace ("\r","", $var);
	$var = htmlspecialchars($var);
	if ( $sql == 1) {
		$var = mysql_real_escape_string($var);
	}
	return $var;
}
function _filter2( $var , $sql = 0) {
$var = mysql_real_escape_string($var);
	return $var;
}
?>