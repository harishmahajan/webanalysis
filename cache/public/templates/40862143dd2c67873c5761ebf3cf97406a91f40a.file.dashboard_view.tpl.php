<?php /* Smarty version Smarty-3.1.17, created on 2015-01-20 00:39:11
         compiled from "/var/www/application/public/templates/dashboard_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:455814574548d43e2638ff5-64983103%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '40862143dd2c67873c5761ebf3cf97406a91f40a' => 
    array (
      0 => '/var/www/application/public/templates/dashboard_view.tpl',
      1 => 1421743135,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '455814574548d43e2638ff5-64983103',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_548d43e28604a8_72132325',
  'variables' => 
  array (
    'connection' => 0,
    'conn' => 0,
    'accountName' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548d43e28604a8_72132325')) {function content_548d43e28604a8_72132325($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include 'library/smarty/plugins/function.math.php';
?>
<?php  $_smarty_tpl->tpl_vars['conn'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['conn']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['connection']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['conn']->key => $_smarty_tpl->tpl_vars['conn']->value) {
$_smarty_tpl->tpl_vars['conn']->_loop = true;
?>
<br>
<nav class="navbar navbar-default" role="navigation" style="margin-top:15px; margin-bottom: 15px;">
    <div class="container-fluid">
        <a class="btn btn-info navbar-btn navbar-right btnPadding" href="/account/add/<?php echo $_smarty_tpl->tpl_vars['conn']->value['AccountID'];?>
" id="btnAddAC">Create New Account</a>
    </div>
</nav>
<?php if ($_smarty_tpl->tpl_vars['conn']->value['Type']=='facebook') {?>

<nav class="navbar navbar-default" role="navigation" style="margin-top:15px; margin-bottom: 15px;">
     
    <div class="container-fluid">
        <div class="navbar-header">
            <div class="navbar-brand">Facebook</div>
        </div>
        <p class="navbar-text">Data during the past 7 days</p>
        <a class="btn btn-default navbar-btn navbar-right btnPadding" href="/reports/view/<?php echo $_smarty_tpl->tpl_vars['conn']->value['AccountID'];?>
/<?php echo $_smarty_tpl->tpl_vars['conn']->value['ConnectionID'];?>
">View Full Report</a>
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
                                <h2><?php echo $_smarty_tpl->tpl_vars['conn']->value['data_week']['SumPageEngagedUsers'];?>
</h2>
                            </div>
                            <div class="col-sm-6">
                                <h2><?php echo $_smarty_tpl->tpl_vars['conn']->value['data_week']['SumPageEngagedUsers_parentage'];?>

                                    <?php if ($_smarty_tpl->tpl_vars['conn']->value['data_week']['SumPageEngagedUsers_parentage']>99) {?>
                                        <span class="glyphicon glyphicon-upload" style="font-size:25px;color:#96cb76;"></span>
                                    <?php } else { ?>
                                        <span class="glyphicon glyphicon-download" style="font-size:25px;color:#ec7466;"></span>
                                    <?php }?>
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
                        <h2><?php echo $_smarty_tpl->tpl_vars['conn']->value['data_week']['SumPageImpressionsUnique'];?>
</h2>
                        <small>Total reached</small>
                        <h2><?php echo $_smarty_tpl->tpl_vars['conn']->value['data_week']['SumPageImpressions'];?>
</h2>
                        <small>Total impressions</small>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">
                        <div class="row">
                            <div class="col-sm-3">
                                <h4><?php echo $_smarty_tpl->tpl_vars['conn']->value['data_week']['SumPageLink'];?>
</h4>
                            </div>
                            <div class="col-sm-3">
                                <h4><?php echo $_smarty_tpl->tpl_vars['conn']->value['data_week']['SumPageStorytellers'];?>
</h4>
                            </div>
                            <div class="col-sm-3">
                                <h4><?php echo $_smarty_tpl->tpl_vars['conn']->value['data_week']['SumPageComment'];?>
</h4>
                            </div>
                            <div class="col-sm-3">
                                <h4><?php echo $_smarty_tpl->tpl_vars['conn']->value['data_week']['SumPageLike'];?>
</h4>
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
                During the last 7 days, <?php echo $_smarty_tpl->tpl_vars['accountName']->value;?>
 gained <span class="highlite"><?php echo $_smarty_tpl->tpl_vars['conn']->value['data_week']['SumPageFanAddsUnique'];?>
</span> new fans
                (<span class="highlite">a change of <?php echo smarty_function_math(array('equation'=>"(((x - y)/y)*100)",'format'=>"%.2f",'x'=>$_smarty_tpl->tpl_vars['conn']->value['data_day']['SumPageFans'],'y'=>$_smarty_tpl->tpl_vars['conn']->value['data_day']['SumPageFansFrom']),$_smarty_tpl);?>
%</span>) for a total community size of <span class="highlite"><?php echo $_smarty_tpl->tpl_vars['conn']->value['data_day']['SumPageFans'];?>
 people</span>.
                Over the course of the week, an average of <span class="highlite"><?php echo round($_smarty_tpl->tpl_vars['conn']->value['data_week']['SumPageEngagementsUniqueAvg'],0);?>
 unique fans</span> engaged with your content daily.
                Of these fans, the most active demographic groups where
                <span class="highlite">
                    <?php if ($_smarty_tpl->tpl_vars['conn']->value['data_week']['ActiveDemographics'][0]->Gender=='M') {?>Male<?php } else { ?>Female<?php }?> <?php echo $_smarty_tpl->tpl_vars['conn']->value['data_week']['ActiveDemographics'][0]->Age;?>

                </span>
                    and
                <span class="highlite">
                    <?php if ($_smarty_tpl->tpl_vars['conn']->value['data_week']['ActiveDemographics'][1]->Gender=='M') {?>Male<?php } else { ?>Female<?php }?> <?php echo $_smarty_tpl->tpl_vars['conn']->value['data_week']['ActiveDemographics'][1]->Age;?>

                </span>.
                This engagement withs your content served to extend the reach of your brand message by an average of approximately
                <span class="highlite">
                    <?php echo round(($_smarty_tpl->tpl_vars['conn']->value['data_week']['AvgImpressionsUnique']-$_smarty_tpl->tpl_vars['conn']->value['data_week']['AvgImpressionsFanUnique']),0);?>
 non-fans per post
                </span>.
            </div>
        </div>

    </div>
    <div class="col-md-6">

        <div class="panel panel-default">
            <div class="panel-heading">Recent Community Growth</div>
            <div class="text-center"><?php echo $_smarty_tpl->tpl_vars['conn']->value['chart'];?>
</div>
        </div>

    </div>
</div>

<?php } elseif ($_smarty_tpl->tpl_vars['conn']->value['Type']=='twitter') {?>


<nav class="navbar navbar-default" role="navigation" style="margin-top:15px; margin-bottom: 15px;">
    <div class="container-fluid">
        <div class="navbar-header">
            <div class="navbar-brand">Twitter</div>
        </div>
        <p class="navbar-text">Data during the past 7 days</p>
        <a class="btn btn-default navbar-btn navbar-right btnPadding" href="/reports/view/<?php echo $_smarty_tpl->tpl_vars['conn']->value['AccountID'];?>
/<?php echo $_smarty_tpl->tpl_vars['conn']->value['ConnectionID'];?>
">View Full Report</a>
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
                                <h2><?php echo smarty_function_math(array('equation'=>"x + y + z + s",'x'=>number_format($_smarty_tpl->tpl_vars['conn']->value['favorites']),'y'=>number_format($_smarty_tpl->tpl_vars['conn']->value['mentions']),'z'=>number_format($_smarty_tpl->tpl_vars['conn']->value['retweets']),'s'=>number_format($_smarty_tpl->tpl_vars['conn']->value['replies'])),$_smarty_tpl);?>
</h2>
                            </div>
                            <div class="col-sm-6">
                                <h2><?php echo number_format($_smarty_tpl->tpl_vars['conn']->value['User']->FollowersCount);?>
</h2>
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
                                <h4><?php echo number_format($_smarty_tpl->tpl_vars['conn']->value['replies']);?>
</h4>
                            </div>
                            <div class="col-sm-3">
                                <h4><?php echo number_format($_smarty_tpl->tpl_vars['conn']->value['retweets']);?>
</h4>
                            </div>
                            <div class="col-sm-3">
                                <h4><?php echo number_format($_smarty_tpl->tpl_vars['conn']->value['mentions']);?>
</h4>
                            </div>
                            <div class="col-sm-3">
                                <h4><?php echo number_format($_smarty_tpl->tpl_vars['conn']->value['favorites']);?>
</h4>
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
                During the last 7 days, <?php echo $_smarty_tpl->tpl_vars['conn']->value['User']->Name;?>
 (@<?php echo $_smarty_tpl->tpl_vars['conn']->value['User']->ScreenName;?>
) gained <span class="highlite"><?php echo $_smarty_tpl->tpl_vars['conn']->value['NewFollowers']->new;?>
</span> new followers on Twitter
                    (<span class="highlite"><?php echo smarty_function_math(array('equation'=>"x * 100 / y",'format'=>"%.2f",'x'=>$_smarty_tpl->tpl_vars['conn']->value['NewFollowers']-'new','y'=>$_smarty_tpl->tpl_vars['conn']->value['User']->FollowersCount),$_smarty_tpl);?>
% growth</span>) to reach a total fan base of
                    <span class="highlite"><?php echo $_smarty_tpl->tpl_vars['conn']->value['User']->FollowersCount;?>
 users</span>.

                <span style="color:red">This month, each published Tweet yielded an average of <?php echo smarty_function_math(array('equation'=>"x / y ",'format'=>"%.2f",'x'=>$_smarty_tpl->tpl_vars['conn']->value['Potential_Impression']->PotentialImpression,'y'=>$_smarty_tpl->tpl_vars['conn']->value['tweets']),$_smarty_tpl);?>
 potential impressions and, as a whole.</span>

                Your Twitter account received a total of <span class="highlite">
                    <?php echo smarty_function_math(array('equation'=>"x + y + z + s",'x'=>$_smarty_tpl->tpl_vars['conn']->value['favorites'],'y'=>$_smarty_tpl->tpl_vars['conn']->value['mentions'],'z'=>$_smarty_tpl->tpl_vars['conn']->value['retweets'],'s'=>$_smarty_tpl->tpl_vars['conn']->value['replies']),$_smarty_tpl);?>
</span> engagement from both followers and non-followers.
            </div>
        </div>

    </div>
    <div class="col-md-6">

        <div class="panel panel-default">
            <div class="panel-heading">Recent Follower Growth</div>
            <div class="text-center"><?php echo $_smarty_tpl->tpl_vars['conn']->value['chart'];?>
</div>
        </div>


    </div>
</div>

<?php }?>


<?php } ?>
<script type="text/javascript">    
</script><?php }} ?>
