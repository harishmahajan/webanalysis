<style>
td.my {
  font-size:11px !important;
  text-align: left; 
  font-weight: bold !important;
  font-family: avantgarde-book !important;
} 


#myCenter {
    text-align: center;
}
td.fsize
{
    font-size:9px !important;
}
div.my2
{
    font-family: avantgarde-book !important;
}
</style>
<div style="margin-top: 40px !important;">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Summary</div>
            <div class="panel-body" style="font-size: 14px;padding:10px; text-align: justify;">
                During the period, {$accountName} gained {$data_week.SumPageFanAddsUnique} new fans
                (a change of {math equation="(((x - y)/y)*100)" format="%.2f" x=$data_day.SumPageFans y=$data_day.SumPageFansFrom}%) for a total community size of {$data_day.SumPageFans} people.
                Over the course of the period, an average of {$data_week.SumPageEngagementsUniqueAvg|round:0} unique fans engaged with your content daily.
                Of these fans, the most active demographic groups where
                   
                        {if $data_week.ActiveDemographics[0]->Gender eq 'M'}Male{else}Female{/if} {$data_week.ActiveDemographics[0]->Age}
                   
                and
                    
                        {if $data_week.ActiveDemographics[1]->Gender eq 'M'}Male{else}Female{/if} {$data_week.ActiveDemographics[1]->Age}
                    .
                This engagement with your content served to extend the reach of your brand message by an average of approximately
                   
                        {($data_week.AvgImpressionsUnique - $data_week.AvgImpressionsFanUnique)|round:0} non-fans per post
                    .
            </div>
        </div>

    </div>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Recent Community Growth</div>
            <div class="text-center strach">{$Charts.rcg}</div>
        </div>
    </div>
</div>

     
<div class="col-md-6 my2" style="widht:350px; height:325px;">

    <div class="panel panel-default key" >

        <h2>TOTAL</h2>
        <h2>ENGAGEMENTS</h2>
        <h2>{$data_week.SumPageEngagedUsers}</h2>

        <table class="midtable">
            <tbody>
            <tr>
                <td>&nbsp;</td>
                <td><b>{$data_week.SumPageLike}</b></td>
                <td>Likes</td>
                <td><b>{$data_week.SumPageStorytellers}</b></td>
                <td>Shares</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><b>{$data_week.SumPageComment}</b></td>
                <td>Comments</td>
                <td><b>{$data_week.SumPageLink}</b></td>
                <td>Clicks</td>
                <td>&nbsp;</td>
            </tr>
            </tbody>
        </table>

        <hr>

        <table class="midtable">
            <tbody>
            <tr>
                <td>REACH</td>
                <td>IMPRESSIONS</td>
            </tr>
            <tr>
                <td><b>{$data_week.SumPageImpressionsUnique}</b></td>
                <td><b>{$data_week.SumPageImpressions}</b></td>
            </tr>
            </tbody>
        </table>

    </div>

</div>

<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">Community Activity</div>
        <div class="text-center">{$Charts.ca}</div>
    </div>
</div>


<div class="col-md-6" style="margin-bottom: -10px; z-index: 10; background-color: #ffffff">
    <div class="panel panel-default" style=" z-index: 15;">
        <div class="panel-heading">Demographics</div>
        <div class="text-center" style="border: solid 1px #943735;">
            <div style="width:60%; margin-left:20%" class="text-center">{$Charts.dem_pie}</div>
            <div>{$Charts.dem}</div>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">Active Demographics</div>
        <div class="text-center">{$Charts.demographics}</div>
    </div>
</div>

</div>

<table width="100%" class="pdffooter" style="z-index: 5;">
    <tr>
        <td align="right">
            <img src="/var/www/html/resources/img/pdf_pwered_by_bionic_new1.png" height="25px">
        </td>
    </tr>
</table>

<table class="pdfheader" style="font-family: avantgarde-book">
    <tr>
        <td>
            <img src="/var/www/html/resources/img/pdf_facebook.jpg" height="25px" width="26px" />
            {$acName}
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


 <div class="page" style="font-family: avantgarde-book">
