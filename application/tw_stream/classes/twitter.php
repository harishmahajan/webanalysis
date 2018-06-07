<?php

/**
 * Created by Indrek Päri
 * Date: 28.03.14 14:16
*/
error_reporting(E_ALL);
ini_set('display_errors', 1);
class Twitter{

    private $iAccountId;
    private $iConnectionId;
    private static $BulkAddUpdateTweet,$BulkAddInsertTweet,$BulkTweetID,$BulkAddUpdateDataTwUser,$BulkDataTwUserId;
    private static $bulkAddUpdatehistory,$bulkAddInserthistory,$BulkHistoryID;
    private static $BulkupdateHistoricalFollowers;
    private static $BulkAddUpdateFollower;
    private static $_retweet,$_fev,$BulkAddUpdateMentation,$BulkMentationID,$BulkAddInsertMentation;
    

    public function __construct($iAccountId, $TW_UserID)
    {
        echo "In construction account id: ".$iAccountId." ,user id: ".$TW_UserID .PHP_EOL;
        $this->iAccountId = $iAccountId;

        // select facebook connection
        if($oConnection = \Utility\Db::query("select ConnectionID from Connection where AccountID = ? and ExternalConnectionID = ? and type='twitter'",array($this->iAccountId, $TW_UserID)))
        {
            $this->iConnectionId = $oConnection->ConnectionID;
        }
        else
        {
            \Utility\Db::query("INSERT INTO `Connection` (`AccountID`, `ExternalConnectionID`, `Type`) VALUES (?, ?, 'twitter')",array($this->iAccountId, $TW_UserID));
            $this->iConnectionId = \Utility\Db::last_insert_id();
        }
        echo "In construction connection id: ".$this->iConnectionId .PHP_EOL;
    }

    public function QueryAllInsertTweets()
    {
        if(!empty(self::$BulkAddInsertTweet))
        {
            \Utility\Db::CronQuery("INSERT INTO `DataTwTweet` (`ConnectionID`, `DataTwUserID`, `TwTweetID`, `CreatedAt`, `Source`, `Tweet`, `Lang`,`Retweet`,`Favorite`) VALUES ".substr(self::$BulkAddInsertTweet, 0, -1));            
        }
        
        self::$BulkAddInsertTweet="";
    }

    public function QueryAllUpdateTweets()
    {
        //Update Query For DataTwTweet table
        if(!empty(self::$_retweet) && !empty(self::$_fev))
            \Utility\Db::CronQuery("update webanalysis.DataTwTweet set Retweet= (case TwTweetID ". self::$_retweet ." end),Favorite= (case TwTweetID ". self::$_fev ." end) where TwTweetID in(".substr(self::$BulkTweetID, 0, -1).")");        
        self::$_retweet=self::$_fev=self::$BulkTweetID="";
        
        //update query for DataTwUser
        if(!empty($BulkAddUpdateDataTwUser))
        {
            \Utility\Db::CronQuery("update webanalysis.DataTwUser set".substr(self::$BulkAddUpdateDataTwUser, 0, -1)." where TwTweetID in(".substr(self::$BulkDataTwUserId, 0, -1).")");
        }
        self::$BulkDataTwUserId=self::$BulkAddUpdateDataTwUser="";

    }

    public function QueryAllFollower()
    {
    }
    public function addFollower($Fid,$Fname,$Fscreen_name,$Ftext,$Flocation,$Ffollowers_count,$Ffriends_count,$Flisted_count,$Ffavourites_count,$Fstatuses_count,$Flang,$Fcreated_at,$FTweetID)
    {
    }
    
    public function QueryAllMentationInsert()
    {
        if(!empty(self::$BulkAddInsertMentation))
        {
            \Utility\Db::CronQuery("INSERT INTO `webanalysis`.`DataTwMentation` (`ConnectionID`, `CreatedAt`, `TwTweetID`,  `ReachCount`,`FollowersCount`,`TwUserID`,`IsMention`,`IsReplie`,`Location`,ScreenName) VALUES".substr(self::$BulkAddInsertMentation, 0, -1));
        }
        self::$BulkAddInsertMentation="";
    }

    public function QueryAllMentationUpdate()
    {
    }
  
    public function addMentation($Mid,$Mdate,$Mcount,$userID,$in_reply_to_user_id,$loaction,$screenName)
    {
        if(isset($in_reply_to_user_id))
        {
            $IsReply=1;
            $IsMention=0;
        }
        else
        {
            $IsMention=1;
            $IsReply=0;
        }
        
        $NewMcount=$Mcount+1;

        $dateTime = new DateTime($Mdate); 
        $dateTime->modify('-8 hours');      
        $newDate=$dateTime->format("Y-m-d H:i:s");

        $MfolloCount= \Utility\Db::query("select FollowersCount from webanalysis.DataTwUser where TwUserID= (select ExternalConnectionID from webanalysis.Connection where ConnectionID=?)",array($this->iConnectionId));                        
        self::$BulkAddInsertMentation.="(".$this->iConnectionId.", '".$newDate."', '".$Mid."', ".$Mcount.",".$MfolloCount->FollowersCount.",".$userID.",".$IsMention.",".$IsReply.",'".str_replace("'","",$loaction)."','".str_replace("'","",$screenName)."'),";        
    }

    public function updateMentation($Mid,$Mdate,$Mcount,$userID,$in_reply_to_user_id,$loaction,$screenName)
    {      
       
    }
   

