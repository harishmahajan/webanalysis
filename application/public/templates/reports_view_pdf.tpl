<html>
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
            {if $oConnection->Type eq 'facebook'}
                <img src="/var/www/html/resources/img/pdf_facebook.jpg" height="25px" width="26px" />
            {elseif  $oConnection->Type eq 'twitter'}
                <img src="/var/www/html/resources/img/pdf_tweeter.jpg" height="25px" width="26px" />
            {/if}
            {$accountName}
        </td>
        <td align="right" style="font-size:16px">
            {if {$report_date_to|date_format:"%m"} eq {$report_date_from|date_format:"%m"}} 
                {$report_date_to|date_format:"%B"} summary Report {$report_date_to}
            {else}
                {$report_date_from} To {$report_date_to}
            {/if} 
        </td>
    </tr>
</table>
</htmlpageheader>
<sethtmlpageheader name="myheader" value="on" page="ALL" show-this-page="1" />
mpdf-->

<div class="page" style="margin-top: 30px !important;height: 950px;">
    {$report}
</div>

<table width="100%" class="pdffooter">
    <tr>
        <td align="right">
            <img src="/var/www/html/resources/img/pdf_pwered_by_bionic_new1.png" height="23px">
        </td>
    </tr>
</table>

</body>
</html>