<?php
/**
 * Created by Indrek Päri
 * Date: 16/05/14 10:48
 */

require_once('application/'.APPLICATION.'/config.php');

class Controller{

    private $aoConnections;

    public function __construct()
    {

        $this->aoConnections = $this->getConnections();
        foreach($this->aoConnections as $oCon)
        {
            $oCon->ExternalConnectionData = json_decode($oCon->ExternalConnectionData);
            date_default_timezone_set("UTC");           
            //new code
            $this->loadFbData($oCon, date_timestamp_get(date_create(date("m/d/Y",strtotime("-89 days"))." 00:00:00")), date_timestamp_get(date_create(date("m/d/Y",strtotime("+1 days"))." 23:59:59")));

            //old code
            //$this->loadFbData($oCon, mktime(0, 0, 0, date("m"), date("d")-90, date("Y")), mktime(0, 0, 0, date("m"), date("d"), date("Y")));
/*
            if($oCon->ConnectionID == 77)
              $this->loadFbData($oCon, mktime(0, 0, 0, 2, 21, 2014), mktime(0, 0, 0, 2, 25, 2014));
*/
        }
        \Utility\Db::query("delete from DataFb_Posts where Post_link is null and Post_story_adds=0 and Post_impressions_unique =0 and Post_impressions =0 and Post_impressions_fan_unique =0 and Post_consumptions =0 and Post_engaged_users =0 and Post_like is null and Post_comment is null and Post_share is null");
        \Utility\Db::query("delete from DataFb_Posts where Post_link is null and Post_story_adds=0 Post_impressions_viral_unique=0 and Post_engaged_users =0 and Post_like is null and Post_comment is null and Post_share is null");
    }

    // IN example: 2014-01-20T06:19:24+0000
    // OUT example: 2014-01-19
    private function utc_datetime_to_pst_date($uts_datetime,$deduct_days = 0)
    {
        $split_one = explode('+', $uts_datetime);
        $split_two = explode('T', $split_one[0]);
        $aDate = explode('-', $split_two[0]);
        $aTime = explode(':', $split_two[1]);

        $utc_time = mktime($aTime[0],$aTime[1],$aTime[2],$aDate[1],$aDate[2],$aDate[0]);

        // deduct 8 hours to convert it to PST
        //to reduce day light saving problem we will deduct 9 hours
        $pst_time = ( $utc_time - ( 9 * 60 * 60 ) );

        // deduct if needed
        //$pst_time -= ( $deduct_days * 24 * 60 * 60 );

        return date("Y-m-d",$pst_time);
    }

