<?php

/**
 * Created by Indrek Päri
 * Date: 25.03.14 15:05
 */

namespace Model;
/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/
class account extends \Webpage
{
    private $aTplVars = array();
    private $aTplVars2 = array();
    private $aQuaryArray;

    public function __construct($aQa)
    {
        
        $this->aQuaryArray = $aQa;

        // if no action skip
        if(!isset($_POST['action'])) return;

        switch($_POST['action']){

            case 'addaccount':

                try
                {
                    $iNewAccountID = \Account::addNew(\Utility\Client::getClientId(), $_POST['accountname'],$_POST['timeZone']);
                    
                }
                catch (\DataException $e)
                {
                    $this->aTplVars['account_error'] = $e->getMessage();
                    break;
                }
                // redirect to add connection page:
                     \Utility\Url::phpRedirect('/account/pop/'.$iNewAccountID);

            break;
            case 'twitter_cvs':

                try
                {

                    // we need to select user twitter id
                    $oConnections = \Utility\Db::query("select ExternalConnectionID FROM Connection where AccountID = ? and type='twitter' limit 1",array($this->aQuaryArray[2]));

                    if(in_array($_FILES['twitter_cvs']['type'], array('application/vnd.ms-excel','text/plain','text/csv','text/tsv')))
                    {
                        $valid = false;
                        if (($handle = fopen($_FILES['twitter_cvs']['tmp_name'], "r")) !== FALSE) {
                            while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {

                                // validate first line
                                if(!$valid)
                                {
                                    // from twitter
                                    if($data[0] == 'tweet_id' AND $data[1] == 'in_reply_to_status_id' AND $data[2] == 'in_reply_to_user_id' AND $data[3] == 'timestamp')
                                    {
                                        $valid = true;
                                        $cvs_format = 1;
                                    }
                                    // tweets
                                    elseif($data[0] == 'Username' AND $data[1] == 'Name' AND $data[2] == 'Tweet' AND $data[3] == 'Link')
                                    {
                                        $valid = true;
                                        $cvs_format = 2;
                                    }
                                    // followers
                                    elseif($data[0] == 'Username' AND $data[1] == 'Date' AND $data[2] == 'Total Followers')
                                    {
                                        $valid = true;
                                        $cvs_format = 3;
                                    }
                                    // mentions
                                    elseif($data[0] == 'Account_Mentioned' AND $data[1] == 'Username' AND $data[2] == 'Name' AND $data[3] == 'Update')
                                    {
                                        $valid = true;
                                        $cvs_format = 4;
                                    }
                                    // people
                                    elseif($data[0] == 'Username' AND $data[1] == 'Name' AND $data[2] == 'Mentions' AND $data[3] == 'Followers')
                                    {
                                        $valid = true;
                                        $cvs_format = 5;
                                    }
                                    else
                                    {
                                        throw new \DataException('Incorrect data format, please use CSV format');
                                    }
                                }
                                // save data
                                else
                                {
/*
                                    print_r($cvs_format);
                                    print_r($data);
                                    exit();
*/
                                    if($cvs_format == 1)
                                    {
                                        // skip the line of it is standard
                                        if(count($data) != 10)
                                            continue;

                                        $oTwitter = new \Utility\Twitter($this->aQuaryArray[2],$oConnections->ExternalConnectionID);
                                        $oTwitter->removeTweet($data[0]);
                                        $oTwitter->addTweet(
                                            array(
                                                'id' => $oConnections->ExternalConnectionID
                                            ),
                                            $data[0],
                                            substr($data[3],0,19),
                                            $data[4],
                                            $data[5],
                                            null,
                                            array(
                                                'user' => array(
                                                    'id' => $data[7]
                                                ),
                                                'id' => $data[6]
                                            ),
                                            $data[1],
                                            $data[2],
                                            array(),
                                            false
                                        );
                                    }
                                    elseif($cvs_format == 2)
                                    {
                                        $oTwitter = new \Utility\Twitter($this->aQuaryArray[2],$oConnections->ExternalConnectionID);
                                        $oTwitter->removeTweet($data[10]);
                                        $oTwitter->addTweet(
                                            array(
                                                'id' => $oConnections->ExternalConnectionID
                                            ),
                                            $data[10],
                                            substr(date("c",strtotime($data[7])),0,19),
                                            $data[3],
                                            $data[2],
                                            null,
                                            array(),
                                            null,
                                            null,
                                            array(),
                                            false
                                        );
                                    }
                                    elseif($cvs_format == 3)
                                    {
                                        \Utility\Twitter::updateHistoricalFollowers($oConnections->ExternalConnectionID,$data[1],$data[2]);
                                    }
                                    elseif($cvs_format == 4)
                                    {

                                        $oTwitter = new \Utility\Twitter($this->aQuaryArray[2],$oConnections->ExternalConnectionID);
                                        $oTwitter->removeTweet($data[4]);
                                        $oTwitter->addTweet(
                                            array(
                                                'id' => $data[1],
                                                'name' => $data[2],
                                                'id_is_screenname' => true
                                            ),
                                            $data[4],
                                            substr(date("c",strtotime($data[10])),0,19),
                                            $data[19],
                                            $data[3],
                                            null,
                                            array(
                                                'user' => null,
                                                'id' => $data[18]
                                            ),
                                            $data[17],
                                            null,
                                            array($oConnections->ExternalConnectionID), // user mentions
                                            false
                                        );
                                    }
                                    elseif($cvs_format == 5)
                                    {

                                        \Utility\Twitter::getUseridByScreenname($data[0],$data[3]);

                                    }
                                }
                            }
                            fclose($handle);
                        }
                        else
                        {
                            throw new \DataException('Can not open file for reading');
                        }
                    }
                    elseif($_FILES['twitter_cvs']['type'] == 'application/octet-stream')
                    {
                        if($content = file_get_contents($_FILES['twitter_cvs']['tmp_name']))
                        {
                            if(null === $data_array = json_decode($content,true))
                            {
                                throw new \DataException('bad json format');
                            }
                            else
                            {
                                if(isset($data_array['statuses']) and !empty($data_array['statuses']))
                                {
                                    foreach($data_array['statuses'] as $data)
                                    {
                                        $oTwitter = new \Utility\Twitter($this->aQuaryArray[2],$oConnections->ExternalConnectionID);
                                        $oTwitter->removeTweet($data['id']);
                                        $oTwitter->addTweet(
                                            $data['user'],
                                            $data['id'],
                                            date("Y-m-d H:i:s",strtotime($data['created_at'])),
                                            $data['source'],
                                            $data['text'],
                                            $data['lang'],
                                            $data['retweeted_status'],
                                            $data['in_reply_to_status_id'],
                                            $data['in_reply_to_user_id'],
                                            $data['entities']['user_mentions'],
                                            false
                                        );
                                    }
                                }
                                else
                                {
                                    throw new \DataException('Data format incorrect');
                                }
                            }
                        }
                        else
                        {
                            throw new \DataException('Can not open file for reading');
                        }
                    }
                    else
                    {
                        throw new \DataException('Unknown file type: "'.$_FILES['twitter_cvs']['type'].'"');
                    }
                }
                catch (\DataException $e)
                {
                    $this->aTplVars['import_msg'] = $e->getMessage();
                    return;
                }

                $this->aTplVars['import_msg'] = 'Data imported successfully';

            break;
        }

    }

