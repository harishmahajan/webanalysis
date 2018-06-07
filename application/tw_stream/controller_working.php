<?php
/**
 * Created by Indrek Päri
 * Date: 14.04.14 12:52
 */

parse_str(implode('&', array_slice($argv, 1)), $_GET);

define('OAUTH_TOKEN', $_GET['tw_token']);
define('OAUTH_SECRET', $_GET['tw_secret']);
define('ACCOUNT_ID', $_GET['account_id']);
define('USER_ID', $_GET['user_id']);

require_once('application/'.APPLICATION.'/config.php');
require_once('library/phirehose/lib/UserstreamPhirehose.php');

class MyUserConsumer extends UserstreamPhirehose
{
    /**
     * First response looks like this:
     *    $data=array('friends'=>array(123,2334,9876));
     *
     * Each tweet of your friends looks like:
     *   [id] => 1011234124121
     *   [text] =>  (the tweet)
     *   [user] => array( the user who tweeted )
     *   [entities] => array ( urls, etc. )
     *
     * Every 30 seconds we get the keep-alive message, where $status is empty.
     *
     * When the user adds a friend we get one of these:
     *    [event] => follow
     *    [source] => Array(   my user   )
     *    [created_at] => Tue May 24 13:02:25 +0000 2011
     *    [target] => Array  (the user now being followed)
     *
     * @param string $status
     */

    public function enqueueStatus($status)
    {
        $data = json_decode($status, true);
        echo date("Y-m-d H:i:s (").strlen($status)."):".print_r($data,true)."\n";

        //if tweet or retweet or reply
        if(isset($data['id']))
        {
            echo 'Tweet' . PHP_EOL;

            $oTwitter = new \Twitter(ACCOUNT_ID,USER_ID);
            $oTwitter->addTweet(
                $data['user'],
                $data['id'],
                date("Y-m-d H:i:s"),
                $data['source'],
                $data['text'],
                $data['lang'],
                $data['retweeted_status'],
                $data['in_reply_to_status_id'],
                $data['in_reply_to_user_id'],
                $data['entities']['user_mentions']
            );
        }
        else if(isset($data['event']))
        {
            echo 'Event ' . $data['event'] . PHP_EOL;

            $oTwitter = new \Twitter(ACCOUNT_ID,USER_ID);
            $oTwitter->addEvent($data['event'], date("Y-m-d H:i:s"), $data['source'], $data['target']);

        }
    }
}

// Start streaming
$sc = new MyUserConsumer(OAUTH_TOKEN, OAUTH_SECRET);
$sc->consume();

