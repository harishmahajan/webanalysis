<?php
/**
 * Created by Indrek Päri
 * Date: 20.03.14 17:21
 */

require_once('application/'.APPLICATION.'/config.php');

class Controller{

    private $oModel;
    private $aQuery = array();
    private $aObjects = array(
        'dashboard' => array(
            'is_menu' => true,
            'name' => 'Dashboard',
            'actions' => array(
                'view'
            )
        ),
        'reports' => array(
            'is_menu' => true,
            'name' => 'Reports',
            'actions' => array(
                'view'
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
                'connections'
            )
        ),
        'ajax' => array(
            'is_menu' => false,
            'actions' => array(
                'fb_datain',
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
    );

    public function __construct() {
        session_start();

        // we need everything up to first ? or &
        $aRequestUri = preg_split('/[?\&]+/', trim($_SERVER['REQUEST_URI'], '/'));

        // split to array
        $this->aQuery = explode('/', trim($aRequestUri[0], '/'));

        // user is not logged in
        if(!\Utility\Client::isLoggedIn())
        {
            if( false == (
                ( $this->aQuery[0] == 'log' AND $this->aQuery[1] == 'in' ) OR
                ( $this->aQuery[0] == 'twitter' AND $this->aQuery[1] == 'callback' )
            )){
                \Utility\Url::phpRedirect('/log/in/');
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
        $aTplData = $this->mergeRecTplVars($this->oModel->TemplateData['data'], $this->oModel->TemplateData['subtemplates']);
        echo \Utility\SmartyTemplate::fetchTemplate($this->oModel->TemplateData['name'], $aTplData);
    }

    private function mergeRecTplVars($aVars=array(),$aSubVars=array())
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
        return $aVars;
    }
}

$oController = new Controller();
$oController->showWeb();

