<?php
/**
 * Created by Indrek Päri
 * Date: 9.04.14 11:14
 */

namespace Model;
error_reporting( E_ALL );
class Twitterpop
{
    private $aTplVars = array();

    public function TwConInsert()
    {
        echo \Utility\popuptwitter::InsertTwUserDetail($_POST['TwAccountID'],$_POST['TwUserID'],$_POST['TwScreenName'],$_POST['TwOauth_token'],$_POST['TwOauth_token_secret']);      
        exit();

    }

    public function Twitterpopup1(){
       \Utility\popuptwitter::getTwitterUserDetail();
    }

    public function AccTok()
    {
    	\Utility\popuptwitter::getTwitterUserAccTok();
    }

    public function close()
    {

        echo \Utility\SmartyTemplate::fetchTemplate('twitter_pop_close.tpl');
        exit();

    }

    

    
}