<?php /* Smarty version Smarty-3.1.11, created on 2012-10-06 15:06:27
         compiled from "/opt/lampp/htdocs/CMS/templates/error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:127351549250702cd3603be8-60397670%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '368e10490015df4e888d897de811296bbe5ddb7b' => 
    array (
      0 => '/opt/lampp/htdocs/CMS/templates/error.tpl',
      1 => 1349528680,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '127351549250702cd3603be8-60397670',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Title' => 0,
    'Msg' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50702cd3660351_11687158',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50702cd3660351_11687158')) {function content_50702cd3660351_11687158($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>$_smarty_tpl->tpl_vars['Title']->value), 0);?>

<?php echo $_smarty_tpl->tpl_vars['Msg']->value;?>

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>