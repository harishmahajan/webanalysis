<?php
/**
 * Created by Indrek Päri
 * Date: 16.04.14 16:15
 */

class Twitter_data{

    public static function getUserDetailsByTwId($iTwitterId){
        return \Utility\Db::query("select * from DataTwUser where TwUserID = ? limit 1",array($iTwitterId));
    }

    public function getNewFollowers($iConnectionId, $iUserId, $sFrom, $To = false){

        $oData = \Utility\Db::query("select
                sum(if(Event='follow',1,0)) as follow,
                sum(if(Event='unfollow',1,0)) as unfollow
            from DataTwEvent
            where
                ConnectionID = ? and
                date(CreatedAt) >= ? and
                ".($To?"date(CreatedAt) <= '".$To."' and":"")."
                TargetUserID = ?
        ",array($iConnectionId, $sFrom, $iUserId));

        return ($oData->follow - $oData->unfollow);
    }

    public function getFavorites($iConnectionId, $iUserId, $sFrom, $To = false){

        $oData = \Utility\Db::query("select count(DataTwEventID) from DataTwEvent e
            where
                ConnectionID = ? and
                TargetUserID = ? and
                Event = 'favorite' and
                CreatedAt >= ?
                ".($To?"and date(CreatedAt) <= '".$To."'":"")."
        ",array($iConnectionId, $iUserId, $sFrom));

        return ($oData->follow - $oData->unfollow);
    }

    public function getTweets($iConnectionId, $iUserId, $sFrom, $To = false){

        $oData = \Utility\Db::query("select count(DataTwID) from DataTwTweet t
            where
                t.ConnectionID = ? and
                DataTwUserID = ? and
                CreatedAt >= ?
                ".($To?"and date(CreatedAt) <= '".$To."'":"")."
        ",array($iConnectionId, $iUserId, $sFrom));

        return ($oData->follow - $oData->unfollow);
    }

    public function getMentions($iConnectionId, $iUserId, $sFrom, $To = false){

        $oData = \Utility\Db::query("select count(m.DataTwUserID) count from DataTwTweetEntitiesUserMentions m
            inner join DataTwTweet t on t.DataTwID = m.DataTwTweetID
            where
                t.ConnectionID = ? and
                m.DataTwUserID = ? and
                t.CreatedAt >= ?
                ".($To?"and date(CreatedAt) <= '".$To."'":"")."
        ",array($iConnectionId, $iUserId, $sFrom));

        return $oData->count;
    }

    public function getRetweets($iConnectionId, $iUserId, $sFrom, $To = false){

        $oData = \Utility\Db::query("select count(DataTwID) count from DataTwTweet
            where
                ConnectionID = ? and
                ReDataTwUserID = ? and
                CreatedAt >= ?
                ".($To?"and date(CreatedAt) <= '".$To."'":"")."
        ",array($iConnectionId, $iUserId, $sFrom));

        return $oData->count;
    }

    public function getReplies($iConnectionId, $iUserId, $sFrom, $To = false){

        $oData = \Utility\Db::query("select count(DataTwID) count from DataTwTweet
            where
                ConnectionID = ? and
                InReplyTwUserID = ? and
                CreatedAt >= ?
                ".($To?"and date(CreatedAt) <= '".$To."'":"")."
        ",array($iConnectionId, $iUserId, $sFrom));

        return $oData->count;
    }

    public function getRecentTweets($iConnectionId, $sFrom, $To = false, $num = 5){

        return \Utility\Db::query("SELECT Tweet
            from DataTwTweet t
            WHERE
                t.ConnectionID = ? and
                t.CreatedAt between ? and ?
            order by t.DataTwID desc
            limit ".$num."
        ",array($iConnectionId, $sFrom, $To));

    }

    public function getMostActiveFans($iConnectionId, $sFrom, $To = false){

        return \Utility\Db::query("SELECT
                count(t.DataTwID) numTweets,
                u.ScreenName
            from
                DataTwTweet t
            inner join DataTwUser u on u.DataTwUserID = t.DataTwUserID
            WHERE
                t.ConnectionID = ? and
                t.CreatedAt between ? and ?
            group by t.DataTwUserID
            order by numTweets desc
            limit 10
        ",array($iConnectionId, $sFrom, $To));

    }

    public function getTopLocations($iConnectionId, $sFrom, $To = false){

        return \Utility\Db::query("SELECT
                count(t.DataTwID) numTweets,
                u.Location
            from
                DataTwTweet t
            inner join DataTwUser u on u.DataTwUserID = t.DataTwUserID
            WHERE
                t.ConnectionID = ? and
                date(t.CreatedAt) between ? and ? and
                u.Location != ''
            group by u.Location
            order by numTweets desc
            limit 5
        ",array($iConnectionId, $sFrom, $To));

    }

}