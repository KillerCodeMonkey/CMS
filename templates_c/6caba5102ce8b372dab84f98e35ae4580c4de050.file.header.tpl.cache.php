<?php /* Smarty version Smarty-3.1.11, created on 2012-10-06 14:57:18
         compiled from "/opt/lampp/htdocs/CMS/templates/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:175457344050702aaec4c243-19798416%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6caba5102ce8b372dab84f98e35ae4580c4de050' => 
    array (
      0 => '/opt/lampp/htdocs/CMS/templates/header.tpl',
      1 => 1349528138,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '175457344050702aaec4c243-19798416',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'LoggedIn' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50702aaec78d99_74182908',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50702aaec78d99_74182908')) {function content_50702aaec78d99_74182908($_smarty_tpl) {?><html>
    <head>
        <title><?php echo (($tmp = @$_smarty_tpl->tpl_vars['title']->value)===null||$tmp==='' ? "Hey HO" : $tmp);?>
</title>
    </head>
    <body>
        <div id="content_wrapper">
            <?php if ($_smarty_tpl->tpl_vars['LoggedIn']->value==0){?>
            <div id="loginbox">
                <form action="?authentication&p=index&m=login" method="POST">
                    <label>Login (UserName oder EMail)</label><input type="text" name="login" />
                    <label>Passwort</label><input type="password" name="pw" />
                    <input type="submit" name="login" value="login" />
                </form>
                <a href="?authentication&p=registration" title="Registrierung">registrieren</a>
                <a href="?authentication&p=lostpassword" title="Passwort vergessen">Passwort vergessen</a>
            </div>
            <?php }?>
        
<?php }} ?>