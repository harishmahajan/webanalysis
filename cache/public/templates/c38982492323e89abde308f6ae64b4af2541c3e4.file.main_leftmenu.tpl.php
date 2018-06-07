<?php /* Smarty version Smarty-3.1.17, created on 2015-03-16 23:18:15
         compiled from "/var/www/application/public/templates/main_leftmenu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1891207256541920e24deb56-91125018%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c38982492323e89abde308f6ae64b4af2541c3e4' => 
    array (
      0 => '/var/www/application/public/templates/main_leftmenu.tpl',
      1 => 1426572968,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1891207256541920e24deb56-91125018',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_541920e2559182_76326229',
  'variables' => 
  array (
    'accounts' => 0,
    'acc' => 0,
    'queryArray' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_541920e2559182_76326229')) {function content_541920e2559182_76326229($_smarty_tpl) {?>
<style type="text/css">
a {
    text-decoration: none!important;
}
.highlightit img{
filter:progid:DXImageTransform.Microsoft.Alpha(opacity=50);
-moz-opacity: 0.5;
opacity: 0.5;
}

.highlightit:hover img{
filter:progid:DXImageTransform.Microsoft.Alpha(opacity=100);
-moz-opacity: 1;
opacity: 1;
}
</style>
<!-- <div class="lmenu col-xs-3 scrollMenu" id="boxscroll">
    <?php  $_smarty_tpl->tpl_vars['acc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['acc']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['accounts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['acc']->key => $_smarty_tpl->tpl_vars['acc']->value) {
$_smarty_tpl->tpl_vars['acc']->_loop = true;
?>
        <a href="/account/connections/<?php echo $_smarty_tpl->tpl_vars['acc']->value->AccountID;?>
" class="ico_dot<?php if ($_smarty_tpl->tpl_vars['acc']->value->AccountID==$_smarty_tpl->tpl_vars['queryArray']->value[2]) {?>_sel<?php }?>"><?php echo $_smarty_tpl->tpl_vars['acc']->value->Name;?>
</a>
    <?php } ?>
</div> -->

<div class="lmenu col-xs-3 scrollMenu" id="boxscroll">
    <?php  $_smarty_tpl->tpl_vars['acc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['acc']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['accounts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['acc']->key => $_smarty_tpl->tpl_vars['acc']->value) {
$_smarty_tpl->tpl_vars['acc']->_loop = true;
?>
        <a href="#" data-location="<?php echo $_smarty_tpl->tpl_vars['acc']->value->AccountID;?>
" class="ico_dot<?php if ($_smarty_tpl->tpl_vars['acc']->value->AccountID==$_smarty_tpl->tpl_vars['queryArray']->value[2]) {?>_sel<?php }?>" id="link"><?php echo $_smarty_tpl->tpl_vars['acc']->value->Name;?>
</a>
    <?php } ?>
</div>


<!-- history.pushState(null, "A new title!", "url") -->

<div class="lmenu Lmenu LeftBelowMenu">
    <a id="dash" style="padding-left:30px" href="/dashboard/view/<?php if ($_smarty_tpl->tpl_vars['queryArray']->value[2]) {?><?php echo $_smarty_tpl->tpl_vars['queryArray']->value[2];?>
<?php }?>" class="highlightit sep <?php if ($_smarty_tpl->tpl_vars['queryArray']->value[0]=='dashboard') {?>act<?php }?>"><span><img src="/resources/img/deshbord.png"></span>&nbsp;&nbsp;&nbsp;Go To Dashboard</a>

    <a id="rep" style="padding-left:32px" href="/reports/view/<?php if ($_smarty_tpl->tpl_vars['queryArray']->value[2]) {?><?php echo $_smarty_tpl->tpl_vars['queryArray']->value[2];?>
<?php }?>" class="highlightit sep <?php if ($_smarty_tpl->tpl_vars['queryArray']->value[0]=='reports') {?>act<?php }?>"><span><img src="/resources/img/report.png"></span>&nbsp;&nbsp;&nbsp;Genetate Reports</a>

    <a id="con" style="padding-left:30px" href="/account/connections/<?php echo $_smarty_tpl->tpl_vars['queryArray']->value[2];?>
" class="highlightit sep <?php if ($_smarty_tpl->tpl_vars['queryArray']->value[1]=='connections') {?>act<?php }?>"><span><img src="/resources/img/connection.png"></span>&nbsp;&nbsp;&nbsp;Manage Connection</a>

    <a style="padding-left:30px" href="#" class="highlightit sep <?php if ($_smarty_tpl->tpl_vars['queryArray']->value[0]=='achive') {?>act<?php }?>"><span><img src="/resources/img/archive.png"></span>&nbsp;&nbsp;&nbsp;View Archive</a>

    <a style="padding-left:30px" href="#" class="highlightit sep <?php if ($_smarty_tpl->tpl_vars['queryArray']->value[0]=='achive') {?>act<?php }?>"><span><img src="/resources/img/account.png"></span>&nbsp;&nbsp;&nbsp;Edit Account Information</a>
    <div>&nbsp;</div>
    <center><small><font color="gray">&copy;&nbsp;copyright 2014. All rights reserved</font></small></center>
</div>
<script>
(function($){
    $('a').click(function (e) {
        
        if($(this).attr('id')=='link')
        {
            e.preventDefault();
              // Detect if pushState is available
            /*if(history.pushState) {
               history.pushState(null, null, $(this).attr('data-location'));        
            }*/
            $('#boxscroll a').removeClass("ico_dot_sel"); 
            $('#boxscroll a').addClass("ico_dot");
            
            $(this).removeClass("ico_dot"); 
            $(this).addClass("ico_dot_sel");
            var pathname = window.location.pathname;
            var res = pathname.split("/");
            console.log(pathname);
            console.log(res[1]);
            console.log(res[2]);
            console.log(res[3]);
            
            $("#dash").attr("href", "/dashboard/view/"+res[3]);
            $("#rep").attr("href", "/reports/view/"+res[3]);
            $("#con").attr("href", "/account/connections/"+res[3]);

            if(res[1]=="dashboard")
                window.location="/dashboard/view/"+$(this).attr('data-location');
            else if(res[1]=="reports")
                window.location="/reports/view/"+$(this).attr('data-location');
            else if(res[1]=="account")
                window.location="/account/connections/"+$(this).attr('data-location');
            return false;
        }
    });
    $(window).load(function(){
        $("#boxscroll").mCustomScrollbar();
        scrollHeight=$("#boxscroll").outerHeight();
        //alert(scrollHeight);
        if(scrollHeight<230)
        {          
            //$('.LeftBelowMenu').css({ "top": (scrollHeight+10)+"px" });            
        }
        
    });
})(jQuery);
</script><?php }} ?>
