<?php
/**
 * Created by Indrek Päri
 * Date: 9.04.14 11:30
 */

namespace Utility;

require_once ('library/twitteroauth/twitteroauth/twitteroauth.php');

class MyTwitter  extends \TwitterOAuth{

    public function __construct($key, $secret, $oauth_token = NULL, $oauth_token_secret = NULL)
    {
        parent::__construct($key, $secret, $oauth_token, $oauth_token_secret);
    }

    public static function getStatusesMentionsTimeline(){

        $connection = new self(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $_SESSION['access_token']['oauth_token'], $_SESSION['access_token']['oauth_token_secret']);

        var_dump($_SESSION['access_token']);

        print_r($connection->get('statuses/mentions_timeline', array('count' => '200')));
        print_r($connection->get('followers/ids'));
        print_r($connection->get('account/verify_credentials'));

    }

    public static function Authorise($oauth_token, $oauth_verifier)
    {
        /* If the oauth_token is old redirect to the connect page. */
        if ($_SESSION['oauth_token'] !== $oauth_token) {
            $_SESSION['oauth_status'] = '';
            header('Location: /twitter/connect');
        }

        /* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
        $connection = new self(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

        /* Request access tokens from twitter */
        $access_token = $connection->getAccessToken($oauth_verifier);

        // save to db
        \Utility\Db::query("INSERT INTO `Connection` (`AccountID`, `ExternalConnectionID`, `Type`, `Name`, `ExternalConnectionData`,`FromDate`) VALUES (?, ?, 'twitter', ?, ?, NOW())",
            array(
                $_SESSION['accountID'],
                $access_token['user_id'],
                $access_token['screen_name'],
                json_encode(array('oauth_token'=>$access_token['oauth_token'],'oauth_token_secret'=>$access_token['oauth_token_secret']))
            )
        );

        /*
            [access_token] => Array
                (
                    [oauth_token] => 2344911166-9HTPHCus8S4SLOxEpwsckAuLPMrhaag9gUVH55x
                    [oauth_token_secret] => cgDUGQvCxbZ2NcFXhxPcAwXMplqTht355TEqxRf32uOLM
                    [user_id] => 2344911166
                    [screen_name] => IndrekPari
                )
        */

        /* Remove no longer needed request tokens */
        unset($_SESSION['oauth_token']);
        unset($_SESSION['oauth_token_secret']);

        /* If HTTP response is 200 continue otherwise send to connect page to retry */
        switch ($connection->http_code) {
            case 200:
                /* The user has been verified and the access tokens can be saved for future use */
                header('Location: /twitter/close');
                break;
            default:
                /* Show notification if something went wrong. */
                echo 'Could not connect to Twitter. Refresh the page or try again later.';
        }

        exit();

    }
    public static function Connect()
    {
        /* Build TwitterOAuth object with client credentials. */
        $connection = new self(TWITTER_CONSUMER_KEY,TWITTER_CONSUMER_SECRET);

        /* Get temporary credentials. */
        $request_token = $connection->getRequestToken(TWITTER_OAUTH_CALLBACK);

        /* Save temporary credentials to session. */
        if (isset($request_token['oauth_token'])) {
            $_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
        }
        if (isset( $request_token['oauth_token_secret'])) {
            $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
        }

        /* If last connection failed don't display authorization link. */
        switch ($connection->http_code) {
            case 200:
                /* Build authorize URL and redirect user to Twitter. */
                $url = $connection->getAuthorizeURL($token);
                header('Location: ' . $url);
                break;
            default:
                /* Show notification if something went wrong. */
                echo 'Could not connect to Twitter. Refresh the page or try again later.';
        }

        exit();

    }
    public static function getTwitterUserDetail()
    {

        exit;

        /* Build TwitterOAuth object with client credentials. */
        $connection = new self(TWITTER_CONSUMER_KEY,TWITTER_CONSUMER_SECRET);

        /* Get temporary credentials. */
        $request_token = $connection->getRequestToken();

        /* Save temporary credentials to session. */
        if (isset($request_token['oauth_token'])) {
            $_SESSION['oauth_token_pop'] = $token = $request_token['oauth_token'];
        }
        if (isset( $request_token['oauth_token_secret'])) {
            $_SESSION['oauth_token_secret_pop'] = $request_token['oauth_token_secret'];
        }

        /* If last connection failed don't display authorization link. */
        switch ($connection->http_code) {
            case 200:
                /* Build authorize URL and redirect user to Twitter. */
                $url = $connection->getAuthorizeURL($token);
                //header('Location: ' . $url);
                break;
            default:
                /* Show notification if something went wrong. */
                echo 'Could not connect to Twitter. Refresh the page or try again later.';
        }

        /* If the oauth_token is old redirect to the connect page. */
       

        /* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
        $connection = new self(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $_SESSION['oauth_token_pop'], $_SESSION['oauth_token_secret_pop']);

        /* Request access tokens from twitter */
        return $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

        

    }    

}