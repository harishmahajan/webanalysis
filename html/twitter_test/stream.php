<?php
/**
 * Created by Indrek Päri
 * Date: 05/05/14 15:26
 */

define('TWITTER_CONSUMER_KEY', 'S2fiSzaWweR1nZH0tAEu5WtEd');
define('TWITTER_CONSUMER_SECRET', 'iMH4pzz3UGxFOPoTW5UGwQAkXIllaZMB5lIt6eWAZjl39NlMqH');

// indrek
define('OAUTH_TOKEN', '2344911166-08I7m7DxiMjnvCArS8rmHE0ZKcZWzezgsWtHsWc');
define('OAUTH_SECRET', 'VaJPsunCMqbYOypCgIGxhGdvTuTDTPgbTgX5RyXEXqt7K');

// jason
//define('OAUTH_TOKEN', '2478033740-JhsiVwR5g8lBn9byMnUOhuT7SJvS3jCXa4f1O9g');
//define('OAUTH_SECRET', '4G19sxmhD9HXXPr3fZnKc8C7DuSmo8pOnHyHDszn52t5R');

require_once('phirehose/lib/UserstreamPhirehose.php');

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
        }
        else if(isset($data['event']))
        {
            echo 'Event ' . $data['event'] . PHP_EOL;
        }
    }
}

// Start streaming
$sc = new MyUserConsumer(OAUTH_TOKEN, OAUTH_SECRET);
$sc->consume();

?>