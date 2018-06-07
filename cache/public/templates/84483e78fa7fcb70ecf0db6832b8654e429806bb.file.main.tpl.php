<?php /* Smarty version Smarty-3.1.17, created on 2015-03-03 20:34:56
         compiled from "/var/www/application/public/templates/main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:828029616541920d728bcb6-48874270%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '84483e78fa7fcb70ecf0db6832b8654e429806bb' => 
    array (
      0 => '/var/www/application/public/templates/main.tpl',
      1 => 1425443674,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '828029616541920d728bcb6-48874270',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_541920d72bdf30_34495727',
  'variables' => 
  array (
    'isLoggedin' => 0,
    'logged' => 0,
    'leftmenu' => 0,
    'content' => 0,
    'popups' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_541920d72bdf30_34495727')) {function content_541920d72bdf30_34495727($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <title>Project Bionic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <link rel="stylesheet" href="/resources/css/bionic.css">
    <link rel="stylesheet" href="/resources/css/slidebars.css">
    <link rel="stylesheet" href="/resources/css/slide-styles.css">
    <script type="text/javascript" src="/resources/js/bootstrap-tab.js"></script>
    <script type="text/javascript" src="/resources/js/slidebars.js"></script>       
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="/resources/js/jquery.mCustomScrollbar.concat.min.js"></script> 
    <link rel="stylesheet" href="/resources/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" type="text/css" media="all" href="/resources/css/daterangepicker-bs3.css" />
    <script type="text/javascript" src="/resources/js/moment.min.js"></script>
    <script type="text/javascript" src="/resources/js/daterangepicker.js"></script>
    <script type="text/javascript" src="/resources/js/jquery.loadingbar.js"></script>
    <link rel="stylesheet" href="/resources/css/loadingbar.css">
    <script type="text/javascript">
               
        $(function(){
        $.slidebars();
        //$('.content').css({ "min-height": $(win).innerHeight() });

       /* $( "#toggelButtonScroll" ).click(function() {
            scrollHeight=$("#boxscroll").outerHeight();
            if(scrollHeight>230)
            {             
                $('.scrollMenu').append().css({ "height":"230px"});
            }
        });*/

        $(window).resize(function(){
            var win =$(window);
            $('.content').css({ "min-height": $(win).innerHeight() });            
            console.log("window width "+win.width());
      });
    });
    </script>
</head>
<?php if ($_smarty_tpl->tpl_vars['isLoggedin']->value) {?>
<body id="changeColor">
<?php } else { ?>
<body id="">
<?php }?> 

<div class="container" id="main_loading">  
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="row">   
        <?php if ($_smarty_tpl->tpl_vars['isLoggedin']->value) {?> 
        <div type="button" class="">
            <a href="#menu" class="sb-toggle-left pull-left slidButton" id="toggelButtonScroll"> </a>
        </div> 
        <div class="col-xs-3 ResIMG" style="">
        <?php } else { ?>
        <div class="col-xs-3 loginIMG" style="">
        <?php }?>         
            <a href="/">
                <img src="/resources/img/logo.png" style="height:50px;" class="img-responsive logoIMG">
                </a>
        </div>
        <div class="pull-right" id="user">                
               <?php echo $_smarty_tpl->tpl_vars['logged']->value;?>

        </div>
      </div>
</div>


    <?php if ($_smarty_tpl->tpl_vars['isLoggedin']->value) {?>   
     <div class="col-xs-12">
        <div class="row page-cont" id="leftmenu" style="padding-top:10px">
            <div class="col-xs-3 leftmenu page-cont sb-slidebar sb-left">

                <?php echo $_smarty_tpl->tpl_vars['leftmenu']->value;?>


            </div>
            <div class="col-xs-9 content Slidding" id="sb-site" style="">
            <div class="container-fluid cont" style="background-color: #d2d6d9;">
                <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

            </div>

            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="row" style="min-height:100%;min-widht:100%;">
            <?php echo $_smarty_tpl->tpl_vars['popups']->value;?>

        </div>
    </div>
    <?php } else { ?>

        <?php echo $_smarty_tpl->tpl_vars['content']->value;?>


    <?php }?>


</div> 

<span id="ShowLeftMenu" class="sb-open-left" style="display:none"> </span>
<span id="HideLeftMenu" class="sb-close" style="display:none"> </span> 
</body>


</html><?php }} ?>
