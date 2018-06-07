<?php
/**
 * Created by Indrek Päri
 * Date: 2.04.14 8:08
 */
/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/
class Facebook_data{

    public static $naming = array(
        'F' => 'Female',
        'M' => 'Male',
        'U' => 'Unknown',
    );

    public static function getMaxDate($iConnectionID)
    {
        $oR = \Utility\Db::query("select SQL_CACHE max(`Date`) max_date from DataFb where ConnectionID = ?",array($iConnectionID));
        return $oR->max_date;
    }

    public static function getTopCities($iConnectionID,$sFrom,$sTo){
        
        //new
        return \Utility\Db::query("select SQL_CACHE
                c.City,
                c.Value as val
            from
                DataFb f
                ,DataFb_PageFansCity c where c.DataFbID = f.DataFbID
            and
                f.ConnectionID = ? and
                f.`Date` = ?
            Order by val desc
            limit 10
        ",array($iConnectionID,$sTo),true);

    
    }
    public static function getCountPosts($iConnectionID,$sFrom,$sTo){

        $return = \Utility\Db::query("SELECT SQL_CACHE
                count(p.Post_id) as cou
            FROM `DataFb` f
            , DataFb_Posts p where p.DataFbID = f.DataFbID
            and
                f.ConnectionID = ? and
                f.`Date` >= ? and f.`Date` <=?
        ",array($iConnectionID,$sFrom,$sTo));

        return $return->cou;
    }

    public static function getTopExternalTrafficSources($iConnectionID,$sFrom,$sTo){
        //new code
        return \Utility\Db::query("select SQL_CACHE
                c.Referral,
                sum(c.Value) val
            from
                DataFb f
                , DataFb_PageViewsExternalReferrals c where c.DataFbID = f.DataFbID
            and
                f.ConnectionID = ? and
                f.`Date` between ? and ?
            group by
                c.Referral
            Order by val desc
            limit 3
        ",array($iConnectionID,$sFrom,$sTo),true);        
      
    }

    public static function getCommunityMetrics($iConnectionID,$sFrom,$sTo){
        return \Utility\Db::query("select SQL_CACHE
                avg(PageImpressionsUnique) as daily_reach,
                avg(PageImpressions) as daily_impr,
                avg(PageEngagedUsers/PageFans) as engagements,
                sum(PageFanRemoves) as fan_rem,
                sum(PageFanAddsUnique) as fan_add
            from
                DataFb f
            where
                f.ConnectionID = ? and
                 f.`Date` >= ? and f.`Date` <=?
        ",array($iConnectionID,$sFrom,$sTo));
    }

    public static function getContentBreakdown($iConnectionID,$sFrom,$sTo){

        return \Utility\Db::query("select SQL_CACHE
                date_format(f.Date,'%m/%d') day,
                p.`Post_link`,
                left(p.`Post_message`,25) Post_message,
                (COALESCE(p.Post_like,0) + COALESCE(p.Post_comment,0) + COALESCE(p.Post_share,0)) as `Post_story_adds`,
                p.`Post_impressions_unique`,
                p.`Post_impressions`,
                p.`Post_impressions_viral_unique`,
                p.`Post_impressions_fan_unique`,
                p.`Post_consumptions`,
                p.`Post_engaged_users`
            from
                DataFb_Posts p
                ,DataFb f where f.DataFbID = p.DataFbID
            and
                f.ConnectionID = ? and
                 f.`Date` >= ? and f.`Date` <=?
            order by p.Post_impressions_unique desc
            limit 10
        ",array($iConnectionID,$sFrom,$sTo),true);

    }
    public static function getAvgContentBreakdown($iConnectionID,$sFrom,$sTo){
        
        return \Utility\Db::query("select SQL_CACHE
                abs(DATEDIFF(?,?)) days_diff,
                date_format(?,'%m/%d') min_day,
                date_format(?,'%m/%d') max_day,avg( (COALESCE(p.Post_like,0) + COALESCE(p.Post_comment,0) + COALESCE(p.Post_share,0)) ) as avg_Post_story_adds,
                avg(p.`Post_impressions_unique`) as avg_Post_impressions_unique,
                avg(p.`Post_impressions`) as avg_Post_impressions,
                avg(p.`Post_impressions_viral_unique`) as avg_Post_impressions_viral_unique,
                avg(p.`Post_impressions_fan_unique`) as avg_Post_impressions_fan_unique,
                avg(p.`Post_consumptions`) as avg_Post_consumptions,avg(p.`Post_engaged_users`) as avg_Post_engaged_users
            from
                DataFb_Posts p
                ,DataFb f where f.DataFbID = p.DataFbID
            and
                f.ConnectionID = ? and
                 f.`Date` >= ? and f.`Date` <=?
        ",array($sFrom,$sTo,$sFrom,$sTo,$iConnectionID,$sFrom,$sTo));
    }

    public static function activeDemographicGroups($iConnectionID,$dateFrom,$dateTo){

        return \Utility\Db::query("select SQL_CACHE
                p.Gender,
                p.Age,
                sum(p.Value) val
            from
                DataFb f
                ,DataFb_PageStorytellersByAgeGender p where p.DataFbID = f.DataFbID
            and
                f.ConnectionID = ? and
                f.`Date` >= ? and f.`Date` <=? and
                p.Gender != 'U'
            group by
                p.Gender, p.Age
            Order by val desc
        ",array($iConnectionID,$dateFrom,$dateTo),true);

    }

    public static function getSumDate($iConnectionID,$dateFrom,$dateTo){

        //working code
        $return = \Utility\Db::query("select SQL_CACHE
            min(`Date`) date_from,
            max(`Date`) date_to,
            sum(`PageFans`) as SumPageFans,
            sum(`PageImpressionsUnique`) as SumPageImpressionsUnique,
            sum(`PageImpressions`) as SumPageImpressions,
            sum(`PageFansOnlinePerDay`) as SumPageFansOnlinePerDay,
            sum(`PageImpressionsPaid`) as SumPageImpressionsPaid,
            sum(`PageFanRemoves`) as SumPageFanRemoves,
            sum(`PageFanAddsUnique`) as SumPageFanAddsUnique,
            sum(`PageConsumptions`) as SumPageConsumptions
        from
            DataFb
        where
            ConnectionID = ? and
             `Date` >= ? and `Date` <=?
        ",array($iConnectionID,$dateFrom,$dateTo));

        // overwrite page sum data with post sum data - this is so bad, can we remove page sum query ?
        $return2 = \Utility\Db::query("SELECT SQL_CACHE
                sum( COALESCE(p.Post_like,0) + COALESCE(p.Post_comment,0) + COALESCE(p.Post_share,0) ) as fb_post_stories,
                sum( COALESCE(p.Post_like,0) ) as fb_post_like,
                sum( COALESCE(p.Post_comment,0) ) as fb_post_comment,
                sum( COALESCE(p.Post_share,0) ) as fb_post_share,
                sum( COALESCE(p.Post_consumptions,0) ) as fb_post_consumptions,
                avg( p.Post_impressions_unique ) as fb_post_impressions_unique,
                avg( p.Post_impressions_fan_unique ) as fb_post_impressions_fan_unique
            FROM `DataFb` f
            inner join DataFb_Posts p on p.DataFbID = f.DataFbID

            WHERE
                f.ConnectionID = ? and
                 f.`Date` >= ? and f.`Date` <=?
    	",array($iConnectionID,$dateFrom,$dateTo));

        $return->SumPageEngagedUsers = $return2->fb_post_stories;
        $return->SumPageComment = $return2->fb_post_comment;
        $return->SumPageLike = $return2->fb_post_like;
        $return->SumPageStorytellers = $return2->fb_post_share;
        $return->SumPageLink = $return2->fb_post_consumptions;
        $return->AvgImpressionsUnique = $return2->fb_post_impressions_unique;
        $return->AvgImpressionsFanUnique = $return2->fb_post_impressions_fan_unique;

        return $return;
    }

    public static function getDailyAverageImpressions($iConnectionID,$dateFrom,$dateTo){

        $oR = \Utility\Db::query("select SQL_CACHE
            avg(`PageImpressionsUnique`) avg_day_imp
        from
            DataFb
        where
            ConnectionID = ? and
            `Date` >= ? and
            `Date` <= ?
        ",array($iConnectionID,$dateFrom,$dateTo));

        return $oR->avg_day_imp;
    }

    public static function getDailyAverageEngaged($iConnectionID,$dateFrom,$dateTo){

        $oR = \Utility\Db::query("select SQL_CACHE
            avg(`PageEngagedUsers`) avg_day_eng
        from
            DataFb
        where
            ConnectionID = ? and
            `Date` >= ? and
            `Date` <= ?
        ",array($iConnectionID,$dateFrom,$dateTo));

        return $oR->avg_day_eng;
    }

}