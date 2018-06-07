<div class="col-md-6">

    <div class="panel panel-default">
        <div class="panel-heading">Summary</div>
        <div class="panel-body" style="font-size: 14px;padding:10px;">
            During the period, {$accountName} gained <span class="highlite">{$data_week.SumPageFanAddsUnique}</span> new fans
            (<span class="highlite">a change of {math equation="(((x - y)/y)*100)" format="%.2f" x=$data_day.SumPageFans y=$data_day.SumPageFansFrom}%</span>) for a total community size of <span class="highlite">{$data_day.SumPageFans} people</span>.
            Over the course of the period, an average of <span class="highlite">{$data_week.SumPageEngagementsUniqueAvg|round:0} unique fans</span> engaged with your content daily.
            Of these fans, the most active demographic groups where
                <span class="highlite">
                    {if $data_week.ActiveDemographics[0]->Gender eq 'M'}Male{else}Female{/if} {$data_week.ActiveDemographics[0]->Age}
                </span>
            and
                <span class="highlite">
                    {if $data_week.ActiveDemographics[1]->Gender eq 'M'}Male{else}Female{/if} {$data_week.ActiveDemographics[1]->Age}
                </span>.
            This engagement with your content served to extend the reach of your brand message by an average of approximately
                <span class="highlite">
                    {($data_week.AvgImpressionsUnique - $data_week.AvgImpressionsFanUnique)|round:0} non-fans per post
                </span>.
        </div>
    </div>

</div>

<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">Recent Community Growth</div>
        <div class="text-center">{$Charts.rcg}</div>
    </div>
</div>

<div class="col-md-6">

    <div class="panel panel-default key">

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
            <img src="http://webanalysis.co/resources/img/pdf_pwered_by_bionic.jpg" height="25px">
        </td>
    </tr>
</table>

<br>

<table class="pdfheader">
    <tr>
        <td>
            <img src="http://webanalysis.co/resources/img/pdf_facebook.jpg" height="25px" width="26px" />
            CrayInc
        </td>
        <td align="right" style="font-size:16px">
            {$report_date_from} - {$report_date_to}
        </td>
    </tr>
</table>

<div class="page">

<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">Organic vs. Paid Likes</div>
        <div class="text-center">{$Charts.ovp}</div>
    </div>
</div>

<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">Top Fan Locations</div>
        <div class="panel-body">
            <table class="table table-hover table-condensed">
                <thead>
                <tr>
                    <th>#</th>
                    <th>City</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                {foreach from=$TopCities item=row name=city}
                    <tr>
                        <td>{$smarty.foreach.city.iteration}</td>
                        <td>{$row->City}</td>
                        <td class="right">{$row->val}</td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Top External Traffic Sources</div>
        <div class="panel-body">
            <table class="table table-hover table-condensed">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Source</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                {foreach from=$TopExTrafficSources item=row name=referral}
                    <tr>
                        <td>{$smarty.foreach.referral.iteration}</td>
                        <td>{$row->Referral}</td>
                        <td class="right">{$row->val}</td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        </div>
    </div>
</div>

