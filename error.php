<?php 
$id = $_GET['id'];
if (!$id) $id = 404; 

// ������������� ������ ����� � �������� 
$a[401] = "��������� �����������"; 
$a[403] = "������������ �� ������ ��������������, ������ ��������"; 
$a[404] = "�������� �� ������"; 
$a[500] = "���������� ������ �������"; 
$a[400] = "������������ ������"; 

// ���������� ���� � ����� � ����������� ������� 
$time = date("d.m.Y H:i:s"); 
// ��� ���������� �������� ���� ��������� 
$body ="
�� ���� ���-��...������� ������ �� �������?
";
if ($HTTP_REFERER) $body .= "�� ������ �� ��������: <b>$HTTP_REFERER</b><br />\n"; 
if ($HTTP_X_FORWARDER_FOR) $body .= "��� IP ����� ������: <b>$HTTP_X_FORWARDER_FOR</b><br />\n"; 
?> 
<b style="font-size:72px; color:#990; font-weight:bolder"><i><?=$id?></i></b><br /><b style="font-size:48px;"><?=$a[$id]?></b>
<p><?=$body?></p> 
<?=$GLOBALS['SERVER_SIGNATURE']?>
<style>
#zz {
position: fixed;
bottom: 0; right:0;
text-align:center;
z-index: 9999; /*--������ ������ ������ ���� ��������� ���������--*/
margin-right:0 !important;
float:right;
}
</style>
<img src="http://light-cms.ru/img/doh.png" width="290" height="267" align="right" id="zz">