<?php
/**
 * Created by Indrek Päri
 * Date: 2.04.14 14:33
 */
namespace Model;

class Reports extends \Webpage
{
    private $aTplVars = array();
    private $aQuaryArray;
    private $isPdf = false;

    public function __construct($aQa)
    {
        $this->aQuaryArray = $aQa;
        if(isset($this->aQuaryArray[4]) and $this->aQuaryArray[4] == 'pdf')
        {
            $this->isPdf = true;
        }
    }

    public function view(){

        // do we have a account(s)
        if($aAccounts = \Account::getClientAccounts(\Utility\Client::getClientId()))
        {
            if($oAccount = \Account::isMyAccount(\Utility\Client::getClientId(),$this->aQuaryArray[2]))
            {

                // get account details
                $this->aTplVars['AccountID'] = $this->aQuaryArray[2];
                $this->aTplVars['accountName'] = \Account::getName($this->aQuaryArray[2]);

                // get all connections
                $this->aTplVars['aoConnections'] = \Connection::getAccountConnections($this->aQuaryArray[2]);

                // if not selected, redirect to first connection
                if(!isset($this->aQuaryArray[3]))
                {
                    \Utility\Url::phpRedirect('/reports/view/'.$aAccounts[0]->AccountID.'/'.$this->aTplVars['aoConnections'][0]->ConnectionID);
                }
                // if selected, save object for template and
                else
                {
                    $oConnection = null;
                    foreach($this->aTplVars['aoConnections'] as $conn)
                    {
                        if($conn->ConnectionID == $this->aQuaryArray[3])
                        {
                            $oConnection = $this->aTplVars['oConnection'] = $conn;
                        }
                    }
                }

                // date from and to
                if(isset($_POST['report_date_from']) AND isset($_POST['report_date_to']))
                {
                    $from_time = strtotime($_POST['report_date_from']);
                    $to_time = strtotime($_POST['report_date_to']);
                }
                else
                {
                    $from_time = strtotime("-1 month");
                    $to_time = time();
                }

                $this->aTplVars['report_date_from'] = date("m/d/Y",$from_time);
                $this->aTplVars['report_date_to'] = date("m/d/Y",$to_time);

                $aCharts = array();
                if($oConnection->Type == 'facebook')
                {
                    $maxdate = \Facebook_data::getMaxDate($oConnection->ConnectionID);

                    // KPI and Summary
                    $oSumData_d1 = \Facebook_data::getSumDate($oConnection->ConnectionID,date("Y-m-d",$to_time),date("Y-m-d",$to_time));
                    $oSumData_fd1 = \Facebook_data::getSumDate($oConnection->ConnectionID,date("Y-m-d",($from_time-60*60*24)),date("Y-m-d",($from_time-60*60*24)));
                    $oSumData_w1 = \Facebook_data::getSumDate($oConnection->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time));
                    $oSumData_w2 = \Facebook_data::getSumDate($oConnection->ConnectionID,\Utility\Small::date_decrease(date("Y-m-d",$to_time),13),\Utility\Small::date_decrease(date("Y-m-d",$to_time),7));

                    // Recent Community Growth
                    $oChart = new \Chart(array('chart','RecentCommunityGrowth',($this->isPdf?'img':'html'),$oConnection->ConnectionID,\Utility\Small::date_decrease(date("Y-m-d",$to_time),90),date("Y-m-d",$to_time)));
                    $aCharts['rcg'] = $oChart->RecentCommunityGrowth();

                    // Community Activity
                    $oChart = new \Chart(array('chart','CommunityActivity',($this->isPdf?'img':'html'),$oConnection->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)));
                    $aCharts['ca'] = $oChart->CommunityActivity();

                    // Demographics
                    $oChart = new \Chart(array('chart','Demographics',($this->isPdf?'img':'html'),$oConnection->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)));
                    $aCharts['dem'] = $oChart->Demographics();

                    // Demographics pie
                    $oChart = new \Chart(array('chart','Demographics_pie',($this->isPdf?'img':'html'),$oConnection->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)));
                    $aCharts['dem_pie'] = $oChart->Demographics_pie();