<div class="col-md-12">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Organic vs. Paid Likes</div>
            <div class="text-center">{$Charts.ovp}</div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-default">       
            <div class="panel-body" style="">
                <table class="table table-hover table-condensed" style="height:300px;widht:100px;margin-bottom:5px;margin-left:30px;margin-top:10px"> 
                 <thead>                 
                        <tr>
                            <td class="my" width="70%">TOP FAN LOCATIONS</td>
                            <td width="30%">#</td>
                        </tr>
                    </thead>             
                    <tbody>
                    {foreach from=$TopCities item=row name=city}
                        <tr>
                            <td class="fsize">&nbsp;&nbsp;&nbsp;{$smarty.foreach.city.iteration}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$row->City}</td>
                            <td class="fsize">{$row->val}</td>
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-default">
            
            <div class="panel-body">
                <table class="table table-hover table-condensed" style="margin-bottom:10px;margin-left:30px;widht:300px">
                    <thead>                                  
                        <tr>
                            <td class="my" width="70%">TOP EXTERNAL TRAFFIC SOURCES</td>
                            <td width="30%">#</td>
                        </tr>
                    </thead>
                    <tbody>
                    {foreach from=$TopExTrafficSources item=row name=referral}
                        <tr>
                            <td class="fsize">&nbsp;&nbsp;&nbsp;{$smarty.foreach.referral.iteration}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$row->Referral}</td>
                            <td class="center fsize">{$row->val}</td>
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">Content Breakdown</div>
        <div><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Top 10 Post for the Period</b></div>
        <div class="panel-body">
            <table class="table table-condensed myCenter" style="width:100%;font-size:12px !important;">
                <thead>
                <tr>
                    <td class="my" width="10%">DATE</td>
                    <td class="my"></td>
                    <td class="my" >POST</td>
                    <td class="my" >ENGAGEMENTS</td>
                    <td class="my" >CLICKS</td>
                    <td class="my" >ENGAGED</td>
                    <td class="my" >REACH</td>
                    <td class="my" >IMPRESSIONS</td>                    
                    <td class="my" width="13%">&nbsp;&nbsp;VIRAL REACH</td>
                </tr>
                </thead>
                <tbody>
                {foreach $ContentBreakdown as $row}
                    <tr >
                        <td>{$row->day}</td>
                        <td></td>
                        <td>{$row->Post_message}...</a></td>
                        <td align="center">{$row->Post_story_adds}</td>
                        <td align="center">{$row->Post_consumptions}</td>
                        <td align="center">{math equation="round( ((( x + y ) / z) * 100) ,1)" x=$row->Post_story_adds y=$row->Post_consumptions z=$row->Post_impressions_unique}%</td>
                        <td align="center">{$row->Post_impressions_unique}</td>
                        <td align="center">{$row->Post_impressions}</td>
                        <td align="center">{math equation="round( (((x - y) / x) * 100) ,1)" x=$row->Post_impressions_unique y=$row->Post_impressions_fan_unique}%</td>
                    </tr>
                {/foreach}
                {if $AvgContentBreakdown->min_day}
                    <tr>
                        <td colspan="3" align="center"><b>Average from {$AvgContentBreakdown->min_day} to {$AvgContentBreakdown->max_day}</b></td>
                        
                        <td align="center">{$AvgContentBreakdown->avg_Post_story_adds|round}</td>
                        <td align="center">{$AvgContentBreakdown->avg_Post_consumptions|round}</td>
                        <td align="center">{math equation="round( ((( x + y ) / z) * 100) ,1)" x=$AvgContentBreakdown->avg_Post_story_adds y=$AvgContentBreakdown->avg_Post_consumptions z=$AvgContentBreakdown->avg_Post_impressions_unique}%</td>
                        <td align="center">{$AvgContentBreakdown->avg_Post_impressions_unique|round}</td>
                        <td align="center">{$AvgContentBreakdown->avg_Post_impressions|round}</td>
                        <td align="center">{math equation="round( (((x - y) / x) * 100) ,1)" x=$AvgContentBreakdown->avg_Post_impressions_unique y=$AvgContentBreakdown->avg_Post_impressions_fan_unique}%</td>
                    </tr>
                {/if}
                {if $AvgContentBreakdown_last->min_day}
                    <tr>
                        <td colspan="3" align="center"><b>Average from {$AvgContentBreakdown_last->min_day} to {$AvgContentBreakdown_last->max_day}</b></td>                        
                        <td align="center">{$AvgContentBreakdown_last->avg_Post_story_adds|round}</td>
                        <td align="center">{$AvgContentBreakdown_last->avg_Post_consumptions|round}</td>
                        <td align="center">{math equation="round( ((( x + y ) / z) * 100) ,1)" x=$AvgContentBreakdown_last->avg_Post_story_adds y=$AvgContentBreakdown_last->avg_Post_consumptions z=$AvgContentBreakdown_last->avg_Post_impressions_unique}%</td>
                        <td align="center">{$AvgContentBreakdown_last->avg_Post_impressions_unique|round}</td>
                        <td align="center">{$AvgContentBreakdown_last->avg_Post_impressions|round}</td>
                        <td align="center">{math equation="round( (((x - y) / x) * 100) ,1)" x=$AvgContentBreakdown_last->avg_Post_impressions_unique y=$AvgContentBreakdown_last->avg_Post_impressions_fan_unique}%</td>
                    </tr>
                {/if}
                </tbody>
            </table>
        </div>
    </div>
