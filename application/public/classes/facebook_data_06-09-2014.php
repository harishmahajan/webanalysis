<?php
/**
 * Created by Indrek Päri
 * Date: 2.04.14 8:08
 */

class Facebook_data{

    public static $naming = array(
        'F' => 'Female',
        'M' => 'Male',
        'U' => 'Unknown',
    );

    public static function getMaxDate($iConnectionID)
    {
        $oR = \Utility\Db::query("select max(`Date`) max_date from DataFb where ConnectionID = ?",array($iConnectionID));
        return $oR->max_date;
    }

    public static function getTopCities($iConnectionID,$sFrom,$sTo){
        /*
        return \Utility\Db::query("select
                c.City,
                avg(c.Value) val
            from
                DataFb f
                inner join DataFb_PageFansCity c on c.DataFbID = f.DataFbID
            where
                f.ConnectionID = ? and
                f.`Date` between ? and ?
            group by
                c.City
            Order by val desc
            limit 5
        ",array($iConnectionID,$sFrom,$sTo),true);
        */
        return \Utility\Db::query("select
                c.City,
                c.Value as val
            from
                DataFb f
                inner join DataFb_PageFansCity c on c.DataFbID = f.DataFbID
            where
                f.ConnectionID = ? and
                f.`Date` = ?
            Order by val desc
            limit 5
        ",array($iConnectionID,$sTo),true);
    }
    public static function getCountPosts($iConnectionID,$sFrom,$sTo){

        $return = \Utility\Db::query("SELECT
                count(p.Post_id) as cou
            FROM `DataFb` f
            inner join DataFb_Posts p on p.DataFbID = f.DataFbID
            WHERE
                f.ConnectionID = ? and
                f.`Date` between ? and ?
        ",array($iConnectionID,$sFrom,$sTo));

        return $return->cou;
    }

    public static function getTopExternalTrafficSources($iConnectionID,$sFrom,$sTo){

        /*
        return \Utility\Db::query("select
                c.Referral,
                sum(c.Value) val
            from
                DataFb f
                inner join DataFb_PageViewsExternalReferrals c on c.DataFbID = f.DataFbID
            where
                f.ConnectionID = ? and
                f.`Date` between ? and ?
            group by
                c.Referral
            Order by val desc
            limit 5
        ",array($iConnectionID,$sFrom,$sTo),true);
        */

        $ret = \Utility\Db::query("select
                c.Referral,
                c.Value as val
            from
                DataFb f
                inner join DataFb_PageViewsExternalReferrals c on c.DataFbID = f.DataFbID
            where
                f.ConnectionID = ? and
                f.`Date` = ?
            Order by val desc
            limit 3
        ",array($iConnectionID,$sTo),true);

        return $ret;
    }
    public static function getCommunityMetrics($iConnectionID,$sFrom,$sTo){
        return \Utility\Db::query("select
                avg(PageImpressionsUnique) as daily_reach,
                avg(PageImpressions) as daily_impr,
                avg(PageEngagedUsers/PageFans) as engagements,
                sum(PageFanRemoves) as fan_rem,
                sum(PageFanAddsUnique) as fan_add
            from
                DataFb f
            where
                f.ConnectionID = ? and
                f.`Date` between ? and ?
        ",array($iConnectionID,$sFrom,$sTo));
    }

    public static function getContentBreakdown($iConnectionID,$sFrom,$sTo){

        return \Utility\Db::query("select
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
                inner join DataFb f on f.DataFbID = p.DataFbID
            where
                f.ConnectionID = ? and
                f.`Date` between ? and ?
            order by p.Post_impressions_unique desc
            limit 10
        ",array($iConnectionID,$sFrom,$sTo),true);

    }
    public static function getAvgContentBreakdown($iConnectionID,$sFrom,$sTo){

        return \Utility\Db::query("select
                abs(DATEDIFF(?,?)) days_diff,
                date_format(?,'%m/%d') min_day,
                date_format(?,'%m/%d') max_day,
                avg( (COALESCE(p.Post_like,0) + COALESCE(p.Post_comment,0) + COALESCE(p.Post_share,0)) ) as avg_Post_story_adds,
                avg(p.`Post_impressions_unique`) as avg_Post_impressions_unique,
                avg(p.`Post_impressions`) as avg_Post_impressions,
                avg(p.`Post_impressions_viral_unique`) as avg_Post_impressions_viral_unique,
                avg(p.`Post_impressions_fan_unique`) as avg_Post_impressions_fan_unique,
                avg(p.`Post_consumptions`) as avg_Post_consumptions,
                avg(p.`Post_engaged_users`) as avg_Post_engaged_users
            from
                DataFb_Posts p
                inner join DataFb f on f.DataFbID = p.DataFbID
            where
                f.ConnectionID = ? and
                f.`Date` between ? and ?
        ",array($sFrom,$sTo,$sFrom,$sTo,$iConnectionID,$sFrom,$sTo));

    }

    public static function activeDemographicGroups($iConnectionID,$dateFrom,$dateTo){

        return \Utility\Db::query("select
                p.Gender,
                p.Age,
                sum(p.Value) val
            from
                DataFb f
                inner join DataFb_PageStorytellersByAgeGender p on p.DataFbID = f.DataFbID
            where
                f.ConnectionID = ? and
                f.`Date` between ? and ? and
                p.Gender != 'U'
            group by
                p.Gender, p.Age
            Order by val desc
        ",array($iConnectionID,$dateFrom,$dateTo),true);

    }

    public static function getSumDate($iConnectionID,$dateFrom,$dateTo){

        $return = \Utility\Db::query("select
            min(`Date`) date_from,
            max(`Date`) date_to,

            sum(`PageFans`) as SumPageFans,
            sum(`PageStorytellers`) as SumPageStorytellers,
            sum(`PageImpressionsUnique`) as SumPageImpressionsUnique,
            sum(`PageImpressions`) as SumPageImpressions,
            sum(`PageEngagedUsers`) as SumPageEngagedUsers,
            sum(`PageFansOnlinePerDay`) as SumPageFansOnlinePerDay,
            sum(`PageImpressionsPaid`) as SumPageImpressionsPaid,
            /* sum(`PageImpressionsOrganic`) as SumPageImpressionsOrganic, */
            sum(`PageFanRemoves`) as SumPageFanRemoves,
            sum(`PageFanAddsUnique`) as SumPageFanAddsUnique,
            sum(`PageConsumptions`) as SumPageConsumptions,
            sum(`PageComment`) as SumPageComment,
            sum(`PageLike`) as SumPageLike,
            sum(`PageLink`) as SumPageLink

        from
            DataFb
        where
            ConnectionID = ? and
            `Date` between ? and ?
        ",array($iConnectionID,$dateFrom,$dateTo));

        // overwrite page sum data with post sum data - this is so bad, can we remove page sum query ?
        $return2 = \Utility\Db::query("SELECT
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
                f.`Date` between ? and ?
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

        $oR = \Utility\Db::query("select
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

        $oR = \Utility\Db::query("select
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