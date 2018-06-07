<?php
/**
 * Created by Archish Patel
 * Date: 14.10.22
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
$screenName=$_GET['s_name'];

require_once('application/'.APPLICATION.'/config.php');
require_once('library/REST_API/TwitterAPIExchange.php');
$cursor=\Utility\Db::query("select nxtCursor from Connection where ConnectionID= ? ",array($ValconnectionID));

$url = 'https://api.twitter.com/1.1/followers/list.json';
$getfield = "?count=200&screen_name=".$screenName."&cursor=".$cursor->nxtCursor;
//echo "cursor ".$cursor."<br>";
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();
$data=json_decode($response,true);


//echo "count ".count($data). PHP_EOL;
foreach ($data["users"] as  $value) {
   $dateTime = new DateTime($value['status']['created_at']);       
   $ValDate=$dateTime->format("Y-m-d H:i:s");
   echo "TweetID:".$value['status']['id'].PHP_EOL;
   $res=\Utility\Db::query("select 1 from DataTwFollower where TweetID = ? ",array($value['status']['id']));   
    if(empty($res))
    {
        echo "ID ".$value['id'] .PHP_EOL;
        echo "Next Coursor :".$data['next_cursor'].PHP_EOL;
            if(isset($value['status']))
            {
               echo 'Tweet' . PHP_EOL;              
                $oTwitter = new \Twitter(ACCOUNT_ID,USER_ID);  
                $oTwitter->addFollower(
                    $value['id'],
                    $value['name'],
                    $value['screen_name'],
                    $value['status']['text'],
                    $value['location'],
                    $value['followers_count'],
                    $value['friends_count'],
                    $value['listed_count'],
                    $value['favourites_count'],
                    $value['statuses_count'],
                    $value['lang'],
                    $value['status']['created_at'],
                    $value['status']['id']
                );
            }           
        }
        else
        {
                /*$oTwitter = new \Twitter(ACCOUNT_ID,USER_ID);  
                $oTwitter->updateTweet(
                    $value['status']['id'],
                    $value['status']['retweet_count'],
                    $value['status']['in_reply_to_status_id'],
                    $value['id'],
                    $value['followers_count'],
                    $value['friends_count'],
                    $value['listed_count'],
                    $value['statuses_count'],
                    $value['favourites_count']
                    );*/
        }
        
    }
    \Twitter::QueryAllFollower();
    \Utility\Db::query("update webanalysis.Connection set nxtCursor=? where ConnectionID=?",array($data['next_cursor'],$ValconnectionID));   
    
    
    