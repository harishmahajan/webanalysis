<?php /* Smarty version Smarty-3.1.17, created on 2014-11-26 00:02:05
         compiled from "/var/www/application/public/templates/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:831555797541920d72064f5-58055664%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '61c8970735bceabc3e756e963d4bb827f409fd43' => 
    array (
      0 => '/var/www/application/public/templates/login.tpl',
      1 => 1416973778,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '831555797541920d72064f5-58055664',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_541920d7287cf1_34267522',
  'variables' => 
  array (
    'register_error' => 0,
    'login_error' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_541920d7287cf1_34267522')) {function content_541920d7287cf1_34267522($_smarty_tpl) {?><div class="row" style="margin-top:70px;">
    <div class="col-lg-6">
        <div class="well bs-component">
            <form class="form-horizontal" method="post" action="/log/in">
                <fieldset>

                    <legend>Register</legend>

                    <?php if ($_smarty_tpl->tpl_vars['register_error']->value) {?>
                        <div class="form-group">
                            <p class="text-center text-danger">
                                <?php echo $_smarty_tpl->tpl_vars['register_error']->value;?>

                            </p>
                        </div>
                    <?php }?>

                    <div class="form-group">
                        <label for="inputFirstname" class="col-lg-3 control-label">First Name</label>
                        <div class="col-lg-9">
                            <input type="text" name="firstname" class="form-control" id="inputFirstname" placeholder="First Name" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputLastname" class="col-lg-3 control-label">Last Name</label>
                        <div class="col-lg-9">
                            <input type="text" name="lastname" class="form-control" id="inputLastname" placeholder="Last Name" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="col-lg-3 control-label">Email</label>
                        <div class="col-lg-9">
                            <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-lg-3 control-label">Password</label>
                        <div class="col-lg-9">
                            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-9 col-lg-offset-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </fieldset>
                <input type="hidden" name="action" value="register">
            </form>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="bs-component">
            <form class="form-horizontal" method="post" action="/log/in">
                <fieldset>

                    <?php if ($_smarty_tpl->tpl_vars['login_error']->value) {?>
                        <div class="form-group">
                            <p class="text-center text-danger">
                                <?php echo $_smarty_tpl->tpl_vars['login_error']->value;?>

                            </p>
                        </div>
                    <?php }?>

                    <legend>Log in</legend>

                    <div class="form-group">
                        <label for="inputEmail" class="col-lg-3 control-label">Email</label>
                        <div class="col-lg-9">
                            <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-lg-3 control-label">Password</label>
                        <div class="col-lg-9">
                            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-9 col-lg-offset-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </fieldset>
                <input type="hidden" name="action" value="login">
            </form>
        </div>
    </div>
</div><?php }} ?>
