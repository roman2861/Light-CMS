<?php 
$id = $_GET['id'];
if (!$id) $id = 404; 

// ассоциативный массив кодов и описаний 
$a[401] = "Требуется авторизация"; 
$a[403] = "Пользователь не прошел аутентификацию, доступ запрещен"; 
$a[404] = "Документ не найден"; 
$a[500] = "Внутренняя ошибка сервера"; 
$a[400] = "Неправильный запрос"; 

// определяем дату и время в стандартном формате 
$time = date("d.m.Y H:i:s"); 
// эта переменная содержит тело сообщения 
$body ="
Не везёт что-то...давайте пойдем на главную?
";
if ($HTTP_REFERER) $body .= "Вы пришли со страницы: <b>$HTTP_REFERER</b><br />\n"; 
if ($HTTP_X_FORWARDER_FOR) $body .= "Ваш IP через прокси: <b>$HTTP_X_FORWARDER_FOR</b><br />\n"; 
?> 
<b style="font-size:72px; color:#990; font-weight:bolder"><i><?=$id?></i></b><br /><b style="font-size:48px;"><?=$a[$id]?></b>
<p><?=$body?></p> 
<?=$GLOBALS['SERVER_SIGNATURE']?>
<style>
#zz {
position: fixed;
bottom: 0; right:0;
text-align:center;
z-index: 9999; /*--Панель всегда поверх всех остальных элементов--*/
margin-right:0 !important;
float:right;
}
</style>
<img src="http://light-cms.ru/img/doh.png" width="290" height="267" align="right" id="zz">