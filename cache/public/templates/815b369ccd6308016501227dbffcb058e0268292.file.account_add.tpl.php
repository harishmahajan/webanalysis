<?php /* Smarty version Smarty-3.1.17, created on 2015-03-17 03:36:29
         compiled from "/var/www/application/public/templates/account_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:557383533543ebec250b465-20996378%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '815b369ccd6308016501227dbffcb058e0268292' => 
    array (
      0 => '/var/www/application/public/templates/account_add.tpl',
      1 => 1426588565,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '557383533543ebec250b465-20996378',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_543ebec258af76_05642928',
  'variables' => 
  array (
    'account_error' => 0,
    'accountID' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543ebec258af76_05642928')) {function content_543ebec258af76_05642928($_smarty_tpl) {?><div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">
            Create a New Account<br>
            <small>Connect your 3rd party social accoount to Webanalysis.co</small>
            </h4>
         </div>
         <div class="modal-body">
        <form class="form-horizontal" role="form" method="post">
            <fieldset class="addFieldSet">               

                <?php if ($_smarty_tpl->tpl_vars['account_error']->value) {?>
                    <div class="form-group">
                        <p class="text-center text-danger">
                            <?php echo $_smarty_tpl->tpl_vars['account_error']->value;?>

                        </p>
                    </div>
                <?php }?>

                <div class="row">
                    <div class="col-md-12">
                        <label for="inputAccountname" class="control-label">Account Name</label>
                    </div>
                </div>
                <div>&nbsp;</div>
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="inputAccountname" placeholder="" name="accountname">
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="inputAccountname" class="control-label">Time Zone</label>
                    </div>
                </div>
                <div>&nbsp;</div>
                <div class="row">
                    <div class="col-md-6">
                        <!-- <input type="text" class="form-control" id="inputAccountname" placeholder="" name="accountname"> -->
                        <SELECT class="form-control col-md-9" id="timeZone" name="timeZone">
                            <OPTION value="PST">Pacific Time Zone</OPTION>
                            <OPTION value="UTC">Coordinated Universal Time</OPTION>
                        </SELECT>
                    </div>
                </div>
                <div>
                  &nbsp;
                </div>
                <div class="row">
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-info pull-right">Get Started</button>
                    </div>
                </div>

            </fieldset>
        <input type="hidden" name="action" value="addaccount">
       
    </form>
  </div>
      </div><!-- /.modal-content -->
</div><!-- /.modal -->
<form id="backToDeshbord" method="post" action="/dashboard/view/<?php echo $_smarty_tpl->tpl_vars['accountID']->value;?>
">    
</form>
<script type="text/javascript">
    $(window).load(function(){
        $('#myModal').modal('show');
    });//$(window).load

     $(function () { $('#myModal').on('hide.bs.modal', function () {
      $("#backToDeshbord").submit();
  })
 });//$(function () { $('#myModal').on
</script><?php }} ?>
