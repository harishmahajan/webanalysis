<?php /* Smarty version Smarty-3.1.17, created on 2015-03-17 06:02:27
         compiled from "/var/www/application/public/templates/errorshow.tpl" */ ?>
<?php /*%%SmartyHeaderCode:83754205054fd3b8ed2c697-19872705%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '29beab40b6a5e330f0c6dfc59b6c7e7e90872548' => 
    array (
      0 => '/var/www/application/public/templates/errorshow.tpl',
      1 => 1426597340,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '83754205054fd3b8ed2c697-19872705',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54fd3b8ed9fad3_52000044',
  'variables' => 
  array (
    'ConErr' => 0,
    'FbNullTok' => 0,
    'AccID' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54fd3b8ed9fad3_52000044')) {function content_54fd3b8ed9fad3_52000044($_smarty_tpl) {?><div class="modal fade" id="ErrModal" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content"> 
        <div class="modal-header">
            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>
            <h3 class="modal-title" style="color: orange" id="myModalLabel">
               Mayday,Mayday!
            </h3>
         </div>       
         <div class="modal-body">
            <h4>Something went wrong. Please follow the instructions below.</h4><br>
            <table class="table">
                <tr>
                    <th>Error Code</th>
                    <th>Instructions</th>
                    <th>Error</th>
                </tr>
            <?php  $_smarty_tpl->tpl_vars['err'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['err']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ConErr']->value->ConnectionID; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['err']->key => $_smarty_tpl->tpl_vars['err']->value) {
$_smarty_tpl->tpl_vars['err']->_loop = true;
?>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['ConErr']->value->ErrorCode;?>
</td>
                <?php if ($_smarty_tpl->tpl_vars['ConErr']->value->ErrorMessage=='The user must be an administrator of the page in order to impersonate it.') {?> 
                   
                        <td>The user must be an administrator of the page in order to view data.</td>     
                    
                <?php } else { ?>
                    
                        <td><?php echo $_smarty_tpl->tpl_vars['ConErr']->value->ErrorMessage;?>
</td>     
                    
                <?php }?>
               
                <td><?php echo $_smarty_tpl->tpl_vars['ConErr']->value->Site;?>
</td>              
            </tr>
            <?php } ?>

            <?php if (!empty($_smarty_tpl->tpl_vars['FbNullTok']->value)||$_smarty_tpl->tpl_vars['ConErr']->value->Site=='facebook') {?> 
            <tr>
                <td>00</td>
                <td>
                    Please Follow Steps<br>
                    1. Click on "Go to Manage Connection".<br>
                    2. Select "Load data for Facebook".<br>
                    3. Pick any Date range.<br>
                    4. Import Data.
                </td>
                <td>Missing Facebook <br>Connection</td>              
            </tr>
            <?php }?>
            <tr><td colspan="3"><b>Reconnect to Facebook/Twitter to solve the problems.</b><td></tr>
            </table>
            <?php if (empty($_smarty_tpl->tpl_vars['ConErr']->value->AccountID)) {?>
                <input type="hidden" value="0" id="txtAcID"/>
            <?php } else { ?>
                <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['AccID']->value;?>
" id="txtAcID"/>
            <?php }?>
            
         </div>
         <div class="modal-footer"> 
            <a href="#" id="ErrHide" class="btn btn-success">
                Go to manage Connection
            </a>            
         </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<form id="frmHideErr" method="post" action="/account/connections/<?php echo $_smarty_tpl->tpl_vars['AccID']->value;?>
">   
</form>
<script>
    $(window).load(function(){
        $('#ErrModal').modal('show');
        $('body#changeColor').css('padding-right','0px');

        /*$('#DelModal').on('hide.bs.modal', function () {
          $("#frmHideErr").submit();
        });*/
    });

    $('#ErrHide').click(function(){    
        //$("#frmHideErr").submit();
        var ACID;
        
        $.ajax({
            type: "POST",
            url: "/account/hideErr/",
            data: {
                accountID : "<?php echo $_smarty_tpl->tpl_vars['ConErr']->value->AccountID;?>
"
            },
            dataType: 'text',
            success:function(resultFB){
                $('#ErrModal').modal('hide');
                $("#frmHideErr").submit();
            }//suecss
        });
    });
</script>
<?php }} ?>
