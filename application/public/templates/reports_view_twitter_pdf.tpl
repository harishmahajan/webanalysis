<style>
div.my2
{
    font-family: avantgarde-book !important;
}
.Tfont
{
    font-family: arista !important;
}
.Dleft {
  float: left;
  width: 125px;
  text-align: right;
  margin: 2px 10px;
  display: inline;

}
.C
{
vertical-align: middle;
line-height: 70px; 
}
.Dright {
  float: left;
  text-align: left;
  margin: 2px 10px;
  display: inline
}
</style>
<div class="col-md-12" style="margin-top: 40px !important;">
    <div align="right" class="Tfont"  style="font-size:38px;margin-right: 70px ">
    twitter</div>
</div>
<div class="row">
        <div class="col-md-4" style="padding: 5px 30px 10px 5px;width:250px;margin-right: 30px;">
            <div class="panel panel-default">
                <div class="panel-heading">Summary</div>
                <div class="panel-body" style="font-size: 14px; text-align: justify;">
                    During the last {$dateRange+1} days, {$User->Name} (@{$User->ScreenName}) gained {$NewFollowers->new} new followers on Twitter
                    ({math equation="x * 100 / y" format="%.2f" x=$NewFollowers->new y=$User->FollowersCount}% growth) to reach a total fan base of
                    {$User->FollowersCount} users.
                    This month, each published Tweet yielded an average of {math equation="x / y " format="%.2f" x=$Potential_Impression->PotentialImpression y=$tweets  } potential impressions and, as a whole.
                    Your Twitter account received a total of 
                        {math equation="x + y + z + s" x=$favorites y=$mentions z=$retweets s=$replies} engagement from both followers and non-followers.
                </div>
            </div>

        </div>

        <div class="" style="padding: 5px 5px 10px 5px;margin-left: 30px;">
            <div class="panel panel-default">
                <div class="panel-heading">Recent Follower Growth</div>
                <div class="text-center">{$Charts.followers}</div>
            </div>
        </div>

</div>
    <div class="col-md-4" style="padding: 5px 30px 10px 5px;width:250px;">
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
                        <td style="padding:10px">{$Unique_People->UniquePeople}</td>
                    </tr>
                    <tr>
                        <td style="padding:10px"><b>Total Engagement</b></td>
                        <td style="padding:10px">{math equation="x + y + z + s" x=$favorites y=$mentions z=$retweets s=$replies}</td>
                    </tr>
                    <tr>
                        <td style="padding:10px"><b>Potential Reach</b></td>
                        <td style="padding:10px">{$Potential_Reach->PotentialReach|number_format}</td>
                    </tr>
                    <tr>
                        <td style="padding:10px"><b>Potential Impresssions</b></td>
                        <td style="padding:10px">{$Potential_Impression->PotentialImpression|number_format}</td>
                    </tr>
                </table>

            </div>
        </div>
    </div>

    <div class="" style="padding: 10px 5px 10px 5px;height:230px">
        <div class="panel panel-default key">
             
            <!-- <table class="midtable" style="font-size: 15px !important;">
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
              <tr>
                <th rowspan="2" align="center"><h2>TOTAL<br>
                ENGAGEMENTS</h2>
                <td><b>{$replies}</b><br>&nbsp;</td>
                    <td><b>Replies</b><br>&nbsp;</td>
              </tr>
              <tr>
                <td><b>{$retweets}</b><br>&nbsp;</td>
                    <td><b>Retweets</b><br>&nbsp;</td>
              </tr>              
              <tr>
                <td rowspan="2"><h2>{math equation="x + y + z + s" x=$favorites y=$mentions z=$retweets s=$replies}</h2></td>
                 <td><b>{$mentions}</b><br>&nbsp;</td>
                    <td><b>Mentions<br>&nbsp;</td>
              </tr>
              <tr>
                <td><b>{$favorites}</b></td>
                    <td><b>Favorites</b></td>
              </tr>
              <tr><td>&nbsp;</td></tr>
              <tr><td>&nbsp;</td></tr>
            </table> -->
                <div class="Dleft midtable" style="width:200px;font-size:15px !important;">  
                <div class="C">&nbsp;</div>                  
                    <h2>TOTAL<br>
                    ENGAGEMENTS</h2>                         
                    <h2>{math equation="x + y + z + s" x=$favorites y=$mentions z=$retweets s=$replies}</h2>
                </div>
                <div class="Dright midtable" style="font-size: 15px !important;">
                    <table class="midtable" style="font-size: 15px !important;">
                        <tr><td>&nbsp;</td></tr>
                        <tr><td>&nbsp;</td></tr>
                          <tr>                
                            <td><b>{$replies}</b><br>&nbsp;</td>
                                <td><b>Replies</b><br>&nbsp;</td>
                          </tr>
                          <tr>
                            <td><b>{$retweets}</b><br>&nbsp;</td>
                                <td><b>Retweets</b><br>&nbsp;</td>
                          </tr>              
                          <tr>                
                             <td><b>{$mentions}</b><br>&nbsp;</td>
                                <td><b>Mentions<br>&nbsp;</td>
                          </tr>
                          <tr>
                            <td><b>{$favorites}</b></td>
                                <td><b>Favorites</b></td>
                          </tr>
                          <tr><td>&nbsp;</td></tr>
                          <tr><td>&nbsp;</td></tr>
                        </table>
                </div>             
        </div>
    </div>


<div  class="col-md-12" style="padding: 5px 5px 5px 5px;">    
            <div class="panel-heading">Recent Mentions</div> 
</div>

    <div class="col-md-6" style="">
        <div class="panel panel-default">
            <div class="my2" style="text-align: center;font-family: avantgarde-book !important;font-size: 12px;"><b>RECENT FAN PULSE</div>
            <div class="panel-body" style="font-size: 8px;text-align: justify;width:305px">

                {foreach $recent_tweets as $row}
                    <p class="small">{$row->Tweet}</p>
                {/foreach}

            </div>
        </div>
    </div>
    <div class="col-md-6" style="padding: 0 0 0 15px;">

    <div class="panel panel-default">
        <div class="my2" style="text-align: center;font-size: 12px;padding: 0 0 15px 0;"><b>Most Active Users</b></div>
        <div class="panel-body" style="font-size: 12px;">

            <div class="row">
                <div class="col-md-3" style="width:150px">
                    {foreach key=key item=item from=$most_active_fans}

                    <div class="small">{$key+1}. @{$item->ScreenName}</div>

                    {if $key eq 4}
                        </div>
                        <div class="col-md-3" style="width:150px" >
                    {/if}

                    {/foreach}
                </div>
            </div>

        </div>
    </div>

    <div class="panel panel-default">
        <div class="my2" style="text-align: center;font-size: 12px;padding: 30px 0 15px 0;"><b>Top Locations</b></div>
        <div class="panel-body" style="font-size: 12px;">
            <div class="row">
                <div class="col-md-3" style="width:150px">
                    {foreach key=key item=item from=$top_locations}

                    <div class="small">{$key+1}. {$item->Location}</div>

                    {if $key eq 4}
                        </div>
                        <div class="col-md-3" style="width:150px">
                    {/if}

                    {/foreach}
                </div>
            </div>
        </div>
    </div>
</div>
<br>