{foreach $connection as $conn}

{if $conn.Type eq 'facebook'}

<nav class="navbar navbar-default" role="navigation" style="margin-top:15px; margin-bottom: 15px;">
    <div class="container-fluid">
        <div class="navbar-header">
            <div class="navbar-brand">Facebook</div>
        </div>
        <p class="navbar-text">Data during the past 7 days</p>
        <a class="btn btn-default navbar-btn navbar-right" href="/reports/view/{$conn.AccountID}/{$conn.ConnectionID}">View Full Report</a>
    </div>
</nav>

<div class="row">
    <div class="col-md-6">

        <div class="panel panel-default">
            <div class="panel-heading">Key performance indicators</div>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td class="text-center">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2>{$conn.data_week.SumPageEngagedUsers}</h2>
                            </div>
                            <div class="col-sm-6">
                                <h2>{$conn.data_week.SumPageEngagedUsers_parentage}
                                    {if $conn.data_week.SumPageEngagedUsers_parentage gt 99}
                                        <span class="glyphicon glyphicon-upload" style="font-size:25px;color:#96cb76;"></span>
                                    {else}
                                        <span class="glyphicon glyphicon-download" style="font-size:25px;color:#ec7466;"></span>
                                    {/if}
                                </h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <small>Total engagement</small>
                            </div>
                            <div class="col-sm-6">
                                <small>Engaged%</small>
                            </div>
                        </div>
                    </td>
                    <td rowspan="2" class="text-center">
                        <h2>{$conn.data_week.SumPageImpressionsUnique}</h2>
                        <small>Total reached</small>
                        <h2>{$conn.data_week.SumPageImpressions}</h2>
                        <small>Total impressions</small>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">
                        <div class="row">
                            <div class="col-sm-3">
                                <h4>{$conn.data_week.SumPageLink}</h4>
                            </div>
                            <div class="col-sm-3">
                                <h4>{$conn.data_week.SumPageStorytellers}</h4>
                            </div>
                            <div class="col-sm-3">
                                <h4>{$conn.data_week.SumPageComment}</h4>
                            </div>
                            <div class="col-sm-3">
                                <h4>{$conn.data_week.SumPageLike}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <small>Clicks</small>
                            </div>
                            <div class="col-sm-3">
                                <small>Shares</small>
                            </div>
                            <div class="col-sm-3">
                                <small>Comments</small>
                            </div>
                            <div class="col-sm-3">
                                <small>Likes</small>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Summary</div>
            <div class="panel-body">
                During the last 7 days, {$accountName} gained <span class="highlite">{$conn.data_week.SumPageFanAddsUnique}</span> new fans
                (<span class="highlite">a change of {math equation="(((x - y)/y)*100)" format="%.2f" x=$conn.data_day.SumPageFans y=$conn.data_day.SumPageFansFrom}%</span>) for a total community size of <span class="highlite">{$conn.data_day.SumPageFans} people</span>.
                Over the course of the week, an average of <span class="highlite">{$conn.data_week.SumPageEngagementsUniqueAvg|round:0} unique fans</span> engaged with your content daily.
                Of these fans, the most active demographic groups where
                <span class="highlite">
                    {if $conn.data_week.ActiveDemographics[0]->Gender eq 'M'}Male{else}Female{/if} {$conn.data_week.ActiveDemographics[0]->Age}
                </span>
                    and
                <span class="highlite">
                    {if $conn.data_week.ActiveDemographics[1]->Gender eq 'M'}Male{else}Female{/if} {$conn.data_week.ActiveDemographics[1]->Age}
                </span>.
                This engagement withs your content served to extend the reach of your brand message by an average of approximately
                <span class="highlite">
                    {($conn.data_week.AvgImpressionsUnique - $conn.data_week.AvgImpressionsFanUnique)|round:0} non-fans per post
                </span>.
            </div>
        </div>

    </div>
    <div class="col-md-6">

        <div class="panel panel-default">
            <div class="panel-heading">Recent Community Growth</div>
            <div class="text-center">{$conn.chart}</div>
        </div>

    </div>
</div>

{elseif $conn.Type eq 'twitter'}


<nav class="navbar navbar-default" role="navigation" style="margin-top:15px; margin-bottom: 15px;">
    <div class="container-fluid">
        <div class="navbar-header">
            <div class="navbar-brand">Twitter</div>
        </div>
        <p class="navbar-text">Data during the past 7 days</p>
        <a class="btn btn-default navbar-btn navbar-right" href="/reports/view/{$conn.AccountID}/{$conn.ConnectionID}">View Full Report</a>
    </div>
</nav>

<div class="row">
    <div class="col-md-6">

        <div class="panel panel-default">
            <div class="panel-heading">Key performance indicators</div>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td class="text-center">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2>{math equation="x + y + z + s" x=$conn.favorites y=$conn.mentions z=$conn.retweets s=$conn.replies}</h2>
                            </div>
                            <div class="col-sm-6">
                                <h2>{$conn.User->FollowersCount}</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <small>Total engagement</small>
                            </div>
                            <div class="col-sm-6">
                                <small>Total Followers</small>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">
                        <div class="row">
                            <div class="col-sm-3">
                                <h4>{$conn.replies}</h4>
                            </div>
                            <div class="col-sm-3">
                                <h4>{$conn.retweets}</h4>
                            </div>
                            <div class="col-sm-3">
                                <h4>{$conn.mentions}</h4>
                            </div>
                            <div class="col-sm-3">
                                <h4>{$conn.favorites}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <small>Replies</small>
                            </div>
                            <div class="col-sm-3">
                                <small>Retweets</small>
                            </div>
                            <div class="col-sm-3">
                                <small>Mentions</small>
                            </div>
                            <div class="col-sm-3">
                                <small>Favorites</small>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Summary</div>
            <div class="panel-body">
                During the last 7 days, {$conn.User->Name} (@{$conn.User->ScreenName}) gained <span class="highlite"></span> new followers on Twitter
                    (<span class="highlite">% growth</span>) to reach a total fan base of
                    <span class="highlite">{$conn.User->FollowersCount} users</span>.

                <span style="color:red">This month, each published Tweet yielded an average of 5,014 potential impressions and, as a whole.</span>

                Your Twitter account received a total of <span class="highlite">
                    {math equation="x + y + z + s" x=$conn.favorites y=$conn.mentions z=$conn.retweets s=$conn.replies}</span> engagement from both followers and non-followers.
            </div>
        </div>

    </div>
    <div class="col-md-6">

        <div class="panel panel-default">
            <div class="panel-heading">Recent Follower Growth</div>
            <div class="text-center">{$conn.chart}</div>
        </div>


    </div>
</div>

{/if}


{/foreach}
