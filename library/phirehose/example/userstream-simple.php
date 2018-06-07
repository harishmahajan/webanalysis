<?php
date_default_timezone_set('America/Los_Angeles');
require_once('../lib/UserstreamPhirehose.php');

/**
 * Barebones example of using UserstreamPhirehose.
 */
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
    /*
     * In this simple example, we will just display to STDOUT rather than enqueue.
     * NOTE: You should NOT be processing tweets at this point in a real application, instead they
     *  should be being enqueued and processed asyncronously from the collection process. 
     */
    $data = json_decode($status, true);
    echo date("Y-m-d H:i:s (").strlen($status)."):".print_r($data,true)."\n";
  }

}

// The OAuth credentials you received when registering your app at Twitter
define('TWITTER_CONSUMER_KEY', 'MFUyovssPrr8LoOTZQzhJI1sr');
define('TWITTER_CONSUMER_SECRET', 'HzCInRKrnnHodpKfeQG7DmviBs0kUxWJTWCGIyXePlIVn2YC58');


// The OAuth data for the twitter account
define('OAUTH_TOKEN', '2344911166-z8XW5ja8PH5YTVsCBIBWivf3rZynosuoe3m52C7');
define('OAUTH_SECRET', 'oHNykjJz6ZPtrGo1J0NKcxWsdA8b5I7oVvT4vQrQD1Iix');

// Start streaming
$sc = new MyUserConsumer(OAUTH_TOKEN, OAUTH_SECRET);
$sc->consume();
