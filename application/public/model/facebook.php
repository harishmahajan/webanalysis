<?php
/**
 * Created by Indrek Päri
 * Date: 9.04.14 11:14
 */
namespace Model;

class Facebook
{
    public function connect($sShorTermToken,$iConnectionID){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/oauth/access_token?grant_type=fb_exchange_token&client_id='.FACEBOOK_APP_ID.'&client_secret='.FACEBOOK_APP_SECRET.'&fb_exchange_token='.$sShorTermToken);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //to suppress the curl output
        $result = curl_exec($ch);
        curl_close ($ch);

        // access_token=CAAG4LFVANukBACVLCSDcRZBt4JyVq4iacP3XwdzVS1twbCvDEH2VyyzwwriYZC4wsGnfBQ8enlGG2AJhQ2zBvPMO2LjZBphFJG8FVJeLNiOHDin05ZBZCCXtDHGIwuqXEp9Lof7jdCGZAr3WVgaOnQTw7s6sbDaGQmuF0T6XX5KK01mzJ1bsk9qvk15YO9YKYZD&expires=5184000
        parse_str($result, $aOutput);
        if(isset($aOutput['access_token']))
        {
            file_put_contents('/var/www/application/public/log.txt',"[In if public function connect] connectionid: ". $iConnectionID." Data: ".$aOutput['access_token'].PHP_EOL,FILE_APPEND);
            \Connection::updateConnectionExtData($iConnectionID,$aOutput);            
        }
    }

    public function Conin($acid,$pgid,$shortTok)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/oauth/access_token?grant_type=fb_exchange_token&client_id='.FACEBOOK_APP_ID.'&client_secret='.FACEBOOK_APP_SECRET.'&fb_exchange_token='.$shortTok);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //to suppress the curl output
        $result = curl_exec($ch);
        curl_close ($ch);

        // access_token=CAAG4LFVANukBACVLCSDcRZBt4JyVq4iacP3XwdzVS1twbCvDEH2VyyzwwriYZC4wsGnfBQ8enlGG2AJhQ2zBvPMO2LjZBphFJG8FVJeLNiOHDin05ZBZCCXtDHGIwuqXEp9Lof7jdCGZAr3WVgaOnQTw7s6sbDaGQmuF0T6XX5KK01mzJ1bsk9qvk15YO9YKYZD&expires=5184000
        parse_str($result, $aOutput);
        echo \facebook::connectioninsert($acid,$pgid,$aOutput);
    }
}