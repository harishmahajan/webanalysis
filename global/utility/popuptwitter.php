<?php
/**
 * Created by Indrek Päri
 * Date: 9.04.14 11:30
 */

namespace Utility;

require_once ('library/twitteroauth/twitteroauth/twitteroauth.php');
error_reporting( E_ALL );
class popuptwitter  extends \TwitterOAuth{   

    public function getTwitterUserAccTok()
    {
        /* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
        $connection1 = new self(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $_SESSION['oauth_token_pop'], $_SESSION['oauth_token_secret_pop']);

        /* Request access tokens from twitter */
        $O_verifier=$_REQUEST['oauth_verifier'];
        $access_token = $connection1->getAccessToken($O_verifier);
        //header('Location: /twitterpop/close');  
        //$smarty->assign($access_token);      
        $_SESSION['Deatil']=$access_token;
        //$smarty->assign('Deatil',"123");

        switch ($connection1->http_code) {
            case 200:
                /* The user has been verified and the access tokens can be saved for future use */
                header('Location: /twitterpop/close');
                break;
            default:
                /* Show notification if something went wrong. */
                echo 'Some problem has occured ! close/refresh page and try again.';
        }

        exit;

    }

    public function InsertTwUserDetail($TwAccountID,$TwUserID,$TwScreenName,$TwOauth_token,$TwOauth_token_secret)
    {
        /*$a=\Utility\Db::query("select 1 from webanalysis.Connection where ExternalConnectionID=?",array($TwUserID));
        echo $TwUserID;*/

        if( \Utility\Db::query("select 1 from webanalysis.Connection where ExternalConnectionID=?",array($TwUserID)))
        {
            echo "false";
        }
        else
        {
            \Utility\Db::query("INSERT INTO `Connection` (`AccountID`, `ExternalConnectionID`, `Type`, `Name`, `ExternalConnectionData`,`FromDate`) VALUES (?, ?, 'twitter', ?, ?, NOW())",
            array(
                $TwAccountID,
                $TwUserID,
                $TwScreenName,
                json_encode(array('oauth_token'=>$TwOauth_token,'oauth_token_secret'=>$TwOauth_token_secret))
            ));
            echo "true";
        }
    }
    
    public function getTwitterUserDetail()
    {
        unset($_SESSION['Deatil']);
        unset($_SESSION['oauth_token_pop']);
        unset($_SESSION['oauth_token_secret_pop']);
       
        /* Build TwitterOAuth object with client credentials. */
        $connection = new self(TWITTER_CONSUMER_KEY,TWITTER_CONSUMER_SECRET);

        /* Get temporary credentials. */
        $request_token = $connection->getRequestToken("http://webanalysis.co/twitterpop/AccTok");

        /* Save temporary credentials to session. */
        if (isset($request_token['oauth_token'])) {
            $_SESSION['oauth_token_pop'] = $token = $request_token['oauth_token'];
            //$oauth_token_pop = $token = $request_token['oauth_token'];
        }
        if (isset( $request_token['oauth_token_secret'])) {
            $_SESSION['oauth_token_secret_pop'] = $request_token['oauth_token_secret'];
            //$oauth_token_secret_pop= $request_token['oauth_token_secret'];
        }
        
        /* If last connection failed don't display authorization link. */
        switch ($connection->http_code) {
            case 200:
                /* Build authorize URL and redirect user to Twitter. */
                $url = $connection->getAuthorizeURL($token);
                header('Location: ' . $url);
                  exit;
                break;
            default:
                /* Show notification if something went wrong. */
                echo 'Could not connect to Twitter. Refresh the page or try again later.';
        }
        exit;

                

    }    

}