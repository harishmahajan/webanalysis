<?php
require_once('../lib/Phirehose.php');
require_once('../lib/OauthPhirehose.php');

/**
 * Example of using Phirehose to display the 'sample' twitter stream.
 */
class SampleConsumer extends OauthPhirehose
{
  /**
   * Enqueue each status
   *
   * @param string $status
   */
  public function enqueueStatus($status)
  {
    /*
     * In this simple example, we will just display to STDOUT rather than enqueue.
     * NOTE: You should NOT be processing tweets at this point in a real application, instead they should be being
     *       enqueued and processed asyncronously from the collection process.
     */
    $data = json_decode($status, true);
    if (is_array($data) && isset($data['user']['screen_name'])) {
      print $data['user']['screen_name'] . ': ' . urldecode($data['text']) . "\n";
    }
  }
}

// The OAuth credentials you received when registering your app at Twitter
define('TWITTER_CONSUMER_KEY', 'MFUyovssPrr8LoOTZQzhJI1sr');
define('TWITTER_CONSUMER_SECRET', 'HzCInRKrnnHodpKfeQG7DmviBs0kUxWJTWCGIyXePlIVn2YC58');


// The OAuth data for the twitter account
define('OAUTH_TOKEN', '2344911166-z8XW5ja8PH5YTVsCBIBWivf3rZynosuoe3m52C7');
define('OAUTH_SECRET', 'oHNykjJz6ZPtrGo1J0NKcxWsdA8b5I7oVvT4vQrQD1Iix');

// Start streaming
$sc = new SampleConsumer(OAUTH_TOKEN, OAUTH_SECRET, Phirehose::METHOD_SAMPLE);
$sc->consume();