</div>
<br>

<div class="col-md-12" style="font-family: avantgarde-book">

    <div class="panel panel-default" style="margin-bottom: 20px;">
        <div class="panel-heading">Reach Breakdown</div>        
    </div>

    <div class="col-md-4">
        <div class="text-center">{$Charts.rbd}</div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div style="font-size:12px !important;text-align: center;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;COMMUNITY METRICS<b></div>
            <div class="text-center">
                <table class="table table-hover table-condensed" style="font-size:12px !important;">
                    <tbody>
                    <tr>
                        <td style="border-top: none;">
                            <div>Average Daily Reach</div>
                            (unique users access on facebook)
                        </td>
                        <td>{$CommunityMetrics->daily_reach|round:0}</td>
                    </tr>
                    <tr>
                        <td>
                            <div>Average Daily Impressions</div>
                            (unique user access on facebook)
                        </td>
                        <td>{$CommunityMetrics->daily_impr|round:0}</td>
                    </tr>
                    <tr>
                       <td>
                            <div>Your Community Engagement</div>
                            (of the fans that saw your post)>
                        </td>
                        <td>{math equation="(( x / y ) * 100)"  format="%.2f" x=$AvgContentBreakdown->avg_Post_engaged_users y=$AvgContentBreakdown->avg_Post_impressions_unique}%</td>
                    </tr>
                    <tr>
                       <td>
                            <div>Fan Growth Ratio</div>
                            (measures stickiness of new fans vs lost fans)
                        </td>
                        <td>{math equation="( ( 1 - ( x / y ) ) * 100 )"  format="%.2f" x=$CommunityMetrics->fan_rem y=$CommunityMetrics->fan_add}%</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<div class="col-md-4">
        <div class="panel panel-default">
            <div style="font-size:12px !important;text-align: center;"><b>INTERNAL FAN SOURCES</b></div>
            <div class="text-center">{$Charts.ifs}</div>
        </div>
        <table>
    <tr >
        <td valign="bottom"><img src="/var/www/html/resources/img/first.png" style="float:left;width:55px;height:10px;position:relative;" />
</td>
 <td valign="bottom"><img src="/var/www/html/resources/img/sec.png"  style="float:left;width:47px;height:11px"/>

</td>
 <td valign="bottom">
    <img src="/var/www/html/resources/img/third.png" style="float:left;width:36px;height:12px"/>

    </td>
    </tr>
    <tr>
         <td valign="bottom">
            <img src="/var/www/html/resources/img/for.png" style="float:left;width:75px;height:12px"/>

        </td>
       <td valign="bottom">
            <img src="/var/www/html/resources/img/fif.png" style="float:left;width:35px;height:11px"/>

        </td>
    </tr>
    </table>
</div>