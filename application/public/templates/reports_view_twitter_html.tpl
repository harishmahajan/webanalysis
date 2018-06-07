<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">Key Performance Indicators</div>
            <div class="panel-body">

                <table style="width:100%;text-align: center;" class="kpi">
                    <tr>
                        <td rowspan="2">
                            <h1>{math equation="x + y + z + s" x=$favorites|number_format y=$mentions|number_format z=$retweets|number_format s=$replies|number_format}</h1>
                            <small>Total engagement</small>
                        </td>
                        <td>
                            <h3>{$replies|number_format}</h3>
                            <small>Replies</small>
                        </td>
                        <td>
                            <h3>{$retweets|number_format}</h3>
                            <small>Retweets</small>
                        </td>
                        <td rowspan="2">
                            <h1>{$User->FollowersCount}</h1>
                            <small>Total Followers</small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>{$mentions|number_format}</h3>
                            <small>Mentions</small>
                        </td>
                        <td>
                            <h3>{$favorites|number_format}</h3>
                            <small>Favorites</small>
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
                During the last {$dateRange} days, {$User->Name} (@{$User->ScreenName}) gained <span class="highlite">{$NewFollowers->new}</span> new followers on Twitter
                (<span class="highlite">{math equation="x * 100 / y" format="%.2f" x=$NewFollowers->new y=$User->FollowersCount}% growth</span>) to reach a total fan base of
                <span class="highlite">{$User->FollowersCount} users</span>.

                <span style="color:red">This month, each published Tweet yielded an average of {math equation="x / y " format="%.2f" x=$Potential_Impression->PotentialImpression y=$tweets  } potential impressions and, as a whole.</span>

                Your Twitter account received a total of <span class="highlite">
                    {math equation="x + y + z + s" x=$favorites y=$mentions z=$retweets s=$replies}</span> engagement from both followers and non-followers.
            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Recent Follower Growth</div>
            <div class="text-center">{$Charts.followers}</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">@{$User->ScreenName} Mentions</div>
            <div class="text-center">{$Charts.mentions}</div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-6">

        <div class="panel panel-default">
            <div class="panel-heading">Amplification</div>
            <div>
                <div class="row" style="padding:10px;">
                    <div class="col-xs-8">
                        <b>Tweets Sent</b>
                    </div>
                    <div class="col-md-2">
                        {$tweets}
                    </div>
                </div>
                <div class="row" style="padding:10px;">
                    <div class="col-xs-8">
                        <b>Unique People Engaging</b>
                    </div>
                    <div class="col-md-2">
                        {$Unique_People->UniquePeople}
                    </div>
                </div>
                <div class="row" style="padding:10px;">
                    <div class="col-xs-8">
                        <b>Total Engagement</b>
                    </div>
                    <div class="col-md-2">
                        {math equation="x + y + z + s" x=$favorites y=$mentions z=$retweets s=$replies}
                    </div>
                </div>
                <div class="row" style="padding:10px"''>
                    <div class="col-xs-8">
                        <b>Potential Reach</b>
                    </div>
                    <div class="col-md-2">
                        {$Potential_Reach->PotentialReach|number_format}
                    </div>
                </div>
                <div class="row" style="padding:10px">
                    <div class="col-xs-8">
                        <b>Potential Impresssions</b>
                    </div>
                    <div class="col-md-2">
                        {$Potential_Impression->PotentialImpression|number_format}
                    </div>
                </div>
            </div>              
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Recent Fan Pulse</div>
            <div class="panel-body">

                {foreach $recent_tweets as $row}
                    <p class="small">{$row->Tweet}</p>
                {/foreach}

            </div>
        </div>
    </div>
    <div class="col-md-6">

        <div class="panel panel-default">
            <div class="panel-heading">Most Active Users</div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-6">
                        {foreach key=key item=item from=$most_active_fans}

                        <p class="small">{$key+1}. @{$item->ScreenName}</p>

                        {if $key eq 4}
                    </div>
                    <div class="col-md-6">
                        {/if}

                        {/foreach}
                    </div>
                </div>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Top Locations</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                      
                        {foreach key=key item=item from=$top_locations}

                        <p class="small">{$key+1}. {$item->Location}</p>

                        {if $key eq 4}
                    </div>
                    <div class="col-md-6">
                        {/if}

                        {/foreach}
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>



