<?php
/**
 * Created by Archish Patel
 * Date: 14.10.16 
 *
 * we will calculate potential reach and potantial impression.
 */

parse_str(implode('&', array_slice($argv, 1)), $_GET);
$settings = array(
    'oauth_access_token' => $_GET['tw_token'],
    'oauth_access_token_secret' => $_GET['tw_secret'],
    'consumer_key' => "S2fiSzaWweR1nZH0tAEu5WtEd",
    'consumer_secret' => "iMH4pzz3UGxFOPoTW5UGwQAkXIllaZMB5lIt6eWAZjl39NlMqH"
);
define('ACCOUNT_ID', $_GET['account_id']);
define('USER_ID', $_GET['user_id']);
$ValconnectionID=$_GET['C_ID'];

require_once('application/'.APPLICATION.'/config.php');
require_once('library/REST_API/TwitterAPIExchange.php');

$url = 'https://api.twitter.com/1.1/statuses/mentions_timeline.json';

$getfield = '?count=200&screen_name='.$_GET['s_name'];
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();
$data=json_decode($response,true);
//print_r($data);
//echo "count ".count($data). PHP_EOL;
 foreach ($data as $value) 
 {
    //print_r($value);
    $res=\Utility\Db::query("select 1 from DataTwMentation where TwTweetID = ? ",array($value['id']));
    echo "on if".PHP_EOL;
    if(empty($res))
    {
        echo "ID ".$value['id'] .PHP_EOL;
        if(isset($value['id']))
        {
            echo 'Tweet' . PHP_EOL;
            echo "ID ".$value['id']." date ".$value['created_at']." followers_count ".$value['user']['followers_count']. PHP_EOL;
            
            $oTwitter = new \Twitter(ACCOUNT_ID,USER_ID);                
            //$oTwitter->test();
            $oTwitter->addMentation($value['id'],$value['created_at'],$value['user']['followers_count'],$value['user']['id'],$value['in_reply_to_user_id'],$value['user']['location'],$value['user']['screen_name']);
        }            
    }
    else
    {
        /*if(isset($value['id']))
        {
            echo 'Update Tweet' . PHP_EOL;
            echo "ID ".$value['id']." date ".$value['created_at']." followers_count ".$value['user']['followers_count']. PHP_EOL;
            
            $oTwitter = new \Twitter(ACCOUNT_ID,USER_ID);                
            //$oTwitter->test();
            $oTwitter->updateMentation($value['id'],$value['created_at'],$value['user']['followers_count'],$value['user']['id'],$value['in_reply_to_user_id'],$value['user']['location'],$value['user']['screen_name']);
        } */
    }
   
}

\Twitter::QueryAllMentationInsert();    