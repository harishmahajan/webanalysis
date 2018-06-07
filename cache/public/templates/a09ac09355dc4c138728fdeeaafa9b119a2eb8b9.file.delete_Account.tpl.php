<?php /* Smarty version Smarty-3.1.17, created on 2015-03-04 19:59:14
         compiled from "/var/www/application/public/templates/delete_Account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:180957487554f68e21b6e113-37395351%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a09ac09355dc4c138728fdeeaafa9b119a2eb8b9' => 
    array (
      0 => '/var/www/application/public/templates/delete_Account.tpl',
      1 => 1425527671,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '180957487554f68e21b6e113-37395351',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54f68e21bb0951_90895523',
  'variables' => 
  array (
    'accountID' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f68e21bb0951_90895523')) {function content_54f68e21bb0951_90895523($_smarty_tpl) {?><div class="modal fade" id="DelModal" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">        
         <div class="modal-body">
            Deleting this account will automatically delete all associated data.<br> 
            Do you want to continue?
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal" style="width: 54px">
                No
            </button> 
            <a href="/account/delAc/<?php echo $_smarty_tpl->tpl_vars['accountID']->value;?>
" id="delYesClick" class="btn btn-danger">
                Yes
            </a>            
         </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<form id="backToConnection" method="post" action="/account/connections/<?php echo $_smarty_tpl->tpl_vars['accountID']->value;?>
">   
</form>
<script>
    $(window).load(function(){
        $('#DelModal').modal('show');
        $('body#changeColor').css('padding-right','0px');

        $('#DelModal').on('hide.bs.modal', function () {
          $("#backToConnection").submit();
        });
    });

    $('#delYesClick').click(function(){    
        $('#DelModal').modal('hide');
    });
</script><?php }} ?>
