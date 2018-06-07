<?php
/**
 * Created by Indrek Päri
 * Date: 9.04.14 11:14
 */

namespace Model;

class Twitter
{
    private $aTplVars = array();
   

    public function connect(){
        \Utility\MyTwitter::Connect();
    }

    

    public static function callback()
    {

        \Utility\MyTwitter::Authorise($_REQUEST['oauth_token'],$_REQUEST['oauth_verifier']);

    }

    public static function close()
    {

        echo \Utility\SmartyTemplate::fetchTemplate('twitter_close.tpl');
        exit();

    }

}