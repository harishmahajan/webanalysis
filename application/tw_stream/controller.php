<?php
/**
 * Created by Indrek Päri
 * Date: 14.04.14 12:52
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

$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

$getfield = '?count=200&screen_name='.$_GET['s_name'];
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();
$data=json_decode($response,true);
if(!empty($data['errors']))
{
    echo $data['errors'][0]['code']."<br>";
    echo $data['errors'][0]['message'];
    $Errdate=date('Y-m-d');
    $res=\Utility\Db::query("select ErrorID from webanalysis.ConnectionError where ErrorCode=? and ConnectionID=? and Hide=0",array($data['errors'][0]['code'],$ValconnectionID));
    if(empty($res))
        \Utility\Db::query("insert into webanalysis.ConnectionError(ErrorMessage,ErrorCode,ConnectionID,AccountID,Date,Site,Hide) values(?,?,?,?,?,?,?)",array($data['errors'][0]['message'],$data['errors'][0]['code'],$ValconnectionID,ACCOUNT_ID, $Errdate,"twitter",0));
}
//print_r($data);
//echo "count ".count($data). PHP_EOL;
foreach ($data as $value) 
{
    $TWEETID=$value['id'];
    $res=\Utility\Db::query("select 1 from webanalysis.DataTwTweet where TwTweetID ='".$TWEETID."'" ,array());
    //$res=\Utility\Db::query("select 1 from DataTwTweet where TwTweetID = ?",array());
    //\Utility\Db::closeConnection();
    if(empty($res))
    {
        echo "888888888888888888888".PHP_EOL;
        echo "ID ".$value['id'] .PHP_EOL;
        if(isset($value['id']))
        {
            echo 'Tweet' . PHP_EOL;
            $oTwitter = new \Twitter(ACCOUNT_ID,USER_ID);
            $oTwitter->addTweet(                    
                $value['id'],
                $value['created_at'],
                $value['source'],
                $value['text'],
                $value['lang'],
                $value['retweet_count'],
                $value['favorite_count'],
                $value['user']
            );
        }
        echo "+++++++++++++++++++++".PHP_EOL;
    }
    else
    {
        echo "99999999999999999999999".PHP_EOL;
        if(isset($value['id']))
        {
            echo 'upTweet' . PHP_EOL;
            echo "ID ".$value['id'] .PHP_EOL;
            $oTwitter = new \Twitter(ACCOUNT_ID,USER_ID);
            $oTwitter->updateTweet(
                $value['id'],
                $value['favorite_count'],
                $value['retweet_count'],                
                $value['user']['id'],
                $value['user']['followers_count'],
                $value['user']['friends_count'],
                $value['user']['listed_count'],
                $value['user']['statuses_count'],
                $value['user']['favourites_count'],
                $value['user']
            );
            $oTwitter->updateHistoricalFollowers($value['user']['id'],$value['user']['followers_count']);
        }
        echo "*********************************".PHP_EOL;
    }
}

\Twitter::QueryAllInsertTweets();
\Twitter::QueryAllUpdateTweets();

