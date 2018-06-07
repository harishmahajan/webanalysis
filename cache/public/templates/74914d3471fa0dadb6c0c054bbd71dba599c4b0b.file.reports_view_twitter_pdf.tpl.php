<?php /* Smarty version Smarty-3.1.17, created on 2015-03-19 21:51:31
         compiled from "/var/www/application/public/templates/reports_view_twitter_pdf.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5773332875423ed6960f299-45385823%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '74914d3471fa0dadb6c0c054bbd71dba599c4b0b' => 
    array (
      0 => '/var/www/application/public/templates/reports_view_twitter_pdf.tpl',
      1 => 1426827047,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5773332875423ed6960f299-45385823',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5423ed69792822_84959229',
  'variables' => 
  array (
    'dateRange' => 0,
    'User' => 0,
    'NewFollowers' => 0,
    'Potential_Impression' => 0,
    'tweets' => 0,
    'favorites' => 0,
    'mentions' => 0,
    'retweets' => 0,
    'replies' => 0,
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
<?php if ($_valid && !is_callable('content_5423ed69792822_84959229')) {function content_5423ed69792822_84959229($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include 'library/smarty/plugins/function.math.php';
?><style>
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
                    During the last <?php echo $_smarty_tpl->tpl_vars['dateRange']->value+1;?>
 days, <?php echo $_smarty_tpl->tpl_vars['User']->value->Name;?>
 (@<?php echo $_smarty_tpl->tpl_vars['User']->value->ScreenName;?>
) gained <?php echo $_smarty_tpl->tpl_vars['NewFollowers']->value->new;?>
 new followers on Twitter
                    (<?php echo smarty_function_math(array('equation'=>"x * 100 / y",'format'=>"%.2f",'x'=>$_smarty_tpl->tpl_vars['NewFollowers']->value->new,'y'=>$_smarty_tpl->tpl_vars['User']->value->FollowersCount),$_smarty_tpl);?>
% growth) to reach a total fan base of
                    <?php echo $_smarty_tpl->tpl_vars['User']->value->FollowersCount;?>
 users.
                    This month, each published Tweet yielded an average of <?php echo smarty_function_math(array('equation'=>"x / y ",'format'=>"%.2f",'x'=>$_smarty_tpl->tpl_vars['Potential_Impression']->value->PotentialImpression,'y'=>$_smarty_tpl->tpl_vars['tweets']->value),$_smarty_tpl);?>
 potential impressions and, as a whole.
                    Your Twitter account received a total of 
                        <?php echo smarty_function_math(array('equation'=>"x + y + z + s",'x'=>$_smarty_tpl->tpl_vars['favorites']->value,'y'=>$_smarty_tpl->tpl_vars['mentions']->value,'z'=>$_smarty_tpl->tpl_vars['retweets']->value,'s'=>$_smarty_tpl->tpl_vars['replies']->value),$_smarty_tpl);?>
 engagement from both followers and non-followers.
                </div>
            </div>

        </div>

        <div class="" style="padding: 5px 5px 10px 5px;margin-left: 30px;">
            <div class="panel panel-default">
                <div class="panel-heading">Recent Follower Growth</div>
                <div class="text-center"><?php echo $_smarty_tpl->tpl_vars['Charts']->value['followers'];?>
</div>
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
                        <td style="padding:10px"><?php echo $_smarty_tpl->tpl_vars['tweets']->value;?>
</td>
                    </tr>
                    <tr>
                        <td style="padding:10px"><b>Unique People Engaging</b></td>
                        <td style="padding:10px"><?php echo $_smarty_tpl->tpl_vars['Unique_People']->value->UniquePeople;?>
</td>
                    </tr>
                    <tr>
                        <td style="padding:10px"><b>Total Engagement</b></td>
                        <td style="padding:10px"><?php echo smarty_function_math(array('equation'=>"x + y + z + s",'x'=>$_smarty_tpl->tpl_vars['favorites']->value,'y'=>$_smarty_tpl->tpl_vars['mentions']->value,'z'=>$_smarty_tpl->tpl_vars['retweets']->value,'s'=>$_smarty_tpl->tpl_vars['replies']->value),$_smarty_tpl);?>
</td>
                    </tr>
                    <tr>
                        <td style="padding:10px"><b>Potential Reach</b></td>
                        <td style="padding:10px"><?php echo number_format($_smarty_tpl->tpl_vars['Potential_Reach']->value->PotentialReach);?>
</td>
                    </tr>
                    <tr>
                        <td style="padding:10px"><b>Potential Impresssions</b></td>
                        <td style="padding:10px"><?php echo number_format($_smarty_tpl->tpl_vars['Potential_Impression']->value->PotentialImpression);?>
</td>
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
                <td><b><?php echo $_smarty_tpl->tpl_vars['replies']->value;?>
</b><br>&nbsp;</td>
                    <td><b>Replies</b><br>&nbsp;</td>
              </tr>
              <tr>
                <td><b><?php echo $_smarty_tpl->tpl_vars['retweets']->value;?>
</b><br>&nbsp;</td>
                    <td><b>Retweets</b><br>&nbsp;</td>
              </tr>              
              <tr>
                <td rowspan="2"><h2><?php echo smarty_function_math(array('equation'=>"x + y + z + s",'x'=>$_smarty_tpl->tpl_vars['favorites']->value,'y'=>$_smarty_tpl->tpl_vars['mentions']->value,'z'=>$_smarty_tpl->tpl_vars['retweets']->value,'s'=>$_smarty_tpl->tpl_vars['replies']->value),$_smarty_tpl);?>
</h2></td>
                 <td><b><?php echo $_smarty_tpl->tpl_vars['mentions']->value;?>
</b><br>&nbsp;</td>
                    <td><b>Mentions<br>&nbsp;</td>
              </tr>
              <tr>
                <td><b><?php echo $_smarty_tpl->tpl_vars['favorites']->value;?>
</b></td>
                    <td><b>Favorites</b></td>
              </tr>
              <tr><td>&nbsp;</td></tr>
              <tr><td>&nbsp;</td></tr>
            </table> -->
                <div class="Dleft midtable" style="width:200px;font-size:15px !important;">  
                <div class="C">&nbsp;</div>                  
                    <h2>TOTAL<br>
                    ENGAGEMENTS</h2>                         
                    <h2><?php echo smarty_function_math(array('equation'=>"x + y + z + s",'x'=>$_smarty_tpl->tpl_vars['favorites']->value,'y'=>$_smarty_tpl->tpl_vars['mentions']->value,'z'=>$_smarty_tpl->tpl_vars['retweets']->value,'s'=>$_smarty_tpl->tpl_vars['replies']->value),$_smarty_tpl);?>
</h2>
                </div>
                <div class="Dright midtable" style="font-size: 15px !important;">
                    <table class="midtable" style="font-size: 15px !important;">
                        <tr><td>&nbsp;</td></tr>
                        <tr><td>&nbsp;</td></tr>
                          <tr>                
                            <td><b><?php echo $_smarty_tpl->tpl_vars['replies']->value;?>
</b><br>&nbsp;</td>
                                <td><b>Replies</b><br>&nbsp;</td>
                          </tr>
                          <tr>
                            <td><b><?php echo $_smarty_tpl->tpl_vars['retweets']->value;?>
</b><br>&nbsp;</td>
                                <td><b>Retweets</b><br>&nbsp;</td>
                          </tr>              
                          <tr>                
                             <td><b><?php echo $_smarty_tpl->tpl_vars['mentions']->value;?>
</b><br>&nbsp;</td>
                                <td><b>Mentions<br>&nbsp;</td>
                          </tr>
                          <tr>
                            <td><b><?php echo $_smarty_tpl->tpl_vars['favorites']->value;?>
</b></td>
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
            <div class="my2" style="text-align: center;font-family: avantgarde-book !important;font-size: 12px;"><b>RECENT <?php echo $_smarty_tpl->tpl_vars['User']->value->ScreenName;?>
 PULSE</div>
            <div class="panel-body" style="font-size: 8px;text-align: justify;width:305px">

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
    <div class="col-md-6" style="padding: 0 0 0 15px;">

    <div class="panel panel-default">
        <div class="my2" style="text-align: center;font-size: 12px;padding: 0 0 15px 0;"><b>Most Active Users</b></div>
        <div class="panel-body" style="font-size: 12px;">

            <div class="row">
                <div class="col-md-3" style="width:150px">
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['most_active_fans']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>

                    <div class="small"><?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
. @<?php echo $_smarty_tpl->tpl_vars['item']->value->ScreenName;?>
</div>

                    <?php if ($_smarty_tpl->tpl_vars['key']->value==4) {?>
                        </div>
                        <div class="col-md-3" style="width:150px" >
                    <?php }?>

                    <?php } ?>
                </div>
            </div>

        </div>
    </div>

    <div class="panel panel-default">
        <div class="my2" style="text-align: center;font-size: 12px;padding: 30px 0 15px 0;"><b>Top Locations</b></div>
        <div class="panel-body" style="font-size: 12px;">
            <div class="row">
                <div class="col-md-3" style="width:150px">
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['top_locations']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>

                    <div class="small"><?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
. <?php echo $_smarty_tpl->tpl_vars['item']->value->Location;?>
</div>

                    <?php if ($_smarty_tpl->tpl_vars['key']->value==4) {?>
                        </div>
                        <div class="col-md-3" style="width:150px">
                    <?php }?>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<br><?php }} ?>
