<?php /* Smarty version Smarty-3.1.11, created on 2012-10-06 15:05:48
         compiled from "/opt/lampp/htdocs/CMS/templates/error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3794924850702cacd55fe3-24270484%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '3794924850702cacd55fe3-24270484',
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
  'unifunc' => 'content_50702cacd9c017_29166705',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50702cacd9c017_29166705')) {function content_50702cacd9c017_29166705($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('title'=>$_smarty_tpl->tpl_vars['Title']->value), 0);?>

<?php echo $_smarty_tpl->tpl_vars['Msg']->value;?>

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

<?php }} ?>