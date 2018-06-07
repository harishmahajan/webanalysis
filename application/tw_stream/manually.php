<?php
/**
 * Created by Indrek Päri
 * Date: 14.04.14 12:52
 */

parse_str(implode('&', array_slice($argv, 1)), $_GET);


$settings = array(
    'oauth_access_token' => "64609353-N7EerjoSjgpeJBfxW86KKCNuiOD3CQFdl6OmPDnNc",
    'oauth_access_token_secret' => "3fnsxc3PuPTkUibAIuAVimNdPyQzujZ6YP9we3HXZreda",
    'consumer_key' => "S2fiSzaWweR1nZH0tAEu5WtEd",
    'consumer_secret' => "iMH4pzz3UGxFOPoTW5UGwQAkXIllaZMB5lIt6eWAZjl39NlMqH"
);

define('ACCOUNT_ID', '142');
define('USER_ID', '43977597');
$ValconnectionID=$_GET['C_ID'];
define('APPLICATION', 'tw_stream');
chdir('/var/www/');
require_once('application/'.APPLICATION.'/config.php');
require_once('library/REST_API/TwitterAPIExchange.php');

$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
//$url = 'https://api.twitter.com/1.1/statuses/mentions_timeline.json';

//$getfield = '?count=200&screen_name=ProjectBionic&max_id=391296108145950720';
$getfield = '?count=200&screen_name=TacoTimeNW&max_id=542026973246001152';
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();
$data=json_decode($response,true);
//print_r($data);
//echo "count ".count($data). PHP_EOL;
$i=0;
foreach ($data as $value) 
{

    echo "Count[ ".$i." ]MAxID ".$value['id'].PHP_EOL;
    echo "Date ".$value['created_at'].PHP_EOL;
    echo "Twitter USER;: ".$value['user']['id'].PHP_EOL;
    $TWEETID=$value['id'];
    $TWEETID1.=$value['id'].",";
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
                $value['user']['favourites_count']
            );
            //$oTwitter->updateHistoricalFollowers($value['id'],$value['user']['followers_count']);
        }
        echo "*********************************".PHP_EOL;
    }
    $i++;
}
echo $TWEETID1.PHP_EOL;
\Twitter::QueryAllInsertTweets();
\Twitter::QueryAllUpdateTweets();

 /*foreach ($data as $value) 
 {
    //print_r($value);
    $res=\Utility\Db::query("select 1 from DataTwMentation where TwTweetID = ? ",array($value['id']));
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
        if(isset($value['id']))
        {
            echo 'Update Tweet' . PHP_EOL;
            echo "ID ".$value['id']." date ".$value['created_at']." followers_count ".$value['user']['followers_count']. PHP_EOL;
            
            $oTwitter = new \Twitter(ACCOUNT_ID,USER_ID);                
            //$oTwitter->test();
            $oTwitter->updateMentation($value['id'],$value['created_at'],$value['user']['followers_count'],$value['user']['id'],$value['in_reply_to_user_id'],$value['user']['location'],$value['user']['screen_name']);
        } 
    }
   
}

//\Twitter::QueryAllMentationInsert();
//\Twitter::QueryAllMentationUpdate();
*/
