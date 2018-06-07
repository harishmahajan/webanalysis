<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Project Bionic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <link rel="stylesheet" href="/resources/css/bionic.css">
    <link rel="stylesheet" href="/resources/css/nprogress.css">
    <script type="text/javascript" src="/resources/js/bootstrap-tab.js"></script>        
    <script type="text/javascript" src="/resources/js/nprogress.js"></script>  

<script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

</head>
<body>
<script>

    $('body').show();
    $('.version').text(NProgress.version);
    NProgress.start();
    setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000); 

    $(function(){
      $('.content').css({ "min-height": $("#leftmenu").innerHeight() });
      $(window).resize(function(){
        $('.content').css({ "min-height": $("#leftmenu").innerHeight() });
      });
    });
    
</script>

<div class="container" id="main_loading">
    
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="">
        <div class="">
          <a href="/">
            <img src="/resources/img/logo.png" style="height:50px;width:258px">
          </a>
          <span class="pull-right" style="padding-right:50px"> {$logged}</span>
        </div>
      </div>
</div>

    {if $isLoggedin}

        <div class="row page-cont" id="leftmenu">
            <div class="col-lg-3 leftmenu">

                {$leftmenu}

            </div>
            <div class="col-lg-9 content">

                {$content}

            </div>
        </div>

    {else}

        {$content}

    {/if}


</div>

</body>
</html>