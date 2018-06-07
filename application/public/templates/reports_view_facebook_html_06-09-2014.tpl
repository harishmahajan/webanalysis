<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">Key Performance Indicators</div>
            <div class="panel-body">

                <table style="width:100%;text-align: center;" class="kpi">
                    <tr>
                        <td rowspan="2">
                            <h1>{$data_week.SumPageEngagedUsers}</h1>
                            <small>Total engagement</small>
                        </td>
                        <td>
                            <h3>{$data_week.SumPageLike}</h3>
                            <small>Likes</small>
                        </td>
                        <td>
                            <h3>{$data_week.SumPageComment}</h3>
                            <small>Comments</small>
                        </td>
                        <td rowspan="2">
                            <h1>{$data_week.SumPageImpressionsUnique}</h1>
                            <small>Reach</small>
                        </td>
                        <td rowspan="2">
                            <h1>{$data_week.SumPageImpressions}</h1>
                            <small>Total impressions</small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>{$data_week.SumPageStorytellers}</h3>
                            <small>Shares</small>
                        </td>
                        <td>
                            <h3>{$data_week.SumPageLink}</h3>
                            <small>Clicks</small>
                        </td>
                    </tr>
                </table>

            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">Summary</div>
            <div class="panel-body">
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
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Recent Community Growth</div>
            <div class="text-center">{$Charts.rcg}</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Community Activity</div>
            <div class="text-center">{$Charts.ca}</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Demographics</div>
            <div class="text-center">{$Charts.dem}</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Active Demographics</div>
            <div class="text-center">{$Charts.demographics}</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Community Engagement</div>
            <div class="text-center">{$Charts.communitygrowth}</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Organic vs. Paid Likes</div>
            <div class="text-center">{$Charts.ovp}</div>
        </div>
    </div>
</div>

<div class="row">
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
                            <td>{$row->val|round}</td>
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
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
                            <td>{$row->val}</td>
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="row">

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Top 10 Post for the period</div>
            <div class="panel-body">
                <table class="table table-hover table-condensed">
                    <thead>
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

</div>


<div class="row">

    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">Reach Breakdown</div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="text-center">{$Charts.rbd}</div>
                    </div>
                    <div class="col-md-6">

                        <ul id="reach_breakdown" class="nav nav-tabs">
                            <li class="active"><a href="#community_metrics" data-toggle="tab">Community Metrics</a></li>
                            <li><a href="#internal_fan_sources" data-toggle="tab">Internal Fan Sources</a></li>
                        </ul>

                        <br>

                        <div class="tab-content">
                            <div class="tab-pane active" id="community_metrics">

                                <table class="table commetrics">
                                    <tbody>
                                        <tr>
                                            <td style="border-top: none;">
                                                <div>Average Daily Reach</div>
                                                <small>(unique users access on facebook)</small>
                                            </td>
                                            <td style="border-top: none;">{$CommunityMetrics->daily_reach|round:2}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>Average Daily Impressions</div>
                                                <small>(unique user access on facebook)</small>
                                            </td>
                                            <td>{$CommunityMetrics->daily_impr|round:2}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>Your Community Engagement</div>
                                                <small>(of the fans that saw your post)</small>
                                            </td>
                                            <td>{math equation="(( x / y ) * 100)"  format="%.2f" x=$AvgContentBreakdown_last->avg_Post_engaged_users y=$AvgContentBreakdown->avg_Post_impressions_unique}%</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>Fan Growth Ratio</div>
                                                <small>(measures stickiness of new fans vs lost fans)</small>
                                            </td>
                                            <td>{math equation="( ( 1 - ( x / y ) ) * 100 )"  format="%.2f" x=$CommunityMetrics->fan_rem y=$CommunityMetrics->fan_add}%</td>
                                        </tr>
                                    </tbody>
                                </table>

                                {$CommunityMetrics->fan_rem}/{$CommunityMetrics->fan_add}

                            </div>
                            <div class="tab-pane" id="internal_fan_sources">

                                <br>

                                {$Charts.ifs}

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

<script>
{literal}
$('#reach_breakdown a').click(function (e) {
    e.preventDefault()
    $(this).tab('show')
});
{/literal}
</script>
