#!/usr/bin/php
<?php

define('APPLICATION', 'tw_stream');
chdir('/var/www/');
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('application/'.APPLICATION.'/config.php');
class Pro
{
    public function __construct(){
             $this->spawn_processors();
        }
    private function spawn_processor($oConnection) 
    {

        $qs = 'account_id='.$oConnection->AccountID;
        $qs .= ' user_id='.$oConnection->ExternalConnectionID;
        $qs .= ' s_name='.$oConnection->Name;
        $qs .= ' C_ID='.$oConnection->ConnectionID;
        //{"oauth_token":"64453378-hNbPJw82DT398QkWl6O9y5wx5LSj5Nc405AqR27TW","oauth_token_secret":"HmwFSZuteQleM2iMHUNMGzvTtCAkHRSEBabewjdor5uIg"}
        $oExtdata = json_decode($oConnection->ExternalConnectionData);

        $qs .= ' tw_token='.$oExtdata->oauth_token;
        $qs .= ' tw_secret='.$oExtdata->oauth_token_secret;

        $op = new ComExe('/usr/bin/php /var/www/application/tw_stream/run_tw_Follow.php '.$qs, $oConnection->ConnectionID);
        $this->processors[] = $op;
    }

    public function spawn_processors() {
        if(!empty($this->processors))
        {
            $this->kill_processors();
        }
        $this->processors = array();

        $aoConnections = \Utility\Db::query("select ConnectionID, AccountID, Name,ExternalConnectionID, ExternalConnectionData FROM webanalysis.Connection where Type = 'Twitter' and nxtCursor != 0 group by ExternalConnectionID order by ConnectionID limit 1",array(),true);
        //$aoConnections = \Utility\Db::query("select ConnectionID, AccountID, Name,ExternalConnectionID, ExternalConnectionData FROM webanalysis.Connection where ConnectionID=82 and nxtCursor != 0",array(),true);
        if( count($aoConnections)==0)
        {
            \Utility\Db::query("update webanalysis.Connection set nxtCursor='-1'",array(),true);
            $aoConnections = \Utility\Db::query("select ConnectionID, AccountID, Name,ExternalConnectionID, ExternalConnectionData FROM webanalysis.Connection where Type = 'Twitter' and nxtCursor != 0 group by ExternalConnectionID order by ConnectionID limit 1",array(),true);
        }
        \Utility\Db::closeConnection();
        foreach($aoConnections as $oConnection)
        {
            $this->spawn_processor($oConnection);
        }
    }
}

class ComExe
{        
    private $pid;
    private $cid;
    private $command;

    public function __construct($cl=false,$cid = 0){
       
        $this->cid = $cid;
        if ($cl != false){
            $this->command = $cl;
            $this->runCom();
        }
    }
    private function runCom(){
        $cm = $this->command.' > /var/www/application/tw_stream/tw_Follow_log/run_tw_Follow.'.$this->cid.'.log 2>&1 & echo $! ';
        exec($cm,$op);   
    }
}
$objPro= new Pro();