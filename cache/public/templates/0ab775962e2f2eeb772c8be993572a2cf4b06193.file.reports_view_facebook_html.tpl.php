<?php /* Smarty version Smarty-3.1.17, created on 2014-12-05 04:38:53
         compiled from "/var/www/application/public/templates/reports_view_facebook_html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2122131984541920eac35f40-89309706%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0ab775962e2f2eeb772c8be993572a2cf4b06193' => 
    array (
      0 => '/var/www/application/public/templates/reports_view_facebook_html.tpl',
      1 => 1417783118,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2122131984541920eac35f40-89309706',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_541920eb011434_80877730',
  'variables' => 
  array (
    'data_week' => 0,
    'accountName' => 0,
    'data_day' => 0,
    'Charts' => 0,
    'TopCities' => 0,
    'row' => 0,
    'TopExTrafficSources' => 0,
    'ContentBreakdown' => 0,
    'AvgContentBreakdown' => 0,
    'AvgContentBreakdown_last' => 0,
    'CommunityMetrics' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_541920eb011434_80877730')) {function content_541920eb011434_80877730($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include 'library/smarty/plugins/function.math.php';
?><div class="row">
<div class="col-md-12">

  <div class="panel panel-default">
            <div class="panel-heading">Key Performance Indicators</div>
            <div class="panel-body">

                <table style="width:100%;text-align: center;" class="kpi">
                    <tr>
                        <td rowspan="2">
                            <h1><?php echo $_smarty_tpl->tpl_vars['data_week']->value['SumPageEngagedUsers'];?>
</h1>
                            <small>Total engagement</small>
                        </td>
                        <td>
                            <h3><?php echo $_smarty_tpl->tpl_vars['data_week']->value['SumPageLike'];?>
</h3>
                            <small>Likes</small>
                        </td>
                        <td>
                            <h3><?php echo $_smarty_tpl->tpl_vars['data_week']->value['SumPageComment'];?>
</h3>
                            <small>Comments</small>
                        </td>
                        <td rowspan="2">
                            <h1><?php echo $_smarty_tpl->tpl_vars['data_week']->value['SumPageImpressionsUnique'];?>
</h1>
                            <small>Reach</small>
                        </td>
                        <td rowspan="2">
                            <h1><?php echo $_smarty_tpl->tpl_vars['data_week']->value['SumPageImpressions'];?>
</h1>
                            <small>Total impressions</small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3><?php echo $_smarty_tpl->tpl_vars['data_week']->value['SumPageStorytellers'];?>
</h3>
                            <small>Shares</small>
                        </td>
                        <td>
                            <h3><?php echo $_smarty_tpl->tpl_vars['data_week']->value['SumPageLink'];?>
</h3>
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
                During the period, <?php echo $_smarty_tpl->tpl_vars['accountName']->value;?>
 gained <span class="highlite"><?php echo $_smarty_tpl->tpl_vars['data_week']->value['SumPageFanAddsUnique'];?>
</span> new fans
                    (<span class="highlite">a change of <?php echo smarty_function_math(array('equation'=>"(((x - y)/y)*100)",'format'=>"%.2f",'x'=>$_smarty_tpl->tpl_vars['data_day']->value['SumPageFans'],'y'=>$_smarty_tpl->tpl_vars['data_day']->value['SumPageFansFrom']),$_smarty_tpl);?>
%</span>) for a total community size of <span class="highlite"><?php echo $_smarty_tpl->tpl_vars['data_day']->value['SumPageFans'];?>
 people</span>.
                Over the course of the period, an average of <span class="highlite"><?php echo round($_smarty_tpl->tpl_vars['data_week']->value['SumPageEngagementsUniqueAvg'],0);?>
 unique fans</span> engaged with your content daily.
                Of these fans, the most active demographic groups where
                    <span class="highlite">
                        <?php if ($_smarty_tpl->tpl_vars['data_week']->value['ActiveDemographics'][0]->Gender=='M') {?>Male<?php } else { ?>Female<?php }?> <?php echo $_smarty_tpl->tpl_vars['data_week']->value['ActiveDemographics'][0]->Age;?>

                    </span>
                        and
                    <span class="highlite">
                        <?php if ($_smarty_tpl->tpl_vars['data_week']->value['ActiveDemographics'][1]->Gender=='M') {?>Male<?php } else { ?>Female<?php }?> <?php echo $_smarty_tpl->tpl_vars['data_week']->value['ActiveDemographics'][1]->Age;?>

                    </span>.
                This engagement with your content served to extend the reach of your brand message by an average of approximately
                    <span class="highlite">
                        <?php echo round(($_smarty_tpl->tpl_vars['data_week']->value['AvgImpressionsUnique']-$_smarty_tpl->tpl_vars['data_week']->value['AvgImpressionsFanUnique']),0);?>
 non-fans per post
                    </span>.
            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Recent Community Growth</div>
            <div class="text-center"><?php echo $_smarty_tpl->tpl_vars['Charts']->value['rcg'];?>
</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Community Activity</div>
            <div class="text-center"><?php echo $_smarty_tpl->tpl_vars['Charts']->value['ca'];?>
</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Demographics</div>
            <div class="text-center"><?php echo $_smarty_tpl->tpl_vars['Charts']->value['dem'];?>
</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Active Demographics</div>
            <div class="text-center"><?php echo $_smarty_tpl->tpl_vars['Charts']->value['demographics'];?>
</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Community Engagement</div>
            <div class="text-center"><?php echo $_smarty_tpl->tpl_vars['Charts']->value['communitygrowth'];?>
</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Organic vs. Paid Likes</div>
            <div class="text-center"><?php echo $_smarty_tpl->tpl_vars['Charts']->value['ovp'];?>
</div>
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
                    <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['TopCities']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['city']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['city']['iteration']++;
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['city']['iteration'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['row']->value->City;?>
</td>
                            <td><?php echo round($_smarty_tpl->tpl_vars['row']->value->val);?>
</td>
                        </tr>
                    <?php } ?>
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
                    <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['TopExTrafficSources']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['referral']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['referral']['iteration']++;
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['referral']['iteration'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['row']->value->Referral;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['row']->value->val;?>
</td>
                        </tr>
                    <?php } ?>
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
                    <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ContentBreakdown']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->tpl_vars['row']->value->day;?>
</td>
                            <td><a href="<?php echo $_smarty_tpl->tpl_vars['row']->value->Post_link;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['row']->value->Post_message;?>
...</a></td>
                            <td><?php echo $_smarty_tpl->tpl_vars['row']->value->Post_story_adds;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['row']->value->Post_consumptions;?>
</td>
                            <td><?php echo smarty_function_math(array('equation'=>"round( ((( x + y ) / z) * 100) ,1)",'x'=>$_smarty_tpl->tpl_vars['row']->value->Post_story_adds,'y'=>$_smarty_tpl->tpl_vars['row']->value->Post_consumptions,'z'=>$_smarty_tpl->tpl_vars['row']->value->Post_impressions_unique),$_smarty_tpl);?>
%</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['row']->value->Post_impressions_unique;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['row']->value->Post_impressions;?>
</td>
                            <td><?php echo smarty_function_math(array('equation'=>"round( (((x - y) / x) * 100) ,1)",'x'=>$_smarty_tpl->tpl_vars['row']->value->Post_impressions_unique,'y'=>$_smarty_tpl->tpl_vars['row']->value->Post_impressions_fan_unique),$_smarty_tpl);?>
%</td>
                        </tr>
                    <?php } ?>
                    <?php if ($_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->min_day) {?>
                    <tr>
                        <td colspan="2">Average from <?php echo $_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->min_day;?>
 to <?php echo $_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->max_day;?>
</td>
                        <td><?php echo round($_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->avg_Post_story_adds);?>
</td>
                        <td><?php echo round($_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->avg_Post_consumptions);?>
</td>
                        <td><?php echo smarty_function_math(array('equation'=>"round( ((( x + y ) / z) * 100) ,1)",'x'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->avg_Post_story_adds,'y'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->avg_Post_consumptions,'z'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->avg_Post_impressions_unique),$_smarty_tpl);?>
%</td>
                        <td><?php echo round($_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->avg_Post_impressions_unique);?>
</td>
                        <td><?php echo round($_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->avg_Post_impressions);?>
</td>
                        <td><?php echo smarty_function_math(array('equation'=>"round( (((x - y) / x) * 100) ,1)",'x'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->avg_Post_impressions_unique,'y'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->avg_Post_impressions_fan_unique),$_smarty_tpl);?>
%</td>
                    </tr>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->min_day) {?>
                    <tr>
                        <td colspan="2">Average from <?php echo $_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->min_day;?>
 to <?php echo $_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->max_day;?>
</td>
                        <td><?php echo round($_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->avg_Post_story_adds);?>
</td>
                        <td><?php echo round($_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->avg_Post_consumptions);?>
</td>
                        <td><?php echo smarty_function_math(array('equation'=>"round( ((( x + y ) / z) * 100) ,1)",'x'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->avg_Post_story_adds,'y'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->avg_Post_consumptions,'z'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->avg_Post_impressions_unique),$_smarty_tpl);?>
%</td>
                        <td><?php echo round($_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->avg_Post_impressions_unique);?>
</td>
                        <td><?php echo round($_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->avg_Post_impressions);?>
</td>
                        <td><?php echo smarty_function_math(array('equation'=>"round( (((x - y) / x) * 100) ,1)",'x'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->avg_Post_impressions_unique,'y'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->avg_Post_impressions_fan_unique),$_smarty_tpl);?>
%</td>
                    </tr>
                    <?php }?>
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
                        <div class="text-center"><?php echo $_smarty_tpl->tpl_vars['Charts']->value['rbd'];?>
</div>
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
                                            <td style="border-top: none;"><?php echo round($_smarty_tpl->tpl_vars['CommunityMetrics']->value->daily_reach,0);?>
</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>Average Daily Impressions</div>
                                                <small>(unique user access on facebook)</small>
                                            </td>
                                            <td><?php echo round($_smarty_tpl->tpl_vars['CommunityMetrics']->value->daily_impr,0);?>
</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>Your Community Engagement</div>
                                                <small>(of the fans that saw your post)</small>
                                            </td>
                                            <td><?php echo smarty_function_math(array('equation'=>"(( x / y ) * 100)",'format'=>"%.2f",'x'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->avg_Post_engaged_users,'y'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->avg_Post_impressions_unique),$_smarty_tpl);?>
%</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>Fan Growth Ratio</div>
                                                <small>(measures stickiness of new fans vs lost fans)</small>
                                            </td>
                                            <td><?php echo smarty_function_math(array('equation'=>"( ( 1 - ( x / y ) ) * 100 )",'format'=>"%.2f",'x'=>$_smarty_tpl->tpl_vars['CommunityMetrics']->value->fan_rem,'y'=>$_smarty_tpl->tpl_vars['CommunityMetrics']->value->fan_add),$_smarty_tpl);?>
%</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <?php echo $_smarty_tpl->tpl_vars['CommunityMetrics']->value->fan_rem;?>
/<?php echo $_smarty_tpl->tpl_vars['CommunityMetrics']->value->fan_add;?>


                            </div>
                            <div class="tab-pane" id="internal_fan_sources">

                                <br>

                                <?php echo $_smarty_tpl->tpl_vars['Charts']->value['ifs'];?>


                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

<script>

$('#reach_breakdown a').click(function (e) {
    e.preventDefault()
    $(this).tab('show')
});

</script>
<?php }} ?>
