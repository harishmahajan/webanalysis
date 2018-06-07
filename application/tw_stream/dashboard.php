<?php


/**
 * Created by Indrek Päri
 * Date: 25.03.14 14:43
 */

namespace Model;
//error_reporting( E_ALL );
class Dashboard extends \Webpage
{
    private $aTplVars = array();
    private $aQuaryArray;

    public function __construct($aQa)
    {
        $this->aQuaryArray = $aQa;
    }
    public function view(){

        // do we have a account(s)
        if($aAccounts = \Account::getClientAccounts(\Utility\Client::getClientId()))
        {
            if($oAccount = \Account::isMyAccount(\Utility\Client::getClientId(),$this->aQuaryArray[2]))
            {

                //get all connections
                $this->aTplVars['oConnections'] = \Connection::getAccountConnections($this->aQuaryArray[2]);

                $this->aTplVars['naming'] = \Facebook_data::$naming;
                $this->aTplVars['accountName'] = \Account::getName($this->aQuaryArray[2]);

                foreach($this->aTplVars['oConnections'] as $conn)
                {

                    if($conn->Type == 'twitter')
                    {
                        $maxdate = date("Y-m-d");
                        $from_time = strtotime("-6 days");
                        $to_time = time();

                        $oUserData = \Twitter_data::getUserDetailsByTwId($conn->ExternalConnectionID);

                        $oChart = new \Chart(array('chart','followergrowth','html',$conn->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)));
                        $sChartHtml = $oChart->Followergrowth($oUserData->DataTwUserID);

                        $this->aTplVars['connection'][] = array(
                            'AccountID' => $conn->AccountID,
                            'ConnectionID' => $conn->ConnectionID,
                            'Type' => $conn->Type,
                            'FromDate' => $conn->FromDate,
                            'ToDate' => $conn->ToDate,

                            // user data
                            'User' => $oUserData,

                            // get new followers
                            'NewFollowers' => \Twitter_data::getNewFollowers($conn->ConnectionID,$oUserData->DataTwUserID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)),

                            'favorites' => \Twitter_data::getFavorites($conn->ConnectionID,$oUserData->DataTwUserID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)),
                            'mentions' => \Twitter_data::getMentions($conn->ConnectionID,$oUserData->DataTwUserID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)),
                            'retweets' => \Twitter_data::getRetweets($conn->ConnectionID,$oUserData->DataTwUserID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)),
                            'replies' => \Twitter_data::getReplies($conn->ConnectionID,$oUserData->DataTwUserID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)),

