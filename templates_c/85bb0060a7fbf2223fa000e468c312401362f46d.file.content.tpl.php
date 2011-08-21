<?php /* Smarty version Smarty-3.0.8, created on 2011-07-07 20:10:36
         compiled from "templates/lcms/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:292314e15da7c42ee65-45105211%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '85bb0060a7fbf2223fa000e468c312401362f46d' => 
    array (
      0 => 'templates/lcms/content.tpl',
      1 => 1310055001,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '292314e15da7c42ee65-45105211',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
</div>
<div class="content">
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
<div class="sidecontent">
		<div class="ctop"><a href="posts_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
_1.html"><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</a></div>
			<div class="ccon">
           <?php echo $_smarty_tpl->tpl_vars['item']->value['text'];?>

		</div>
		<div class="cinfo"> Комментариев: <?php echo $_smarty_tpl->tpl_vars['item']->value['comments'];?>
</div>
  <div class="cinfo">Просмотров: <?php echo $_smarty_tpl->tpl_vars['item']->value['views'];?>
</div>
		<div class="cinfo" style="float: right;"><a href="posts_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
_1.html" class="links">Далее...</a></div>
</div>
        <?php }} else { ?>
    Ничего не найдено
<?php } ?>