                    // Communitygrowth
                    $oChart = new \Chart(array('chart','Communitygrowth',($this->isPdf?'img':'html'),$oConnection->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)));
                    $aCharts['communitygrowth'] = $oChart->Communitygrowth();

                    // Active Demographics
                    $oChart = new \Chart(array('chart','ActiveDemographics',($this->isPdf?'img':'html'),$oConnection->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)));
                    $aCharts['demographics'] = $oChart->ActiveDemographics();

                    // Organic vs. Paid Likes
                    $oChart = new \Chart(array('chart','OrganicVsPaidLikes',($this->isPdf?'img':'html'),$oConnection->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)));
                    $aCharts['ovp'] = $oChart->OrganicVsPaidLikes();

                    // Reach Breakdown
                    $oChart = new \Chart(array('chart','ReachBreakdown',($this->isPdf?'img':'html'),$oConnection->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)));
                    $aCharts['rbd'] = $oChart->ReachBreakdown();

                    // Internal Fan Sources
                    $oChart = new \Chart(array('chart','InternalFanSources',($this->isPdf?'img':'html'),$oConnection->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)));
                    $aCharts['ifs'] = $oChart->InternalFanSources();

                    $avg_content = \Facebook_data::getAvgContentBreakdown($oConnection->ConnectionID, date("Y-m-d",$from_time),date("Y-m-d",$to_time));
                    $avg_content_last = \Facebook_data::getAvgContentBreakdown($oConnection->ConnectionID, \Utility\Small::date_decrease(date("Y-m-d",$from_time),$avg_content->days_diff),\Utility\Small::date_decrease(date("Y-m-d",$from_time),1));

                    $aReportTplVars = array(

                        'isPdf' => $this->isPdf,

                        'report_date_from' => date("m/d/Y",$from_time),
                        'report_date_to' => date("m/d/Y",$to_time),

                        // KPI and Summary
                        'data_day' => array(
                            'SumPageFans' => $oSumData_d1->SumPageFans,
                            'SumPageFansFrom' => $oSumData_fd1->SumPageFans,
                        ),
                        'data_week' => array(
                            'SumPageFans' => $oSumData_w1->SumPageFans,
                            'SumPageStorytellers' => $oSumData_w1->SumPageStorytellers,
                            'SumPageImpressionsUnique' => $oSumData_w1->SumPageImpressionsUnique,
                            'SumPageImpressionsOrganic' => $oSumData_w1->SumPageImpressionsOrganic,
                            'SumPageImpressions' => $oSumData_w1->SumPageImpressions,
                            'SumPageEngagedUsers' => $oSumData_w1->SumPageEngagedUsers,
                            'SumPageFanAddsUnique' => $oSumData_w1->SumPageFanAddsUnique,
                            'SumPageConsumptions' => $oSumData_w1->SumPageConsumptions,
                            'SumPageComment' => $oSumData_w1->SumPageComment,
                            'SumPageLike' => $oSumData_w1->SumPageLike,
                            'SumPageLink' => $oSumData_w1->SumPageLink,

                            'AvgImpressionsUnique' => $oSumData_w1->AvgImpressionsUnique,
                            'AvgImpressionsFanUnique' => $oSumData_w1->AvgImpressionsFanUnique,

                            // calc
                            'SumPageEngagedUsers_parentage' => round(($oSumData_w1->SumPageEngagedUsers / $oSumData_w2->SumPageEngagedUsers) * 100),

                            // request
                            //'SumPageImpressionsUniqueAvg' => \Facebook_data::getDailyAverageImpressions($oConnection->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)),
                            'SumPageEngagementsUniqueAvg' => \Facebook_data::getDailyAverageEngaged($oConnection->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)),
                            'ActiveDemographics' => \Facebook_data::activeDemographicGroups($oConnection->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time))
                        ),

                        'CountPostinPeriod' => \Facebook_data::getCountPosts($oConnection->ConnectionID, date("Y-m-d",$from_time),date("Y-m-d",$to_time)),

                        'Charts' => $aCharts,
                        'ContentBreakdown' => \Facebook_data::getContentBreakdown($oConnection->ConnectionID, date("Y-m-d",$from_time),date("Y-m-d",$to_time)),

                        'AvgContentBreakdown' => $avg_content,
                        'AvgContentBreakdown_last' => $avg_content_last,

                        'TopCities' => \Facebook_data::getTopCities($oConnection->ConnectionID, date("Y-m-d",$from_time),date("Y-m-d",$to_time)),
                        'TopExTrafficSources' => \Facebook_data::getTopExternalTrafficSources($oConnection->ConnectionID, date("Y-m-d",$from_time),date("Y-m-d",$to_time)),
                        'CommunityMetrics' => \Facebook_data::getCommunityMetrics($oConnection->ConnectionID, date("Y-m-d",$from_time),date("Y-m-d",$to_time)),
                    );

                    $this->aTplVars['report'] = \Utility\SmartyTemplate::fetchTemplate(
                        'reports_view_facebook_'.($this->isPdf?'pdf':'html').'.tpl',
                        $aReportTplVars
                    );

                }
                elseif($oConnection->Type == 'twitter')
                {

                    $oUserData = \Twitter_data::getUserDetailsByTwId($oConnection->ExternalConnectionID);

                    $oChart = new \Chart(array('chart','Followergrowth',($this->isPdf?'img':'html'),$oConnection->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)));
                    $aCharts['followers'] = $oChart->Followergrowth($oUserData->DataTwUserID);

                    // Mentions
                    $oChart = new \Chart(array('chart','Mentions',($this->isPdf?'img':'html'),$oConnection->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)));
                    $aCharts['mentions'] = $oChart->Mentions($oUserData->DataTwUserID);

                    $aReportTplVars = array(

                        'isPdf' => $this->isPdf,

                        // user data
                        'User' => $oUserData,

                        // get new followers
                        'NewFollowers' => \Twitter_data::getNewFollowers($conn->ConnectionID,$oUserData->DataTwUserID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)),

                        'favorites' => \Twitter_data::getFavorites($conn->ConnectionID,$oUserData->DataTwUserID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)),
                        'mentions' => \Twitter_data::getMentions($conn->ConnectionID,$oUserData->DataTwUserID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)),
                        'retweets' => \Twitter_data::getRetweets($conn->ConnectionID,$oUserData->DataTwUserID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)),
                        'replies' => \Twitter_data::getReplies($conn->ConnectionID,$oUserData->DataTwUserID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)),

                        'tweets' => \Twitter_data::getTweets($conn->ConnectionID,$oUserData->DataTwUserID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)),

                        'recent_tweets' => \Twitter_data::getRecentTweets($conn->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)),
                        'most_active_fans' => \Twitter_data::getMostActiveFans($conn->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)),
                        'top_locations' => \Twitter_data::getTopLocations($conn->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)),

                        'Charts' => $aCharts
                    );

                    $this->aTplVars['report'] = \Utility\SmartyTemplate::fetchTemplate(
                        'reports_view_twitter_'.($this->isPdf?'pdf':'html').'.tpl',
                        $aReportTplVars
                    );

                }

                if($this->isPdf)
                {
                    \Utility\Pdf::Generate($oConnection->Type.'.pdf',\Utility\SmartyTemplate::fetchTemplate('reports_view_pdf.tpl',$this->aTplVars));
                    //echo \Utility\SmartyTemplate::fetchTemplate('reports_view_pdf.tpl',$this->aTplVars);
                    exit();
                }
                else
                {
                    $this->addSub('reports_view_html.tpl','content',$this->aTplVars);
                }


            }
            else
            {
                \Utility\Url::phpRedirect('/reports/view/'.$aAccounts[0]->AccountID);
            }
        }
        else
        {
            \Utility\Url::phpRedirect('/account/add');
        }

    }
}