                            'chart' => $sChartHtml
                        );                       
                    }
                    elseif($conn->Type == 'facebook')
                    {
                        $maxdate = \Facebook_data::getMaxDate($conn->ConnectionID);

                        $from_w_time = strtotime("-13 days");
                        $from_time = strtotime("-6 days");
                        $to_time = time();

                        $oSumData_d1 = \Facebook_data::getSumDate($conn->ConnectionID, $maxdate,$maxdate);
                        $oSumData_fd1 = \Facebook_data::getSumDate($conn->ConnectionID,date("Y-m-d",($from_time-60*60*24)),date("Y-m-d",($from_time-60*60*24)));
                        $oSumData_w1 = \Facebook_data::getSumDate($conn->ConnectionID, date("Y-m-d",$from_time),date("Y-m-d",$to_time));
                        $oSumData_w2 = \Facebook_data::getSumDate($conn->ConnectionID, date("Y-m-d",$to_time), date("Y-m-d",$from_w_time));

                        $oChart = new \Chart(array('chart','communitygrowth','html',$conn->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)));
                        $sChartHtml = $oChart->communitygrowth();

                        $this->aTplVars['connection'][] = array(
                            'AccountID' => $conn->AccountID,
                            'ConnectionID' => $conn->ConnectionID,
                            'Type' => $conn->Type,
                            'FromDate' => $conn->FromDate,
                            'ToDate' => $conn->ToDate,

                            'data_day' => array(
                                'SumPageFans' => $oSumData_d1->SumPageFans,
                                'SumPageFansFrom' => $oSumData_fd1->SumPageFans,
                            ),

                            'CountPostinPeriod' => \Facebook_data::getCountPosts($conn->ConnectionID, date("Y-m-d",$from_time),date("Y-m-d",$to_time)),

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
                                'SumPageEngagementsUniqueAvg' => \Facebook_data::getDailyAverageEngaged($conn->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)),
                                'ActiveDemographics' => \Facebook_data::activeDemographicGroups($conn->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time))
                            ),

                            'chart' => $sChartHtml
                        );
                    }
                }

                $this->addSub('dashboard_view.tpl','content',$this->aTplVars);

            }
            else
            {

                \Utility\Url::phpRedirect('/dashboard/view/'.$aAccounts[0]->AccountID);

            }
        }
        else
        {

            \Utility\Url::phpRedirect('/account/add');

        }     
    }
    public function viewForPopup($id)
    {
        $id="83";
        // do we have a account(s)
        if($aAccounts = \Account::getClientAccounts(\Utility\Client::getClientId()))
        {
            if($oAccount = \Account::isMyAccount(\Utility\Client::getClientId(),$id))
            {

                //get all connections
                $this->aTplVars['oConnections'] = \Connection::getAccountConnections($id);

                $this->aTplVars['naming'] = \Facebook_data::$naming;
                $this->aTplVars['accountName'] = \Account::getName($id);

                foreach($this->aTplVars['oConnections'] as $conn)
                {

                    if($conn->Type == 'twitter')
                    {
                        $maxdate = date("Y-m-d");
                        $from_time = strtotime("-6 days");
                        $to_time = time();

                        $oUserData = \Twitter_data::getUserDetailsByTwId($conn->ExternalConnectionID);

                        $oChart = new \Chart(array('chart','followergrowth','html',$conn->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)));
                        $sChartHtml = $oChart->Followergrowth($oUserData->DataTwUserID);

                        $this->aTplVars['connection'][] = array(
                            'AccountID' => $conn->AccountID,
                            'ConnectionID' => $conn->ConnectionID,
                            'Type' => $conn->Type,
                            'FromDate' => $conn->FromDate,
                            'ToDate' => $conn->ToDate,

                            // user data
                            'User' => $oUserData,

                            // get new followers
                            'NewFollowers' => \Twitter_data::getNewFollowers($conn->ConnectionID,$oUserData->DataTwUserID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)),

                            'favorites' => \Twitter_data::getFavorites($conn->ConnectionID,$oUserData->DataTwUserID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)),
                            'mentions' => \Twitter_data::getMentions($conn->ConnectionID,$oUserData->DataTwUserID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)),
                            'retweets' => \Twitter_data::getRetweets($conn->ConnectionID,$oUserData->DataTwUserID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)),
                            'replies' => \Twitter_data::getReplies($conn->ConnectionID,$oUserData->DataTwUserID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)),

                            'chart' => $sChartHtml
                        );                       
                    }
                    elseif($conn->Type == 'facebook')
                    {
                        $maxdate = \Facebook_data::getMaxDate($conn->ConnectionID);

                        $from_w_time = strtotime("-13 days");
                        $from_time = strtotime("-6 days");
                        $to_time = time();

                        $oSumData_d1 = \Facebook_data::getSumDate($conn->ConnectionID, $maxdate,$maxdate);
                        $oSumData_fd1 = \Facebook_data::getSumDate($conn->ConnectionID,date("Y-m-d",($from_time-60*60*24)),date("Y-m-d",($from_time-60*60*24)));
                        $oSumData_w1 = \Facebook_data::getSumDate($conn->ConnectionID, date("Y-m-d",$from_time),date("Y-m-d",$to_time));
                        $oSumData_w2 = \Facebook_data::getSumDate($conn->ConnectionID, date("Y-m-d",$to_time), date("Y-m-d",$from_w_time));

                        $oChart = new \Chart(array('chart','communitygrowth','html',$conn->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)));
                        $sChartHtml = $oChart->communitygrowth();

                        $this->aTplVars['connection'][] = array(
                            'AccountID' => $conn->AccountID,
                            'ConnectionID' => $conn->ConnectionID,
                            'Type' => $conn->Type,
                            'FromDate' => $conn->FromDate,
                            'ToDate' => $conn->ToDate,

                            'data_day' => array(
                                'SumPageFans' => $oSumData_d1->SumPageFans,
                                'SumPageFansFrom' => $oSumData_fd1->SumPageFans,
                            ),

                            'CountPostinPeriod' => \Facebook_data::getCountPosts($conn->ConnectionID, date("Y-m-d",$from_time),date("Y-m-d",$to_time)),

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
                                'SumPageEngagementsUniqueAvg' => \Facebook_data::getDailyAverageEngaged($conn->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time)),
                                'ActiveDemographics' => \Facebook_data::activeDemographicGroups($conn->ConnectionID,date("Y-m-d",$from_time),date("Y-m-d",$to_time))
                            ),

                            'chart' => $sChartHtml
                        );
                    }
                }
                return $this->aTplVars;
                //$this->addSub('dashboard_view.tpl','content',$this->aTplVars);

            }
            else
            {

                //\Utility\Url::phpRedirect('/dashboard/view/'.$aAccounts[0]->AccountID);

            }
        }
        else
        {

            //\Utility\Url::phpRedirect('/account/add');

        }
    }
}