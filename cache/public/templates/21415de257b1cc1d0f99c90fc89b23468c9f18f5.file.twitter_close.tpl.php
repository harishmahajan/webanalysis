<?php /* Smarty version Smarty-3.1.17, created on 2014-11-16 20:34:40
         compiled from "/var/www/application/public/templates/twitter_close.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1490294610543255f3451376-94008827%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '21415de257b1cc1d0f99c90fc89b23468c9f18f5' => 
    array (
      0 => '/var/www/application/public/templates/twitter_close.tpl',
      1 => 1416197786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1490294610543255f3451376-94008827',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_543255f355c4e6_86566088',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543255f355c4e6_86566088')) {function content_543255f355c4e6_86566088($_smarty_tpl) {?><html>
<head>
    <script type="text/javascript">
        function CloseWindow() {
        	if (window.opener != null && !window.opener.closed) {
            var txtName = window.opener.document.getElementById("txtval");
            txtName.value = "1";
        }
            window.close();
            window.opener.location.reload();
        }
    </script>
</head>
<body  onload="CloseWindow()">
</body>
</html><?php }} ?>