    private function loadFbData($oCon, $from, $to)
    {

        $get_data = array(
            'access_token' => $oCon->ExternalConnectionData->access_token,
            'fields' => 'page_fan_adds',
            'period' => 'lifetime',
            'since' => $from,
            'until' => $to,
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v2.1/'.$oCon->ExternalConnectionID.'/insights/?'.http_build_query($get_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //to suppress the curl output
        $oResult = curl_exec($ch);
        curl_close ($ch);
        $oResult = json_decode($oResult);
        
        if(isset($oResult->error))
        {
            echo "error<br>";
            echo $oResult->error->message."<br>";
            echo $oResult->error->type."<br>";
            echo $oResult->error->code."<br>";
            $Errdate=date('Y-m-d');
            $res=\Utility\Db::query("select ErrorID from webanalysis.ConnectionError where ErrorCode=? and ConnectionID=? and Hide=0",array($oResult->error->code,$oCon->ConnectionID));
            if(empty($res))
                \Utility\Db::query("insert into webanalysis.ConnectionError(ErrorMessage,ErrorType,ErrorCode,ConnectionID,AccountID,Date,Site,Hide) values(?,?,?,?,?,?,?,?)",array($oResult->error->message,$oResult->error->type,$oResult->error->code,$oCon->ConnectionID,$oCon->AccountID, $Errdate,"facebook",0));
        }
        
        
        foreach($oResult->data as $oData)
        {
            if($oData->name == 'page_fans')
            {
                $data = array();
                foreach($oData->values as $oVal)
                {
                    //echo $oVal->end_time .' -> '.$this->utc_datetime_to_pst_date($oVal->end_time).':'.$oVal->value.PHP_EOL;
                    if($oVal->value == 0) continue;
                    $data[$this->utc_datetime_to_pst_date($oVal->end_time,1)] = $oVal->value;
                }
                $this->fb_save($oCon->AccountID, $oCon->ExternalConnectionID, $oData->name, $data);
            }
            elseif(in_array($oData->name,array('page_fans_city', 'page_fans_country', 'page_fans_gender_age')))
            {
                $data = array();
                foreach($oData->values as $oVal)
                {
                    if($oVal->value == 0) continue;
                    $data[$this->utc_datetime_to_pst_date($oVal->end_time)] = array();

                    foreach($oVal->value as $k => $v)
                    {
                        $data[$this->utc_datetime_to_pst_date($oVal->end_time)][$k] = $v;
                    }
                }
                $this->fb_save($oCon->AccountID, $oCon->ExternalConnectionID, $oData->name, $data);
            }
        }

  

        $get_data = array(
            'access_token' => $oCon->ExternalConnectionData->access_token,
            'fields' => 'page_fan_adds',
            'period' => 'day',
            'since' => $from,
            'until' => $to,
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v2.1/'.$oCon->ExternalConnectionID.'/insights/?'.http_build_query($get_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //to suppress the curl output
        $oResult = curl_exec($ch);
        curl_close ($ch);
        $oResult = json_decode($oResult);

        $data = array();
        foreach($oResult->data as $oData)
        {
            if(in_array($oData->name,array('page_storytellers', 'page_impressions_unique', 'page_impressions', 'page_engaged_users', 'page_fans_online_per_day', 'page_impressions_paid', 'page_impressions_organic', 'page_fan_removes', 'page_fan_adds_unique', 'page_consumptions')))
            {
                foreach($oData->values as $oVal)
                {
                    if($oVal->value == 0) continue;
                    $data[$oData->name][$this->utc_datetime_to_pst_date($oVal->end_time)] = $oVal->value;
                }
            }

            if($oData->name == 'page_positive_feedback_by_type')
            {
                $data['page_comment'] = array();
                $data['page_like'] = array();
                $data['page_link'] = array();

                foreach($oData->values as $oVal)
                {
                    $data['page_comment'][$this->utc_datetime_to_pst_date($oVal->end_time)] = $oVal->value->comment;
                    $data['page_like'][$this->utc_datetime_to_pst_date($oVal->end_time)] = $oVal->value->like;
                    $data['page_link'][$this->utc_datetime_to_pst_date($oVal->end_time)] = $oVal->value->link;
                }
            }

            if(in_array($oData->name,array('page_fans_by_like_source', 'page_storytellers_by_age_gender', 'page_views_external_referrals')))
            {
                $sdata = array();
                foreach($oData->values as $oVal)
                {
                    if(empty($oVal->value)) continue;
                    $sdata[$this->utc_datetime_to_pst_date($oVal->end_time,1)] = array();

                    foreach($oVal->value as $k => $v)
                    {
                        $sdata[$this->utc_datetime_to_pst_date($oVal->end_time,1)][$k] = $v;
                    }
                }
                $this->fb_save($oCon->AccountID, $oCon->ExternalConnectionID, $oData->name, $sdata);
            }

        }

        $this->fb_save($oCon->AccountID, $oCon->ExternalConnectionID, 'DataFb', $data);
        $get_data = array(
            'access_token' => $oCon->ExternalConnectionData->access_token,
            'period' => 'day',
            'limit' => '200',
            'since' => $from,
            'until' => $to,
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v2.1/'.$oCon->ExternalConnectionID.'/posts/?'.http_build_query($get_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //to suppress the curl output
        $oResult = curl_exec($ch);
        curl_close ($ch);
        $oResult = json_decode($oResult);
        foreach($oResult->data as $oData)
        {
            //if($oData->type == 'status') continue;

            if(!isset($oData->message)) $oData->message = $oData->story;

            $get_data = array(
                'access_token' => $oCon->ExternalConnectionData->access_token,
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v2.1/'.$oData->id.'/insights/?'.http_build_query($get_data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //to suppress the curl output
            $oResult2 = curl_exec($ch);
            curl_close ($ch);
            $oResult2 = json_decode($oResult2);

            $dataset = array(
                'id' => $oData->id,
                'day' => $this->utc_datetime_to_pst_date($oData->created_time),
                'link' => $oData->link,
                'message' => substr($oData->message,0,50)
            );

//          print_r($oResult2->data);

            foreach($oResult2->data as $oElm){

                if(in_array($oElm->name,array('post_story_adds','post_consumptions','post_impressions_unique','post_impressions_fan_unique','post_impressions','post_impressions_viral_unique','post_engaged_users','post_stories_by_action_type')))
                {
                    if($oElm->values!="")
                        $dataset[$oElm->name] = $oElm->values[0]->value;
                }
            }

            $this->fb_save($oCon->AccountID, $oCon->ExternalConnectionID, 'DataFb_Posts', $dataset);
        }

    }

    private function fb_save($iAccountID, $iPageID, $sAction, $aData){

        echo date("YmdHis").' SAVE: '.$iAccountID.'_'.$iPageID.'_'.$sAction.' COUNT:'.count($aData).PHP_EOL;

        if(empty($aData)) return;

        $oFb = new \Facebook($iAccountID, $iPageID);

        switch($sAction){
            case 'DataFb':

                $oFb->update_DataFb($aData);

                break;
            case 'DataFb_Posts':

                $oFb->update_DataFb_Posts($aData);

                break;
            case 'page_fans':
            case 'page_fans_city':
            case 'page_fans_country':
            case 'page_fans_gender_age':
            case 'page_views_external_referrals':
            case 'page_fans_by_like_source':
            case 'page_storytellers_by_age_gender':

                $request = 'update_'.$sAction;
                $oFb->$request($aData);

                break;
            default:

                print_r($_POST);
                break;
        }

        $oFb->updateminMax();

    }


    private function getConnections()
    {
        return \Utility\Db::query("select ConnectionID, AccountID, ExternalConnectionID, ExternalConnectionData from Connection where Type = 'facebook' and  ExternalConnectionData is not null and IsActive=1",array(),true);
    }

}

$oController = new Controller();