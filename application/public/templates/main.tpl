<!DOCTYPE html>
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
{if $isLoggedin}
<body id="changeColor">
{else}
<body id="">
{/if} 

<div class="container" id="main_loading">  
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="row">   
        {if $isLoggedin} 
        <div type="button" class="">
            <a href="#menu" class="sb-toggle-left pull-left slidButton" id="toggelButtonScroll"> </a>
        </div> 
        <div class="col-xs-3 ResIMG" style="">
        {else}
        <div class="col-xs-3 loginIMG" style="">
        {/if}         
            <a href="/">
                <img src="/resources/img/logo.png" style="height:50px;" class="img-responsive logoIMG">
                </a>
        </div>
        <div class="pull-right" id="user">                
               {$logged}
        </div>
      </div>
</div>


    {if $isLoggedin}   
     <div class="col-xs-12">
        <div class="row page-cont" id="leftmenu" style="padding-top:10px">
            <div class="col-xs-3 leftmenu page-cont sb-slidebar sb-left">

                {$leftmenu}

            </div>
            <div class="col-xs-9 content Slidding" id="sb-site" style="">
            <div class="container-fluid cont" style="background-color: #d2d6d9;">
                {$content}
            </div>

            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="row" style="min-height:100%;min-widht:100%;">
            {$popups}
        </div>
    </div>
    {else}

        {$content}

    {/if}


</div> 

<span id="ShowLeftMenu" class="sb-open-left" style="display:none"> </span>
<span id="HideLeftMenu" class="sb-close" style="display:none"> </span> 
</body>


</html>