    public function updateTweet($id,$FevCount,$recount,$twUserid,$followercount,$friendfcount,$listedcount,$statuscount,$favouritescounts,$all=array())
    {
        $iUserId = $this->getUserId($all);
        echo "In updateTweet:".PHP_EOL;
        if(isset($recount))
            self::$_retweet.=" when '".$id."' then ".$recount." ";
        if(isset($FevCount))
            self::$_fev.=" when '".$id."' then ".$FevCount." ";        
        self::$BulkTweetID.="'".$id."',";
        if(isset($twUserid))
        {
            self::$BulkAddUpdateDataTwUser.=" FollowersCount = (case TwUserID when $twUserid then $followercount end), FriendsCount = (case TwUserID when $twUserid then $friendfcount end), ListedCount =  (case TwUserID when $twUserid then $listedcount end), FavouritesCount =  (case TwUserID when $twUserid then $favouritescounts end), StatusesCount = (case TwUserID when $twUserid then $statuscount end),";
            self::$BulkDataTwUserId.="$twUserid,";
        }
        echo "ffffffffffffffffffffff:".PHP_EOL;
    }

    public function addTweet($sId, $sDate, $sSource, $sText, $sLang,$Recount,$FevCount,$all=array())
    {
        echo "In addTweet:".PHP_EOL;
        if(empty($FevCount))
            $FevCount=0;
        if(empty($Recount))
            $Recount=0;

        $dateTime = new DateTime($sDate); 
        $dateTime->modify('-8 hours');      
        $newDate=$dateTime->format("Y-m-d H:i:s");

        $iUserId = $this->getUserId($all);
        if(!empty($sId))
        self::$BulkAddInsertTweet.=" (".$this->iConnectionId.", ".$iUserId.", '".$sId."', '".$newDate."', '".str_replace("'","",$sSource)."', '".str_replace("'","",$sText)."', '".str_replace("'","",$sLang)."',".$Recount.",".$FevCount."),";       
        
        echo "eeeeeeeeeeeeeeeeeeeee:".PHP_EOL;
    }

    public function addEvent($sEvent, $sDateTime, $aSource, $aTarget)
    {

        $newDateTime=date('Y-d-m h:m:s',strtotime($sDateTime));
        $iUserId = $this->getUserId($aUser);

        $iSourceUserId = $this->getUserId($aSource);
        $iTargetUserId = $this->getUserId($aTarget);

        \Utility\Db::query("INSERT INTO `DataTwEvent` (`DataTwEventID`, `ConnectionID`, `Event`, `CreatedAt`, `SourceUserID`, `TargetUserID`)
            VALUES (
                null, ?, ?, ?, ?, ?
            )",
            array(
                $this->iConnectionId, $sEvent, $newDateTime, $iSourceUserId, $iTargetUserId
            )
        );

    }

    public static function updateHistoricalFollowers($iTwitterId, $iFollowers)
    {
        $iUserID = self::getUserId(array('id'=>$iTwitterId));       
        $sData=date('Y-m-d');       
        echo "UserID: ".$iUserID.PHP_EOL;
        if( \Utility\Db::query("select 1 from DataTwUser_followers_history where DataTwUserID = ? and `Date` = ?", array($iUserID,$sData)) )
        {
            echo "IN IF updateHistoricalFollowers".PHP_EOL;
            \Utility\Db::query("Update DataTwUser_followers_history set FollowersCount = ? where DataTwUserID = ? and `Date` = ?", array($iFollowers,$iUserID,$sData));
        }
        else
        {
            echo "IN else updateHistoricalFollowers".PHP_EOL;
            \Utility\Db::query("INSERT INTO `DataTwUser_followers_history` (`DataTwUserID`, `FollowersCount`, `Date`) VALUES (?, ?, ?)", array($iUserID,$iFollowers,$sData));
        }

    }

    private function getUserId($all){
        /*echo "*9*9*9*9*9*9*9*9*9*9*".PHP_EOL;
        print_r($all);*/
        if($oUser = \Utility\Db::query("select DataTwUserID from DataTwUser where TwUserID = ? limit 1",array($all['id'])))
        {
            if(isset($all['followers_count']))
            {
                \Utility\Db::query("UPDATE DataTwUser set FollowersCount = ?, FriendsCount = ?, ListedCount = ?, FavouritesCount = ?, StatusesCount = ? where DataTwUserID = ? limit 1",array(
                    $all['followers_count'],
                    $all['friends_count'],
                    $all['listed_count'],
                    $all['favourites_count'],
                    $all['statuses_count'],
                    $oUser->DataTwUserID
                ));
            }
            return $oUser->DataTwUserID;
        }
        else
        {
            if(!empty($all['name']) && !empty($all['screen_name']) && !empty($all['location']))
            {
                \Utility\Db::query("INSERT INTO DataTwUser
                        set
                        TwUserID = ?,
                        Name = ?,
                        ScreenName = ?,
                        Location = ?,
                        FollowersCount = ?,
                        FriendsCount = ?,
                        ListedCount = ?,
                        FavouritesCount = ?,
                        StatusesCount = ?,
                        Lang = ?
                    ",array(
                        $all['id'],
                        $all['name'],
                        $all['screen_name'],
                        $all['location'],
                        (empty($all['followers_count'])?0:$all['followers_count']),
                        (empty($all['friends_count'])?0:$all['friends_count']),
                        (empty($all['listed_count'])?0:$all['listed_count']),
                        (empty($all['favourites_count'])?0:$all['favourites_count']),
                        (empty($all['statuses_count'])?0:$all['statuses_count']),
                        $all['lang']
                    )
                );
                return \Utility\Db::last_insert_id();
            }
        }

    }
}