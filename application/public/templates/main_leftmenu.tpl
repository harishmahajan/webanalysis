
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
    {foreach $accounts as $acc}
        <a href="/account/connections/{$acc->AccountID}" class="ico_dot{if $acc->AccountID eq $queryArray[2]}_sel{/if}">{$acc->Name}</a>
    {/foreach}
</div> -->

<div class="lmenu col-xs-3 scrollMenu" id="boxscroll">
    {foreach $accounts as $acc}
        <a href="#" data-location="{$acc->AccountID}" class="ico_dot{if $acc->AccountID eq $queryArray[2]}_sel{/if}" id="link">{$acc->Name}</a>
    {/foreach}
</div>


<!-- history.pushState(null, "A new title!", "url") -->

<div class="lmenu Lmenu LeftBelowMenu">
    <a id="dash" style="padding-left:30px" href="/dashboard/view/{if $queryArray[2]}{$queryArray[2]}{/if}" class="highlightit sep {if $queryArray[0] eq 'dashboard'}act{/if}"><span><img src="/resources/img/deshbord.png"></span>&nbsp;&nbsp;&nbsp;Go To Dashboard</a>

    <a id="rep" style="padding-left:32px" href="/reports/view/{if $queryArray[2]}{$queryArray[2]}{/if}" class="highlightit sep {if $queryArray[0] eq 'reports'}act{/if}"><span><img src="/resources/img/report.png"></span>&nbsp;&nbsp;&nbsp;Genetate Reports</a>

    <a id="con" style="padding-left:30px" href="/account/connections/{$queryArray[2]}" class="highlightit sep {if $queryArray[1] eq 'connections'}act{/if}"><span><img src="/resources/img/connection.png"></span>&nbsp;&nbsp;&nbsp;Manage Connection</a>

    <a style="padding-left:30px" href="#" class="highlightit sep {if $queryArray[0] eq 'achive'}act{/if}"><span><img src="/resources/img/archive.png"></span>&nbsp;&nbsp;&nbsp;View Archive</a>

    <a style="padding-left:30px" href="#" class="highlightit sep {if $queryArray[0] eq 'achive'}act{/if}"><span><img src="/resources/img/account.png"></span>&nbsp;&nbsp;&nbsp;Edit Account Information</a>
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
</script>