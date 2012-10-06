<?php /* Smarty version Smarty-3.1.11, created on 2012-10-06 15:06:37
         compiled from "/opt/lampp/htdocs/CMS/templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:36193666750702cdd1b6026-63989359%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7fc471d3ead6243a4481b700fc4473da00723098' => 
    array (
      0 => '/opt/lampp/htdocs/CMS/templates/index.tpl',
      1 => 1349528175,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '36193666750702cdd1b6026-63989359',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Title' => 0,
    'LoggedIn' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50702cdd204158_74022933',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50702cdd204158_74022933')) {function content_50702cdd204158_74022933($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>$_smarty_tpl->tpl_vars['Title']->value), 0);?>


Startseite!
<?php if ($_smarty_tpl->tpl_vars['LoggedIn']->value==0){?>
<a href="login">haha</a>
<?php }?>
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>