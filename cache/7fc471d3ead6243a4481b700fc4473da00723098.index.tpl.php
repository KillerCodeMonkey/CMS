<?php /*%%SmartyHeaderCode:126000281150702aaebfb433-21641714%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7fc471d3ead6243a4481b700fc4473da00723098' => 
    array (
      0 => '/opt/lampp/htdocs/CMS/templates/index.tpl',
      1 => 1349528175,
      2 => 'file',
    ),
    '6caba5102ce8b372dab84f98e35ae4580c4de050' => 
    array (
      0 => '/opt/lampp/htdocs/CMS/templates/header.tpl',
      1 => 1349528138,
      2 => 'file',
    ),
    'a9d8ba829ba4fab36a4ae79ad65645bb9a0d9c82' => 
    array (
      0 => '/opt/lampp/htdocs/CMS/templates/footer.tpl',
      1 => 1345965472,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '126000281150702aaebfb433-21641714',
  'variables' => 
  array (
    'Title' => 0,
    'LoggedIn' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50702aaec7ff23_09341278',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50702aaec7ff23_09341278')) {function content_50702aaec7ff23_09341278($_smarty_tpl) {?><html>
    <head>
        <title>Startpage</title>
    </head>
    <body>
        <div id="content_wrapper">
                        <div id="loginbox">
                <form action="?authentication&p=index&m=login" method="POST">
                    <label>Login (UserName oder EMail)</label><input type="text" name="login" />
                    <label>Passwort</label><input type="password" name="pw" />
                    <input type="submit" name="login" value="login" />
                </form>
                <a href="?authentication&p=registration" title="Registrierung">registrieren</a>
                <a href="?authentication&p=lostpassword" title="Passwort vergessen">Passwort vergessen</a>
            </div>
                    


Startseite!
<a href="login">haha</a>
        </div>
    </body>
</html>

<?php }} ?>