    public function delpop()
    {
        $modelObj= new \Model\dashboard();
        $this->addSub('account_connections.tpl','content',$this->connections());
        $this->popSub('delete_Account.tpl','popups',$this->aTplVars);
    }

    public function delAc()
    {
        \Account::DeleteAccount($this->aQuaryArray[2]);
        \Utility\Url::phpRedirect('/dashboard/view/');
    }

    public function hideErr()
    {
        \Account::HideErrors($_POST['accountID']);       
    }


    public function pop()
    {
        if($oAccount = \Account::isMyAccount(\Utility\Client::getClientId(),$this->aQuaryArray[2]))
        {

            // save selected account id to session
            $_SESSION['accountID'] = $oAccount->AccountID;

            $oAccountConnections = \Connection::getAccountConnections($oAccount->AccountID);
            foreach($oAccountConnections as $oConnection){
                $this->aTplVars['oConnections'][$oConnection->Type] = $oConnection;
            }

            $this->aTplVars['accountID'] = $oAccount->AccountID;
            $this->aTplVars['fb_date_from'] = date("m/d/Y",strtotime("-1 month"));
            $this->aTplVars['fb_date_to'] = date("m/d/Y");
            $this->aTplVars['fb_app_id'] = FACEBOOK_APP_ID;
            //$this->addSub('account_connections.tpl','content',$this->aTplVars);

        }
        $priURl= $_SERVER['HTTP_REFERER'];        
        $arr=array();
        $arr=explode("/",$priURl);
        $modelObj= new \Model\dashboard();
        if($arr[3]=="dashboard")
        {
            $this->addSub('dashboard_view.tpl','content',$modelObj->viewForPopup($this->aQuaryArray[2]));
        }
        else
        {
            $this->addSub('account_connections.tpl','content',$modelObj->viewForPopup($this->aQuaryArray[2]));
        }
            $this->popSub('connection_add.tpl','popups',$this->aTplVars);  
    }

