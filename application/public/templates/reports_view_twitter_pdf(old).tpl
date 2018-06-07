<div class="col-md-6">

    <div class="panel panel-default">
        <div class="panel-heading">Summary</div>
        <div class="panel-body" style="font-size: 14px;padding:10px;">
            During the last 7 days, {$User->Name} (@{$User->ScreenName}) gained <span class="highlite">{$NewFollowers}</span> new followers on Twitter
            (<span class="highlite">{math equation="x * 100 / y" format="%.2f" x=$NewFollowers y=$User->FollowersCount}% growth</span>) to reach a total fan base of
            <span class="highlite">{$User->FollowersCount} users</span>.

            <span style="color:red">This month, each published Tweet yielded an average of 5,014 potential impressions and, as a whole.</span>

            Your Twitter account received a total of <span class="highlite">
                {math equation="x + y + z + s" x=$favorites y=$mentions z=$retweets s=$replies}</span> engagement from both followers and non-followers.
        </div>
    </div>

</div>

<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">Recent Follower Growth</div>
        <div class="text-center">{$Charts.followers}</div>
    </div>
</div>

<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">Amplification</div>
        <div class="text-center">

            <table>
                <tr>
                    <td style="padding:10px"><b>Tweets Sent</b></td>
                    <td style="padding:10px">{$tweets}</td>
                </tr>
                <tr>
                    <td style="padding:10px"><b>Unique People Engaging</b></td>
                    <td style="padding:10px">???</td>
                </tr>
                <tr>
                    <td style="padding:10px"><b>Total Engagement</b></td>
                    <td style="padding:10px">{math equation="x + y + z + s" x=$favorites y=$mentions z=$retweets s=$replies}</td>
                </tr>
                <tr>
                    <td style="padding:10px"><b>Potential Reach</b></td>
                    <td style="padding:10px">???</td>
                </tr>
                <tr>
                    <td style="padding:10px"><b>Potential Impresssions</b></td>
                    <td style="padding:10px">???</td>
                </tr>
            </table>

        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="panel panel-default key">
        <h2>TOTAL</h2>
        <h2>ENGAGEMENTS</h2>
        <h2>{math equation="x + y + z + s" x=$favorites y=$mentions z=$retweets s=$replies}</h2>
        <table class="midtable">
            <tbody>
            <tr>
                <td>&nbsp;</td>
                <td><b>{$replies}</b></td>
                <td>Replies</td>
                <td><b>{$retweets}</b></td>
                <td>Retweets</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><b>{$mentions}</b></td>
                <td>Mentions</td>
                <td><b>{$favorites}</b></td>
                <td>Favorites</td>
                <td>&nbsp;</td>
            </tr>
            </tbody>
        </table>
        <hr>
        <table class="midtable">
            <tbody>
            <tr>
                <td>Total Followers</td>
                <td><b>{$User->FollowersCount}</b></td>
            </tr>
            </tbody>
        </table>

    </div>
</div>

<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">Recent Fan Pulse</div>
        <div class="panel-body" style="font-size: 13px;">

            {foreach $recent_tweets as $row}
                <p class="small">{$row->Tweet}</p>
            {/foreach}

        </div>
    </div>
</div>
<div class="col-md-6">

    <div class="panel panel-default">
        <div class="panel-heading">Most Active Users</div>
        <div class="panel-body" style="font-size: 13px;">

            <div class="row">
                <div class="col-md-6">
                    {foreach key=key item=item from=$most_active_fans}

                    <div class="small">{$key+1}. @{$item->ScreenName}</div>

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
        <div class="panel-body" style="font-size: 13px;">

            <div class="row">
                <div class="col-md-6">
                    {foreach key=key item=item from=$top_locations}

                    <div class="small">{$key+1}. @{$item->Location}</div>

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



