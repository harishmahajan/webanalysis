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
        $sFrom=$sFrom." 00:00:00";
        $To=$To." 23:59:59";
        return \Utility\Db::query("SELECT CONVERT((select FollowersCount from webanalysis.DataTwUser_followers_history where DataTwUserID=$iUserId and Date <='$To' order by Date desc limit 1 ),SIGNED) - CONVERT(( select FollowersCount from webanalysis.DataTwUser_followers_history where DataTwUserID=$iUserId and Date >='$sFrom' order by Date  limit 1 ),SIGNED) AS new",array());
      
    }

    public function getRange($DFrom,$Dto)
    {
        $date1=date_create($DFrom);
        $date2=date_create($Dto);
        $diff=date_diff($date1,$date2);
        return $diff->format("%a");
        
    }
    public function getFavorites($iConnectionId, $iUserId, $sFrom, $To = false){
        $sFrom=$sFrom." 00:00:00";
        $To=$To." 23:59:59";
        $oData = \Utility\Db::query("select sum(Favorite) as count from webanalysis.`DataTwTweet` where ConnectionID =? and CreatedAt between ? and ? ",array($iConnectionId, $sFrom, $To));
        return $oData->count;
    }

    public function getTweets($iConnectionId, $iUserId, $sFrom, $To = false){

        $sFrom=$sFrom." 00:00:00";
        $To=$To." 23:59:59";     
        //new code
        $oData = \Utility\Db::query("select count(DataTwID) count from webanalysis.DataTwTweet t where t.ConnectionID = ? and CreatedAt >= ? and  CreatedAt <= ?",array($iConnectionId, $sFrom, $To));
        /*$oData = \Utility\Db::query("select count(DataTwID) count from DataTwTweet t
            where
                t.ConnectionID = ? and
                DataTwUserID = ? and
                CreatedAt >= ?
                ".($To?"and date(CreatedAt) <= '".$To."'":"")."
        ",array($iConnectionId, $iUserId, $sFrom));*/
        return $oData->count;
    }

    public function getMentions($iConnectionId, $iUserId, $sFrom, $To = false){
        $sFrom=$sFrom." 00:00:00";
        $To=$To." 23:59:59";
        $oData = \Utility\Db::query("select sum(IsMention)+sum(IsReplie) as count from webanalysis.`DataTwMentation` where ConnectionID=? and CreatedAt between ? and ?;",array($iConnectionId, $sFrom,$To));
        return $oData->count;
    }

    public function getRetweets($iConnectionId, $iUserId, $sFrom, $To = false){
        
        $sFrom=$sFrom." 00:00:00";
        $To=$To." 23:59:59";
       $oData = \Utility\Db::query("select sum(Retweet) as count from webanalysis.`DataTwTweet` where ConnectionID =? and CreatedAt between ? and ? ",array($iConnectionId, $sFrom, $To));
       return $oData->count;
         
    }

    public function getReplies($iConnectionId, $iUserId, $sFrom, $To = false){
        $sFrom=$sFrom." 00:00:00";
        $To=$To." 23:59:59";
        $oData = \Utility\Db::query("select sum(IsReplie) as count from webanalysis.`DataTwMentation` where ConnectionID=? and CreatedAt between ? and ?;",array($iConnectionId, $sFrom,$To));
        return $oData->count;
    }

    public function getRecentTweets($iConnectionId, $sFrom, $To = false, $num){
         $sFrom=$sFrom." 00:00:00";
        $To=$To." 23:59:59";       
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
         $sFrom=$sFrom." 00:00:00";
        $To=$To." 23:59:59";
        
        return \Utility\Db::query("select Count(TwUserID) as top,ScreenName from webanalysis.DataTwMentation where ConnectionID=? and TwUserID !='' and ScreenName != '' and CreatedAt between ? and ? and IsMention=1 group by TwUserID order by top desc limit 10",array($iConnectionId, $sFrom, $To));

    }

    public function getTopLocations($iConnectionId, $sFrom, $To = false,$num){
        $sFrom=$sFrom." 00:00:00";
        $To=$To." 23:59:59";
        return \Utility\Db::query("select count(Location) as top,Location from webanalysis.DataTwMentation where Location != '' and ConnectionID=? and CreatedAt between ? and ? and IsMention=1 group by Location order by top desc limit $num",array($iConnectionId, $sFrom, $To));
    }

    public function getPotentianReach($iConnectionId, $sFrom, $To = false)
    {
        $sFrom=$sFrom." 00:00:00";
        $To=$To." 23:59:59";

        return \Utility\Db::query("select (sum(ReachCount) +sum(FollowersCount)) as PotentialReach from webanalysis.DataTwMentation where ConnectionID=? and CreatedAt between ? and ?",array($iConnectionId, $sFrom, $To));
    }

    public function getPotentialImpression($iConnectionId, $sFrom, $To = false)
    {
        $sFrom=$sFrom." 00:00:00";
        $To=$To." 23:59:59";
       
        return \Utility\Db::query("select sum(result) as PotentialImpression from ((select ((sum(ReachCount) +sum(FollowersCount))*Count(*)) as result from webanalysis.DataTwMentation where ConnectionID=? and CreatedAt between ? and ? group by  DATE_FORMAT(CreatedAt, '%Y/%m/%d')) as tab );",array($iConnectionId, $sFrom, $To));
    }

    public function getUniquePeople($iConnectionId, $sFrom, $To = false)
    {
        $sFrom=$sFrom." 00:00:00";
        $To=$To." 23:59:59";
       
        return \Utility\Db::query("select count(distinct TwUserId) as UniquePeople from webanalysis.DataTwMentation where ConnectionID= ? and CreatedAt between ? and ?",array($iConnectionId, $sFrom, $To));
    }

    
}