<?php /* Smarty version Smarty-3.1.17, created on 2014-12-05 03:13:25
         compiled from "/var/www/application/public/templates/main_logged.tpl" */ ?>
<?php /*%%SmartyHeaderCode:798027170541920e24d8b80-28239957%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce17533e80297464429e3837827eecd94e1f2b8e' => 
    array (
      0 => '/var/www/application/public/templates/main_logged.tpl',
      1 => 1417777980,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '798027170541920e24d8b80-28239957',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_541920e24dc8e6_96599959',
  'variables' => 
  array (
    'fullname' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_541920e24dc8e6_96599959')) {function content_541920e24dc8e6_96599959($_smarty_tpl) {?><div class="hidden-xs ">
<p class="navbar-text navbar-right">
    Signed in as <?php echo $_smarty_tpl->tpl_vars['fullname']->value;?>

    |
    <a href="/log/out">
        Logout
    </a>
</p>
</div>
<div class="visible-xs pull-right">
<button type="button" class="btn btn-warning" title=""  
      data-container="body" data-toggle="popover" data-placement="bottom" 
      data-content='Signed in as <?php echo $_smarty_tpl->tpl_vars['fullname']->value;?>
|<a href="/log/out">Logout</a>"' style="width:50px;">
      <span class="glyphicon glyphicon-user" style=""></span>
   </button>
</div>
  <script>$(function () 
      { $("[data-toggle='popover']").popover(
        {
          html:true
        });
      });
   </script><?php }} ?>
