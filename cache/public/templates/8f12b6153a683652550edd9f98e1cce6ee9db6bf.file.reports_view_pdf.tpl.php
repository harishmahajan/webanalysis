<?php /* Smarty version Smarty-3.1.17, created on 2015-02-27 11:20:49
         compiled from "/var/www/application/public/templates/reports_view_pdf.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3211694195419497f01c899-46340083%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8f12b6153a683652550edd9f98e1cce6ee9db6bf' => 
    array (
      0 => '/var/www/application/public/templates/reports_view_pdf.tpl',
      1 => 1425035820,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3211694195419497f01c899-46340083',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5419497f0b68d7_25674949',
  'variables' => 
  array (
    'oConnection' => 0,
    'accountName' => 0,
    'report_date_to' => 0,
    'report_date_from' => 0,
    'report' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5419497f0b68d7_25674949')) {function content_5419497f0b68d7_25674949($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'library/smarty/plugins/modifier.date_format.php';
?><html>
<head>
<style>

@page {
    margin: 40px !important;
}
.pdfheader
{
    background-color: #953735;
    color: #FFFFFF;
    font-size: 32px;
    line-height: 35px;
    height: 35px;
    width: 100%;   
    margin-top: 40px !important;
    text-align: left;
    font-family: avantgarde-book !important;
}
.pdffooter
{
    background-color: #525252 !important;
    color: #FFFFFF ;
    font-size: 16px;
    line-height: 30px;
    height: 30px;
    width: 100%;
    clear: both;
    padding: 5px 5px !important;
    text-align: right;
    
    font-family: avantgarde-book !important;
}
.pdffooter:last-child
{
    page-break-after:avoid !important;
}
.page
{
    width: 100%;
    height: 950px;
    border: 2px solid #953735;
    position: relative; 
    
}
.panel-heading{
    margin: 2px 0 2px 0;
    padding: 0;
    border: 2px solid #953735;
    color: #000000;
    font-weight: bold;
    font-size: 18px;
    text-align: center;
    font-family: avantgarde-book !important;
}

.col-md-12{
    width: 100%;
    padding: 0 10px;
    
}
.col-md-6{
    width: 48%;
    float: left;
    position: relative;
    padding: 5px 0 0 10px;
    
}

.col-md-4{
    width: 31%;
    float: left;
    position: relative;
    padding: 0 0 0 10px;
    
}
.col-md-3{
    width: 24%;
    float: left;
    position: relative;
    padding: 0 0 0 10px;
    
}
table{
    font-size:12px;
    width: 100%;
    
}
.right{
    text-align: right;
    
}
.center
{
    align: center; 
}

.key{
    background-color: #484848;
    color:#ffffff;
    margin-top:0px;
    padding:10px 0;
    text-align: center;
    
}
.key H2{
    text-align: center;
    margin: 2px;
    
}
.midtable{
    color: #ffffff;
    text-align: center;
    font-size: 18px;
    font-family: avantgarde-book !important;
}
HR{
    height: 1px;
    color: #ffffff;
    background-color: #ffffff;
    border: none;
    
}
.highlite{
    color: #ec7466;
    font-weight: bold;    
}
</style>
</head>
<body>

<!--new-->
<!--mpdf
<htmlpageheader name="myheader" >
<table class="pdfheader">
    <tr>
         <td>
            <?php if ($_smarty_tpl->tpl_vars['oConnection']->value->Type=='facebook') {?>
                <img src="/var/www/html/resources/img/pdf_facebook.jpg" height="25px" width="26px" />
            <?php } elseif ($_smarty_tpl->tpl_vars['oConnection']->value->Type=='twitter') {?>
                <img src="/var/www/html/resources/img/pdf_tweeter.jpg" height="25px" width="26px" />
            <?php }?>
            <?php echo $_smarty_tpl->tpl_vars['accountName']->value;?>

        </td>
        <td align="right" style="font-size:16px">
            <?php ob_start();?><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['report_date_to']->value,"%m");?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['report_date_from']->value,"%m");?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp1==$_tmp2) {?> 
                <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['report_date_to']->value,"%B");?>
 summary Report <?php echo $_smarty_tpl->tpl_vars['report_date_to']->value;?>

            <?php } else { ?>
                <?php echo $_smarty_tpl->tpl_vars['report_date_from']->value;?>
 To <?php echo $_smarty_tpl->tpl_vars['report_date_to']->value;?>

            <?php }?> 
        </td>
    </tr>
</table>
</htmlpageheader>
<sethtmlpageheader name="myheader" value="on" page="ALL" show-this-page="1" />
mpdf-->

<div class="page" style="margin-top: 30px !important;height: 950px;">
    <?php echo $_smarty_tpl->tpl_vars['report']->value;?>

</div>

<table width="100%" class="pdffooter">
    <tr>
        <td align="right">
            <img src="/var/www/html/resources/img/pdf_pwered_by_bionic_new1.png" height="23px">
        </td>
    </tr>
</table>

</body>
</html><?php }} ?>
