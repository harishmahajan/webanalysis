<?php
/**
 * Created by Indrek Päri
 * Date: 20.03.14 17:21
 */

//echo "Controler: APPLICATION - ".APPLICATION;
//define('APPLICATION', 'public');

//
require_once('application/'.APPLICATION.'/config.php');
//error_reporting( E_ALL );

class Controller{

    private $oModel;
    private $aQuery = array();
    private $aObjects = array(
        'dashboard' => array(
            'is_menu' => false,
            'name' => 'Dashboard',
            'actions' => array(
                'view',
                'connectionError'
            )
        ),
        'reports' => array(
            'is_menu' => true,
            'name' => 'Reports',
            'actions' => array(
                'view',
                'ReadFilePDF'
            )
        ),
        'connections' => array(
            'is_menu' => true,
            'name' => 'Connections',
            'actions' => array(
            )
        ),
        'account' => array(
            'is_menu' => true,
            'name' => 'Account Information',
            'actions' => array(
            )
        ),
        'log' => array(
            'is_menu' => false,
            'actions' => array(
                'in',
                'out'
            )
        ),
        'account' => array(
            'is_menu' => false,
            'actions' => array(
                'add',
                'pop',
                'importpage',
                'tstSes',
                'connections',
                'delpop',
                'delAc',
                'hideErr'
            )
        ),
        'ajax' => array(
            'is_menu' => false,
            'actions' => array(
                'fb_datain',
                'fb_con_insert',
                'fb_short_token',
            )
        ),
        'chart' => array(
            'is_menu' => false,
            'actions' => array(
                'RecentCommunityGrowth',
                'CommunityActivity',
                'Demographics',
                'Communitygrowth',
                'ActiveDemographics',
                'OrganicVsPaidLikes',
                'ReachBreakdown',
                'InternalFanSources',
            )
        ),
        'twitter' => array(
            'is_menu' => false,
            'actions' => array(
                'connect',
                'callback',
                'close',
                'test',
            )
        ),
        'twitterpop' => array(
            'is_menu' => false,
            'actions' => array(
                'Twitterpopup1',
                'TwConInsert',
                'close',
                'AccTok',
            )
        ),
    );

    public function __construct() {
        session_start();

        // we need everything up to first ? or &
        $aRequestUri = preg_split('/[?\&]+/', trim($_SERVER['REQUEST_URI'], '/'));

        // split to array
        $this->aQuery = explode('/', trim($aRequestUri[0], '/'));
        //echo $aRequestUri;
        //exit();
        // user is not logged in

        if(!\Utility\Client::isLoggedIn())
        {
            if( false == (
                ( $this->aQuery[0] == 'log' AND $this->aQuery[1] == 'in' ) OR
                ( $this->aQuery[0] == 'twitter' AND $this->aQuery[1] == 'callback' )
            )){

                \Utility\Url::phpRedirect('log/in/');
            }
        }
//
        // empty or incorrect
        if(empty($this->aQuery[0]) or array_key_exists($this->aQuery[0],$this->aObjects) == false)
        {
            $aKeys = array_keys($this->aObjects);
            \Utility\Url::phpRedirect($aKeys[0]);
        }
        if(empty($this->aQuery[1]) or in_array($this->aQuery[1],$this->aObjects[$this->aQuery[0]]['actions']) == false)
        {
            \Utility\Url::phpRedirect($this->aQuery[0].'/'.$this->aObjects[$this->aQuery[0]]['actions'][0]);
        }

        $sModelName = '\Model\\'.$this->aQuery[0];
        if(!class_exists($sModelName))
            exit('model "'.$sModelName.'" NOT FOUND!');

        $this->oModel = new $sModelName($this->aQuery);

        $sModelActionName = $this->aQuery[1];
        if(!method_exists($this->oModel, $sModelActionName))
            exit('method "'.$sModelActionName.'" NOT FOUND!');

        $this->oModel->$sModelActionName();

        $this->oModel->TemplateData['data']['isLoggedin'] = \Utility\Client::isLoggedIn();

        // logged in block at the top
        if(\Utility\Client::isLoggedIn())
        {

           
            $this->oModel->addSub('main_logged.tpl','logged',array('fullname'=>\Utility\Client::getFullName()));

            // accounts menu at the left
            if($aAccounts = \Account::getClientAccounts(\Utility\Client::getClientId()))
            {
                $this->oModel->addSub('main_leftmenu.tpl','leftmenu',
                    array(
                        'queryArray' => $this->aQuery,
                        'accounts' => $aAccounts,
                    )
                );
            }
        }
    }

    public function showWeb()
    {
        $aTplData = $this->mergeRecTplVars($this->oModel->TemplateData['data'], $this->oModel->TemplateData['subtemplates'],$this->oModel->TemplateData['poptemplates']);
        echo \Utility\SmartyTemplate::fetchTemplate($this->oModel->TemplateData['name'], $aTplData);
    }

    private function mergeRecTplVars($aVars=array(),$aSubVars=array(),$aSubVars2=array())
    {
        if(is_array($aSubVars))
        {
            foreach($aSubVars as $k => $aData)
            {
                if(isset($aData['subtemplates']) and is_array($aData['subtemplates']))
                {
                    $aData['data'] = $this->mergeRecTplVars($aData['data'], $aData['subtemplates']);
                }
                
                $aVars[$k] = \Utility\SmartyTemplate::fetchTemplate($aData['name'], $aData['data']);
            }
        }
        if(is_array($aSubVars2))
        {
            foreach($aSubVars2 as $k => $aData2)
            {
                if(isset($aData2['subtemplates']) and is_array($aData2['subtemplates']))
                {
                    $aData2['data'] = $this->mergeRecTplVars($aData2['data'], $aData2['subtemplates']);
                }
                
                $aVars[$k] = \Utility\SmartyTemplate::fetchTemplate($aData2['name'], $aData2['data']);
            }
        }
        return $aVars;
    }
}

$oController = new Controller();
$oController->showWeb();

