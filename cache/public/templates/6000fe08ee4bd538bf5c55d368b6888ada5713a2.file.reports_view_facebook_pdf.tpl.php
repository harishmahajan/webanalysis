<?php /* Smarty version Smarty-3.1.17, created on 2015-03-01 22:07:33
         compiled from "/var/www/application/public/templates/reports_view_facebook_pdf.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21031853835419497e8b5408-54193086%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6000fe08ee4bd538bf5c55d368b6888ada5713a2' => 
    array (
      0 => '/var/www/application/public/templates/reports_view_facebook_pdf.tpl',
      1 => 1425276416,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21031853835419497e8b5408-54193086',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5419497ec0d856_83595554',
  'variables' => 
  array (
    'accountName' => 0,
    'data_week' => 0,
    'data_day' => 0,
    'Charts' => 0,
    'acName' => 0,
    'report_date_to' => 0,
    'report_date_from' => 0,
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
<?php if ($_valid && !is_callable('content_5419497ec0d856_83595554')) {function content_5419497ec0d856_83595554($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include 'library/smarty/plugins/function.math.php';
if (!is_callable('smarty_modifier_date_format')) include 'library/smarty/plugins/modifier.date_format.php';
?><style>
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
                During the period, <?php echo $_smarty_tpl->tpl_vars['accountName']->value;?>
 gained <?php echo $_smarty_tpl->tpl_vars['data_week']->value['SumPageFanAddsUnique'];?>
 new fans
                (a change of <?php echo smarty_function_math(array('equation'=>"(((x - y)/y)*100)",'format'=>"%.2f",'x'=>$_smarty_tpl->tpl_vars['data_day']->value['SumPageFans'],'y'=>$_smarty_tpl->tpl_vars['data_day']->value['SumPageFansFrom']),$_smarty_tpl);?>
%) for a total community size of <?php echo $_smarty_tpl->tpl_vars['data_day']->value['SumPageFans'];?>
 people.
                Over the course of the period, an average of <?php echo round($_smarty_tpl->tpl_vars['data_week']->value['SumPageEngagementsUniqueAvg'],0);?>
 unique fans engaged with your content daily.
                Of these fans, the most active demographic groups where
                   
                        <?php if ($_smarty_tpl->tpl_vars['data_week']->value['ActiveDemographics'][0]->Gender=='M') {?>Male<?php } else { ?>Female<?php }?> <?php echo $_smarty_tpl->tpl_vars['data_week']->value['ActiveDemographics'][0]->Age;?>

                   
                and
                    
                        <?php if ($_smarty_tpl->tpl_vars['data_week']->value['ActiveDemographics'][1]->Gender=='M') {?>Male<?php } else { ?>Female<?php }?> <?php echo $_smarty_tpl->tpl_vars['data_week']->value['ActiveDemographics'][1]->Age;?>

                    .
                This engagement with your content served to extend the reach of your brand message by an average of approximately
                   
                        <?php echo round(($_smarty_tpl->tpl_vars['data_week']->value['AvgImpressionsUnique']-$_smarty_tpl->tpl_vars['data_week']->value['AvgImpressionsFanUnique']),0);?>
 non-fans per post
                    .
            </div>
        </div>

    </div>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Recent Community Growth</div>
            <div class="text-center strach"><?php echo $_smarty_tpl->tpl_vars['Charts']->value['rcg'];?>
</div>
        </div>
    </div>
</div>

     
<div class="col-md-6 my2" style="widht:350px; height:325px;">

    <div class="panel panel-default key" >

        <h2>TOTAL</h2>
        <h2>ENGAGEMENTS</h2>
        <h2><?php echo $_smarty_tpl->tpl_vars['data_week']->value['SumPageEngagedUsers'];?>
</h2>

        <table class="midtable">
            <tbody>
            <tr>
                <td>&nbsp;</td>
                <td><b><?php echo $_smarty_tpl->tpl_vars['data_week']->value['SumPageLike'];?>
</b></td>
                <td>Likes</td>
                <td><b><?php echo $_smarty_tpl->tpl_vars['data_week']->value['SumPageStorytellers'];?>
</b></td>
                <td>Shares</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><b><?php echo $_smarty_tpl->tpl_vars['data_week']->value['SumPageComment'];?>
</b></td>
                <td>Comments</td>
                <td><b><?php echo $_smarty_tpl->tpl_vars['data_week']->value['SumPageLink'];?>
</b></td>
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
                <td><b><?php echo $_smarty_tpl->tpl_vars['data_week']->value['SumPageImpressionsUnique'];?>
</b></td>
                <td><b><?php echo $_smarty_tpl->tpl_vars['data_week']->value['SumPageImpressions'];?>
</b></td>
            </tr>
            </tbody>
        </table>

    </div>

</div>

<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">Community Activity</div>
        <div class="text-center"><?php echo $_smarty_tpl->tpl_vars['Charts']->value['ca'];?>
</div>
    </div>
</div>


<div class="col-md-6" style="margin-bottom: -10px; z-index: 10; background-color: #ffffff">
    <div class="panel panel-default" style=" z-index: 15;">
        <div class="panel-heading">Demographics</div>
        <div class="text-center" style="border: solid 1px #943735;">
            <div style="width:60%; margin-left:20%" class="text-center"><?php echo $_smarty_tpl->tpl_vars['Charts']->value['dem_pie'];?>
</div>
            <div><?php echo $_smarty_tpl->tpl_vars['Charts']->value['dem'];?>
</div>
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
            <?php echo $_smarty_tpl->tpl_vars['acName']->value;?>

        </td>
        <td align="right" style="font-size:16px"> 
            <?php ob_start();?><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['report_date_to']->value,"%m");?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['report_date_from']->value,"%m");?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp1==$_tmp2) {?> 
                <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['report_date_to']->value,"%B");?>
 summary Report <?php echo $_smarty_tpl->tpl_vars['report_date_to']->value;?>

            <?php } else { ?>
                <?php echo $_smarty_tpl->tpl_vars['report_date_from']->value;?>
 To <?php echo $_smarty_tpl->tpl_vars['report_date_to']->value;?>

            <?php }?>        
        </td>
    </tr>    
</table>


 <div class="page" style="font-family: avantgarde-book">
<div class="col-md-12">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Organic vs. Paid Likes</div>
            <div class="text-center"><?php echo $_smarty_tpl->tpl_vars['Charts']->value['ovp'];?>
</div>
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
                    <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['TopCities']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['city']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['city']['iteration']++;
?>
                        <tr>
                            <td class="fsize">&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['city']['iteration'];?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['row']->value->City;?>
</td>
                            <td class="fsize"><?php echo $_smarty_tpl->tpl_vars['row']->value->val;?>
</td>
                        </tr>
                    <?php } ?>
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
                    <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['TopExTrafficSources']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['referral']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['referral']['iteration']++;
?>
                        <tr>
                            <td class="fsize">&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['referral']['iteration'];?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['row']->value->Referral;?>
</td>
                            <td class="center fsize"><?php echo $_smarty_tpl->tpl_vars['row']->value->val;?>
</td>
                        </tr>
                    <?php } ?>
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
                <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ContentBreakdown']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                    <tr >
                        <td><?php echo $_smarty_tpl->tpl_vars['row']->value->day;?>
</td>
                        <td></td>
                        <td><?php echo $_smarty_tpl->tpl_vars['row']->value->Post_message;?>
...</a></td>
                        <td align="center"><?php echo $_smarty_tpl->tpl_vars['row']->value->Post_story_adds;?>
</td>
                        <td align="center"><?php echo $_smarty_tpl->tpl_vars['row']->value->Post_consumptions;?>
</td>
                        <td align="center"><?php echo smarty_function_math(array('equation'=>"round( ((( x + y ) / z) * 100) ,1)",'x'=>$_smarty_tpl->tpl_vars['row']->value->Post_story_adds,'y'=>$_smarty_tpl->tpl_vars['row']->value->Post_consumptions,'z'=>$_smarty_tpl->tpl_vars['row']->value->Post_impressions_unique),$_smarty_tpl);?>
%</td>
                        <td align="center"><?php echo $_smarty_tpl->tpl_vars['row']->value->Post_impressions_unique;?>
</td>
                        <td align="center"><?php echo $_smarty_tpl->tpl_vars['row']->value->Post_impressions;?>
</td>
                        <td align="center"><?php echo smarty_function_math(array('equation'=>"round( (((x - y) / x) * 100) ,1)",'x'=>$_smarty_tpl->tpl_vars['row']->value->Post_impressions_unique,'y'=>$_smarty_tpl->tpl_vars['row']->value->Post_impressions_fan_unique),$_smarty_tpl);?>
%</td>
                    </tr>
                <?php } ?>
                <?php if ($_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->min_day) {?>
                    <tr>
                        <td colspan="3" align="center"><b>Average from <?php echo $_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->min_day;?>
 to <?php echo $_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->max_day;?>
</b></td>
                        
                        <td align="center"><?php echo round($_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->avg_Post_story_adds);?>
</td>
                        <td align="center"><?php echo round($_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->avg_Post_consumptions);?>
</td>
                        <td align="center"><?php echo smarty_function_math(array('equation'=>"round( ((( x + y ) / z) * 100) ,1)",'x'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->avg_Post_story_adds,'y'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->avg_Post_consumptions,'z'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->avg_Post_impressions_unique),$_smarty_tpl);?>
%</td>
                        <td align="center"><?php echo round($_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->avg_Post_impressions_unique);?>
</td>
                        <td align="center"><?php echo round($_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->avg_Post_impressions);?>
</td>
                        <td align="center"><?php echo smarty_function_math(array('equation'=>"round( (((x - y) / x) * 100) ,1)",'x'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->avg_Post_impressions_unique,'y'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->avg_Post_impressions_fan_unique),$_smarty_tpl);?>
%</td>
                    </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->min_day) {?>
                    <tr>
                        <td colspan="3" align="center"><b>Average from <?php echo $_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->min_day;?>
 to <?php echo $_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->max_day;?>
</b></td>                        
                        <td align="center"><?php echo round($_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->avg_Post_story_adds);?>
</td>
                        <td align="center"><?php echo round($_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->avg_Post_consumptions);?>
</td>
                        <td align="center"><?php echo smarty_function_math(array('equation'=>"round( ((( x + y ) / z) * 100) ,1)",'x'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->avg_Post_story_adds,'y'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->avg_Post_consumptions,'z'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->avg_Post_impressions_unique),$_smarty_tpl);?>
%</td>
                        <td align="center"><?php echo round($_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->avg_Post_impressions_unique);?>
</td>
                        <td align="center"><?php echo round($_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->avg_Post_impressions);?>
</td>
                        <td align="center"><?php echo smarty_function_math(array('equation'=>"round( (((x - y) / x) * 100) ,1)",'x'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->avg_Post_impressions_unique,'y'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown_last']->value->avg_Post_impressions_fan_unique),$_smarty_tpl);?>
%</td>
                    </tr>
                <?php }?>
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
        <div class="text-center"><?php echo $_smarty_tpl->tpl_vars['Charts']->value['rbd'];?>
</div>
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
                        <td><?php echo round($_smarty_tpl->tpl_vars['CommunityMetrics']->value->daily_reach,0);?>
</td>
                    </tr>
                    <tr>
                        <td>
                            <div>Average Daily Impressions</div>
                            (unique user access on facebook)
                        </td>
                        <td><?php echo round($_smarty_tpl->tpl_vars['CommunityMetrics']->value->daily_impr,0);?>
</td>
                    </tr>
                    <tr>
                       <td>
                            <div>Your Community Engagement</div>
                            (of the fans that saw your post)>
                        </td>
                        <td><?php echo smarty_function_math(array('equation'=>"(( x / y ) * 100)",'format'=>"%.2f",'x'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->avg_Post_engaged_users,'y'=>$_smarty_tpl->tpl_vars['AvgContentBreakdown']->value->avg_Post_impressions_unique),$_smarty_tpl);?>
%</td>
                    </tr>
                    <tr>
                       <td>
                            <div>Fan Growth Ratio</div>
                            (measures stickiness of new fans vs lost fans)
                        </td>
                        <td><?php echo smarty_function_math(array('equation'=>"( ( 1 - ( x / y ) ) * 100 )",'format'=>"%.2f",'x'=>$_smarty_tpl->tpl_vars['CommunityMetrics']->value->fan_rem,'y'=>$_smarty_tpl->tpl_vars['CommunityMetrics']->value->fan_add),$_smarty_tpl);?>
%</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<div class="col-md-4">
        <div class="panel panel-default">
            <div style="font-size:12px !important;text-align: center;"><b>INTERNAL FAN SOURCES</b></div>
            <div class="text-center"><?php echo $_smarty_tpl->tpl_vars['Charts']->value['ifs'];?>
</div>
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
</div><?php }} ?>