    public function importpage()
    {
        if($oAccount = \Account::isMyAccount(\Utility\Client::getClientId(),$this->aQuaryArray[2]))
        {

            // save selected account id to session
            $_SESSION['accountID'] = $oAccount->AccountID;

            $oAccountConnections = \Connection::getAccountConnections($oAccount->AccountID);
            foreach($oAccountConnections as $oConnection){
                $this->aTplVars['oConnections'][$oConnection->Type] = $oConnection;
            }

            $this->aTplVars['accountID'] = $oAccount->AccountID;
            $this->aTplVars['fb_date_from'] = date("m/d/Y",strtotime("-1 month"));
            $this->aTplVars['fb_date_to'] = date("m/d/Y");
            $this->aTplVars['fb_app_id'] = FACEBOOK_APP_ID;
        }
        $priURl= $_SERVER['HTTP_REFERER'];
        $arr=array();
        $arr=explode("/",$priURl);
        $modelObj= new \Model\dashboard();
        if($arr[3]=="dashboard")
        {
            $this->addSub('dashboard_view.tpl','content',$modelObj->viewForPopup($this->aQuaryArray[2]));
        }
        else
        {
            $this->addSub('account_connections.tpl','content',$modelObj->viewForPopup($this->aQuaryArray[2]));
        }
          
        $this->addSub('manage_account.tpl','popups',$this->aTplVars);  
    }

    public function add()
    {     
        if($oAccount = \Account::isMyAccount(\Utility\Client::getClientId(),$this->aQuaryArray[2]))
        {

            // save selected account id to session
            $_SESSION['accountID'] = $oAccount->AccountID;

            $oAccountConnections = \Connection::getAccountConnections($oAccount->AccountID);
            foreach($oAccountConnections as $oConnection){
                $this->aTplVars['oConnections'][$oConnection->Type] = $oConnection;
            }

            $this->aTplVars['accountID'] = $oAccount->AccountID;
            $this->aTplVars['fb_date_from'] = date("m/d/Y",strtotime("-1 month"));
            $this->aTplVars['fb_date_to'] = date("m/d/Y");
            $this->aTplVars['fb_app_id'] = FACEBOOK_APP_ID;
        }
        //
        //\Model\dashboard::view();
        $modelObj= new \Model\dashboard();
       // echo "Id in add fun. ".$this->aQuaryArray[2];        
        $this->addSub('dashboard_view.tpl','content',$modelObj->viewForPopup($this->aQuaryArray[2]));
        $this->popSub('account_add.tpl','popups',$this->aTplVars);
    }

    public function tstSes()
    {
        print_r(json_encode($_SESSION['Deatil']));
        exit;
    }

    public function connections()
    {
        // do we have a account(s)
        if($aAccounts = \Account::getClientAccounts(\Utility\Client::getClientId()))
        {
            if($oAccount = \Account::isMyAccount(\Utility\Client::getClientId(),$this->aQuaryArray[2]))
            {

                // save selected account id to session
                $_SESSION['accountID'] = $oAccount->AccountID;

                $oAccountConnections = \Connection::getAccountConnections($oAccount->AccountID);
                if(empty($oAccountConnections))
                {
                    $this->aTplVars['accountID'] = $oAccount->AccountID;
                    $this->aTplVars['fb_date_from'] = date("m/d/Y",strtotime("-1 month"));
                    $this->aTplVars['fb_date_to'] = date("m/d/Y");
                    $this->aTplVars['fb_app_id'] = FACEBOOK_APP_ID;                    
                    $this->aTplVars['account_error'] = 'Please connect to "Twitter live data stream" or "Load data from Facebook" to view your Dashbord and Generate Reports.';
                    $this->addSub('account_connections.tpl','content',$this->aTplVars);
                }
                else
                {
                    foreach($oAccountConnections as $oConnection)
                    {
                        $this->aTplVars['oConnections'][$oConnection->Type] = $oConnection;
                    }
                    $this->aTplVars['accountID'] = $oAccount->AccountID;
                    $this->aTplVars['fb_date_from'] = date("m/d/Y",strtotime("-1 month"));
                    $this->aTplVars['fb_date_to'] = date("m/d/Y");
                    $this->aTplVars['fb_app_id'] = FACEBOOK_APP_ID;
                    $this->addSub('account_connections.tpl','content',$this->aTplVars);
                }
                

            }
            else
            {
                \Utility\Url::phpRedirect('/account/connections/'.$aAccounts[0]->AccountID);
            }
        }
        else
        {
            \Utility\Url::phpRedirect('/account/add');
        }
    }
}