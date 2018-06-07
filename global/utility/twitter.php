<?php
/**
 * Created by Indrek Päri
 * Date: 28.03.14 14:16
 */

namespace Utility;

/*
todo: twitter stream has same class, refactor to use under \Utility
*/

class Twitter{

    private $iAccountId;
    private $iConnectionId;

    public function __construct($iAccountId, $TW_UserID)
    {
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

    }

    public static function updateHistoricalFollowers($iTwitterId, $sDate_long, $iFollowers)
    {
        $iUserID = self::getUserId(array('id'=>$iTwitterId));
        $sData = date("Y-m-d",strtotime($sDate_long));

        if( \Utility\Db::query("select 1 from DataTwUser_followers_history where DataTwUserID = ? and `Date` = ?", array($iUserID,$sData)) )
        {
            \Utility\Db::query("Update DataTwUser_followers_history set FollowersCount = ? where DataTwUserID = ? and `Date` = ?", array($iFollowers,$iUserID,$sData));
        }
        else
        {
            \Utility\Db::query("INSERT INTO `DataTwUser_followers_history` (`DataTwUserID`, `FollowersCount`, `Date`) VALUES (?, ?, ?)", array($iUserID,$iFollowers,$sData));
        }

    }

    public static function getUseridByScreenname($sScreenname,$iFollowers = null)
    {
        if($oUser = \Utility\Db::query("select DataTwUserID from DataTwUser where ScreenName = ? limit 1",array($sScreenname)))
        {
            return $oUser->DataTwUserID;
        }
        else
        {
            $iUserId = self::getUserId(
                array(
                    'id' => $sScreenname,
                    'id_is_screenname' => true
                ),
                false
            );

            if(!empty($iFollowers))
            {
                \Utility\Db::query("UPDATE DataTwUser set FollowersCount = ? where DataTwUserID = ? limit 1",array(
                    $iFollowers,
                    $iUserId
                ));
            }

            return $iUserId;
        }
    }

    public function removeTweet($sId)
    {
        \Utility\Db::query("delete from DataTwTweet where ConnectionID = ? and TwTweetID = ?",array($this->iConnectionId,$sId));
    }

    public function addTweet($aUser, $sId, $sDate, $sSource, $sText, $sLang, $aRetweeted_status = array(), $in_reply_to_status_id, $in_reply_to_user_id, $user_mentions, $updateUserData = true)
    {
        $iUserId = $this->getUserId($aUser, $updateUserData);
        \Utility\Db::query("INSERT INTO `DataTwTweet` (`DataTwID`, `ConnectionID`, `DataTwUserID`, `TwTweetID`, `CreatedAt`, `Source`, `Tweet`, `Lang`)
            VALUES (
                null, ?, ?, ?, ?, ?, ?, ?
            )",
            array(
                $this->iConnectionId, $iUserId, $sId, $sDate, $sSource, $sText, $sLang
            )
        );

        $iTweetId = \Utility\Db::last_insert_id();

        if(!empty($aRetweeted_status))
        {
            $iReUserId = $this->getUserId($aRetweeted_status['user'], $updateUserData);
            \Utility\Db::query("update DataTwTweet set ReTwTweetID = ?, ReDataTwUserID = ? where DataTwID = ? limit 1",array(
                $aRetweeted_status['id'],
                $iReUserId,
                $iTweetId
            ));
        }

        if(!empty($in_reply_to_status_id))
        {
            $iReUserId = ( is_null($in_reply_to_user_id) ? null : $this->getUserId(array('id'=>$in_reply_to_user_id), $updateUserData) );
            \Utility\Db::query("update DataTwTweet set InReplyTwTweetID = ?, InReplyTwUserID = ? where DataTwID = ? limit 1",array(
                $in_reply_to_status_id,
                $iReUserId,
                $iTweetId
            ));
        }

        if(!empty($user_mentions))
        {
            foreach($user_mentions as $mentions)
            {
                $iReUserId = $this->getUserId(array('id'=>$mentions), $updateUserData);
                \Utility\Db::query("INSERT INTO `webanalysis`.`DataTwTweetEntitiesUserMentions` (`DataTwTweetID`, `DataTwUserID`) VALUES (?, ?)",array(
                    $iTweetId,
                    $iReUserId
                ));
            }
        }

    }

    public function addEvent($sEvent, $sDateTime, $aSource, $aTarget)
    {
        $iSourceUserId = $this->getUserId($aSource);
        $iTargetUserId = $this->getUserId($aTarget);

        \Utility\Db::query("INSERT INTO `DataTwEvent` (`DataTwEventID`, `ConnectionID`, `Event`, `CreatedAt`, `SourceUserID`, `TargetUserID`)
            VALUES (
                null, ?, ?, ?, ?, ?
            )",
            array(
                $this->iConnectionId, $sEvent, $sDateTime, $iSourceUserId, $iTargetUserId
            )
        );

    }

    private function getUserId($aUser, $updateUserData=false){

        if(empty($aUser)) return null;

        if($oUser = \Utility\Db::query("select DataTwUserID from DataTwUser where ".($aUser['id_is_screenname']?"ScreenName":"TwUserID")." = ? limit 1",array($aUser['id'])))
        {
            if(isset($aUser['followers_count']) and $updateUserData)
            {
                \Utility\Db::query("UPDATE DataTwUser set FollowersCount = ?, FriendsCount = ?, ListedCount = ?, FavouritesCount = ?, StatusesCount = ? where DataTwUserID = ? limit 1",array(
                    $aUser['followers_count'],
                    $aUser['friends_count'],
                    $aUser['listed_count'],
                    $aUser['favourites_count'],
                    $aUser['statuses_count'],
                    $oUser->DataTwUserID
                ));
            }
            return $oUser->DataTwUserID;
        }
        else
        {
            if($aUser['id_is_screenname'])
            {
                $aUser['screen_name'] = $aUser['id'];
                $aUser['id'] = null;
            }

            \Utility\Db::query("INSERT INTO DataTwUser set
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
                    $aUser['id'],
                    $aUser['name'],
                    $aUser['screen_name'],
                    $aUser['location'],
                    (empty($aUser['followers_count'])?0:$aUser['followers_count']),
                    (empty($aUser['friends_count'])?0:$aUser['friends_count']),
                    (empty($aUser['listed_count'])?0:$aUser['listed_count']),
                    (empty($aUser['favourites_count'])?0:$aUser['favourites_count']),
                    (empty($aUser['statuses_count'])?0:$aUser['statuses_count']),
                    $aUser['lang']
                )
            );
            return \Utility\Db::last_insert_id();
        }

    }
}