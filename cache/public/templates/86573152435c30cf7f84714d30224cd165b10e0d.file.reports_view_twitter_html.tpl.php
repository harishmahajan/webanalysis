<?php /* Smarty version Smarty-3.1.17, created on 2015-01-20 00:37:45
         compiled from "/var/www/application/public/templates/reports_view_twitter_html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:175984375254197772128d35-11114775%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '86573152435c30cf7f84714d30224cd165b10e0d' => 
    array (
      0 => '/var/www/application/public/templates/reports_view_twitter_html.tpl',
      1 => 1421743058,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '175984375254197772128d35-11114775',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_541977722e5857_89597664',
  'variables' => 
  array (
    'favorites' => 0,
    'mentions' => 0,
    'retweets' => 0,
    'replies' => 0,
    'User' => 0,
    'dateRange' => 0,
    'NewFollowers' => 0,
    'Potential_Impression' => 0,
    'tweets' => 0,
    'Charts' => 0,
    'Unique_People' => 0,
    'Potential_Reach' => 0,
    'recent_tweets' => 0,
    'row' => 0,
    'most_active_fans' => 0,
    'key' => 0,
    'item' => 0,
    'top_locations' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_541977722e5857_89597664')) {function content_541977722e5857_89597664($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include 'library/smarty/plugins/function.math.php';
?><div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">Key Performance Indicators</div>
            <div class="panel-body">

                <table style="width:100%;text-align: center;" class="kpi">
                    <tr>
                        <td rowspan="2">
                            <h1><?php echo smarty_function_math(array('equation'=>"x + y + z + s",'x'=>number_format($_smarty_tpl->tpl_vars['favorites']->value),'y'=>number_format($_smarty_tpl->tpl_vars['mentions']->value),'z'=>number_format($_smarty_tpl->tpl_vars['retweets']->value),'s'=>number_format($_smarty_tpl->tpl_vars['replies']->value)),$_smarty_tpl);?>
</h1>
                            <small>Total engagement</small>
                        </td>
                        <td>
                            <h3><?php echo number_format($_smarty_tpl->tpl_vars['replies']->value);?>
</h3>
                            <small>Replies</small>
                        </td>
                        <td>
                            <h3><?php echo number_format($_smarty_tpl->tpl_vars['retweets']->value);?>
</h3>
                            <small>Retweets</small>
                        </td>
                        <td rowspan="2">
                            <h1><?php echo $_smarty_tpl->tpl_vars['User']->value->FollowersCount;?>
</h1>
                            <small>Total Followers</small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3><?php echo number_format($_smarty_tpl->tpl_vars['mentions']->value);?>
</h3>
                            <small>Mentions</small>
                        </td>
                        <td>
                            <h3><?php echo number_format($_smarty_tpl->tpl_vars['favorites']->value);?>
</h3>
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
                During the last <?php echo $_smarty_tpl->tpl_vars['dateRange']->value;?>
 days, <?php echo $_smarty_tpl->tpl_vars['User']->value->Name;?>
 (@<?php echo $_smarty_tpl->tpl_vars['User']->value->ScreenName;?>
) gained <span class="highlite"><?php echo $_smarty_tpl->tpl_vars['NewFollowers']->value->new;?>
</span> new followers on Twitter
                (<span class="highlite"><?php echo smarty_function_math(array('equation'=>"x * 100 / y",'format'=>"%.2f",'x'=>$_smarty_tpl->tpl_vars['NewFollowers']->value->new,'y'=>$_smarty_tpl->tpl_vars['User']->value->FollowersCount),$_smarty_tpl);?>
% growth</span>) to reach a total fan base of
                <span class="highlite"><?php echo $_smarty_tpl->tpl_vars['User']->value->FollowersCount;?>
 users</span>.

                <span style="color:red">This month, each published Tweet yielded an average of <?php echo smarty_function_math(array('equation'=>"x / y ",'format'=>"%.2f",'x'=>$_smarty_tpl->tpl_vars['Potential_Impression']->value->PotentialImpression,'y'=>$_smarty_tpl->tpl_vars['tweets']->value),$_smarty_tpl);?>
 potential impressions and, as a whole.</span>

                Your Twitter account received a total of <span class="highlite">
                    <?php echo smarty_function_math(array('equation'=>"x + y + z + s",'x'=>$_smarty_tpl->tpl_vars['favorites']->value,'y'=>$_smarty_tpl->tpl_vars['mentions']->value,'z'=>$_smarty_tpl->tpl_vars['retweets']->value,'s'=>$_smarty_tpl->tpl_vars['replies']->value),$_smarty_tpl);?>
</span> engagement from both followers and non-followers.
            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Recent Follower Growth</div>
            <div class="text-center"><?php echo $_smarty_tpl->tpl_vars['Charts']->value['followers'];?>
</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">@<?php echo $_smarty_tpl->tpl_vars['User']->value->ScreenName;?>
 Mentions</div>
            <div class="text-center"><?php echo $_smarty_tpl->tpl_vars['Charts']->value['mentions'];?>
</div>
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
                        <?php echo $_smarty_tpl->tpl_vars['tweets']->value;?>

                    </div>
                </div>
                <div class="row" style="padding:10px;">
                    <div class="col-xs-8">
                        <b>Unique People Engaging</b>
                    </div>
                    <div class="col-md-2">
                        <?php echo $_smarty_tpl->tpl_vars['Unique_People']->value->UniquePeople;?>

                    </div>
                </div>
                <div class="row" style="padding:10px;">
                    <div class="col-xs-8">
                        <b>Total Engagement</b>
                    </div>
                    <div class="col-md-2">
                        <?php echo smarty_function_math(array('equation'=>"x + y + z + s",'x'=>$_smarty_tpl->tpl_vars['favorites']->value,'y'=>$_smarty_tpl->tpl_vars['mentions']->value,'z'=>$_smarty_tpl->tpl_vars['retweets']->value,'s'=>$_smarty_tpl->tpl_vars['replies']->value),$_smarty_tpl);?>

                    </div>
                </div>
                <div class="row" style="padding:10px"''>
                    <div class="col-xs-8">
                        <b>Potential Reach</b>
                    </div>
                    <div class="col-md-2">
                        <?php echo number_format($_smarty_tpl->tpl_vars['Potential_Reach']->value->PotentialReach);?>

                    </div>
                </div>
                <div class="row" style="padding:10px">
                    <div class="col-xs-8">
                        <b>Potential Impresssions</b>
                    </div>
                    <div class="col-md-2">
                        <?php echo number_format($_smarty_tpl->tpl_vars['Potential_Impression']->value->PotentialImpression);?>

                    </div>
                </div>
            </div>              
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Recent Fan Pulse</div>
            <div class="panel-body">

                <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['recent_tweets']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                    <p class="small"><?php echo $_smarty_tpl->tpl_vars['row']->value->Tweet;?>
</p>
                <?php } ?>

            </div>
        </div>
    </div>
    <div class="col-md-6">

        <div class="panel panel-default">
            <div class="panel-heading">Most Active Users</div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-6">
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['most_active_fans']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>

                        <p class="small"><?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
. @<?php echo $_smarty_tpl->tpl_vars['item']->value->ScreenName;?>
</p>

                        <?php if ($_smarty_tpl->tpl_vars['key']->value==4) {?>
                    </div>
                    <div class="col-md-6">
                        <?php }?>

                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Top Locations</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                      
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['top_locations']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>

                        <p class="small"><?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
. <?php echo $_smarty_tpl->tpl_vars['item']->value->Location;?>
</p>

                        <?php if ($_smarty_tpl->tpl_vars['key']->value==4) {?>
                    </div>
                    <div class="col-md-6">
                        <?php }?>

                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>



<?php }} ?>