<br>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">Content Breakdown</div>
        <div class="panel-body">
            <table class="table table-hover table-condensed">
                <thead>
                <tr>
                    <td colspan="8"><b>Top 10 Post for the Period</b></td>
                </tr>
                <tr>
                    <th>Date</th>
                    <th>Post</th>
                    <th>Engagements</th>
                    <th>Clicks</th>
                    <th>Engaged</th>
                    <th>Reach</th>
                    <th>Impressions</th>
                    <th>Viral reach</th>
                </tr>
                </thead>
                <tbody>
                {foreach $ContentBreakdown as $row}
                    <tr>
                        <td>{$row->day}</td>
                        <td><a href="{$row->Post_link}" target="_blank">{$row->Post_message}...</a></td>
                        <td>{$row->Post_story_adds}</td>
                        <td>{$row->Post_consumptions}</td>
                        <td>{math equation="round( ((( x + y ) / z) * 100) ,1)" x=$row->Post_story_adds y=$row->Post_consumptions z=$row->Post_impressions_unique}%</td>
                        <td>{$row->Post_impressions_unique}</td>
                        <td>{$row->Post_impressions}</td>
                        <td>{math equation="round( (((x - y) / x) * 100) ,1)" x=$row->Post_impressions_unique y=$row->Post_impressions_fan_unique}%</td>
                    </tr>
                {/foreach}
                {if $AvgContentBreakdown->min_day}
                    <tr>
                        <td colspan="2">Average from {$AvgContentBreakdown->min_day} to {$AvgContentBreakdown->max_day}</td>
                        <td>{$AvgContentBreakdown->avg_Post_story_adds|round}</td>
                        <td>{$AvgContentBreakdown->avg_Post_consumptions|round}</td>
                        <td>{math equation="round( ((( x + y ) / z) * 100) ,1)" x=$AvgContentBreakdown->avg_Post_story_adds y=$AvgContentBreakdown->avg_Post_consumptions z=$AvgContentBreakdown->avg_Post_impressions_unique}%</td>
                        <td>{$AvgContentBreakdown->avg_Post_impressions_unique|round}</td>
                        <td>{$AvgContentBreakdown->avg_Post_impressions|round}</td>
                        <td>{math equation="round( (((x - y) / x) * 100) ,1)" x=$AvgContentBreakdown->avg_Post_impressions_unique y=$AvgContentBreakdown->avg_Post_impressions_fan_unique}%</td>
                    </tr>
                {/if}
                {if $AvgContentBreakdown_last->min_day}
                    <tr>
                        <td colspan="2">Average from {$AvgContentBreakdown_last->min_day} to {$AvgContentBreakdown_last->max_day}</td>
                        <td>{$AvgContentBreakdown_last->avg_Post_story_adds|round}</td>
                        <td>{$AvgContentBreakdown_last->avg_Post_consumptions|round}</td>
                        <td>{math equation="round( ((( x + y ) / z) * 100) ,1)" x=$AvgContentBreakdown_last->avg_Post_story_adds y=$AvgContentBreakdown_last->avg_Post_consumptions z=$AvgContentBreakdown_last->avg_Post_impressions_unique}%</td>
                        <td>{$AvgContentBreakdown_last->avg_Post_impressions_unique|round}</td>
                        <td>{$AvgContentBreakdown_last->avg_Post_impressions|round}</td>
                        <td>{math equation="round( (((x - y) / x) * 100) ,1)" x=$AvgContentBreakdown_last->avg_Post_impressions_unique y=$AvgContentBreakdown_last->avg_Post_impressions_fan_unique}%</td>
                    </tr>
                {/if}
                </tbody>
            </table>
        </div>
    </div>
</div>

<br>

<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">Reach Breakdown</div>
        <div class="text-center">{$Charts.rbd}</div>
    </div>
</div>

<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">Community metrics</div>
        <div class="text-center">
            <table class="table table-hover table-condensed">
                <tbody>
                <tr>
                    <td>Average Daily Reach</td>
                    <td>{$CommunityMetrics->daily_reach|round:0}</td>
                </tr>
                <tr>
                    <td>Average Daily Impressions</td>
                    <td>{$CommunityMetrics->daily_impr|round:0}</td>
                </tr>
                <tr>
                    <td>Your Community Engagement</td>
                    <td>{math equation="(( x / y ) * 100)"  format="%.2f" x=$AvgContentBreakdown->avg_Post_engaged_users y=$AvgContentBreakdown->avg_Post_impressions_unique}%</td>
                </tr>
                <tr>
                    <td>Fan Growth Ratio</td>
                    <td>{math equation="( ( 1 - ( x / y ) ) * 100 )"  format="%.2f" x=$CommunityMetrics->fan_rem y=$CommunityMetrics->fan_add}%</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">Internal Fan Sources</div>
        <div class="text-center">{$Charts.ifs}</div>
    </div>
</div>

<br>
