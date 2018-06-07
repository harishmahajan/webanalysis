<?php
/**
 * Created by Indrek Päri
 * Date: 1.04.14 9:39
 */

class Chart
{
    private $aQuaryArray;
    private $iConnection;

    public function __construct($aQa)
    {
        $this->aQuaryArray = $aQa;
        $this->iConnection = $this->aQuaryArray[3];
        $this->from = date("Y-m-d",strtotime($this->aQuaryArray[4]));
        $this->to = date("Y-m-d",strtotime($this->aQuaryArray[5]));
    }

    public function Demographics()
    {
        $aoData = \Utility\Db::query("select
                p.Gender,
                p.Age,
                avg(p.Value) as Value
            from
                DataFb f
            inner join DataFb_PageFansGenderAge p on p.DataFbID = f.DataFbID
            where
               f.ConnectionID = ? and
               f.`Date` between ? and ? and
               p.Gender in ('F','M')
            group by p.Gender, p.Age
            order by p.Age",array($this->iConnection,$this->from,$this->to));

        $aBuff = array();
        foreach($aoData as $oR)
        {
            $aBuff[$oR->Age][$oR->Gender] = $oR->Value;
        }

        $aChartData = array();
        foreach($aBuff as $k => $v)
        {
            $aChartData['label'][] = $k;
            $aChartData['line1'][] = (int)$v['M'];
            $aChartData['line2'][] = (int)$v['F'];
        }

        $oChart = new \Utility\Phantom_chart(
            ($this->aQuaryArray[2] == 'img' ? 400 : '100%'),
            200,
            $aChartData['label'] //array('4/1','4/2','4/3','4/4','4/5','4/6','4/7')
        );
        $oChart->addLinear(
            $aChartData['line1'], //array(3500,4000,3200,5000,4050,4800,4900),
            'Male',
            '#9ad2d5'
        );

        $oChart->addLinear(
            $aChartData['line2'], //array(1000,900,1500,2000,3000,1800,2000),
            'Female',
            '#ed7467'
        );

        return $oChart->show('ColumnChart',$this->aQuaryArray[2]);

    }

    public function Mentions($iUserId)
    {
        $aoData = \Utility\Db::query("SELECT
                date_format(t.CreatedAt,'%m/%d') day,
                count(t.DataTwID) mentions
            FROM `DataTwTweetEntitiesUserMentions` m
            inner join DataTwTweet t on t.DataTwID = m.DataTwTweetID
            WHERE
                m.DataTwUserID = ? and
                t.ConnectionID = ? and
                t.CreatedAt between ? and ?
            group by date(t.CreatedAt)",array($iUserId,$this->iConnection,$this->from,$this->to),true);

        $aChartData = array();
        foreach($aoData as $oR)
        {
            $aChartData['label'][] = $oR->day;
            $aChartData['line1'][] = (int)$oR->mentions;
        }

        $oChart = new \Utility\Phantom_chart(
            ($this->aQuaryArray[2] == 'img' ? 400 : '100%'),
            300,
            $aChartData['label'] //array('4/1','4/2','4/3','4/4','4/5','4/6','4/7')
        );
        $oChart->addLinear(
            $aChartData['line1'], //array(3500,4000,3200,5000,4050,4800,4900),
            'Mentions',
            '#9ad2d5'
        );

        return $oChart->show('ColumnChart',$this->aQuaryArray[2]);

    }

    public function CommunityActivity()
    {
        $aoData = \Utility\Db::query("select
                date_format(`Date`,'%m/%d') day,
                PageImpressions,
                PageImpressionsUnique,
                PageStorytellers
            from
                DataFb
            where
                ConnectionID = ? and
                `Date` between ? and ?
            order by `Date`",array($this->iConnection,$this->from,$this->to));

        $aChartData = array();
        foreach($aoData as $oR)
        {
            $aChartData['label'][] = $oR->day;
            $aChartData['line1'][] = (int)$oR->PageImpressions;
            $aChartData['line2'][] = (int)$oR->PageImpressionsUnique;
            $aChartData['line3'][] = (int)$oR->PageStorytellers;
        }

        $oChart = new \Utility\Phantom_chart(
            ($this->aQuaryArray[2] == 'img' ? 400 : '100%'),
            300,
            $aChartData['label'] //array('4/1','4/2','4/3','4/4','4/5','4/6','4/7')
        );
        $oChart->addLinear(
            $aChartData['line1'], //array(3500,4000,3200,5000,4050,4800,4900),
            'Total Impressions',
            '#9ad2d5'
        );

        $oChart->addLinear(
            $aChartData['line2'], //array(1000,900,1500,2000,3000,1800,2000),
            'Total reach',
            '#ed7467'
        );

        $oChart->addLinear(
            $aChartData['line3'], //array(1000,900,1500,2000,3000,1800,2000),
            'Talking about',
            '#59c16a'
        );

        return $oChart->show('AreaChart',$this->aQuaryArray[2],array('series' => array(array('targetAxisIndex'=>0),array('targetAxisIndex'=>0),array('targetAxisIndex'=>1,'type'=>'bars'))));

    }

    public function InternalFanSources()
    {
        $aoData = \Utility\Db::query("select
                c.Source,
                sum(c.Value) val
            from
                DataFb f
                inner join DataFb_PageFansByLikeSource c on c.DataFbID = f.DataFbID
            where
                f.ConnectionID = ? and
                f.`Date` between ? and ?
            group by
                c.Source
            Order by val desc
            limit 5",array($this->iConnection,$this->from,$this->to));

        $aChartData = array();
        foreach($aoData as $oR)
        {
            $aChartData['label'][] = $oR->Source;
            $aChartData['line1'][] = (int)$oR->val;
        }

        $oChart = new \Utility\Phantom_chart(
            ($this->aQuaryArray[2] == 'img' ? 300 : '100%'),
            ($this->aQuaryArray[2] == 'img' ? 300 : '230'),
            $aChartData['label'] //array('4/1','4/2','4/3','4/4','4/5','4/6','4/7')
        );
        $oChart->addLinear(
            $aChartData['line1'], //array(3500,4000,3200,5000,4050,4800,4900),
            'Fans',
            '#9ad2d5'
        );
        if($this->aQuaryArray[2] != 'img')
            return $oChart->show('PieChart',$this->aQuaryArray[2],array('colors' => array('#9ad2d5','#ed7467','#59c16a','#f9d34e','#8f44c8')));
        else
            return $oChart->show('PieChart',$this->aQuaryArray[2],array('colors' => array('#9ad2d5','#ed7467','#59c16a','#f9d34e','#8f44c8'),'legend' => array('position' => 'none','textStyle'=>'{fontSize: 8}')));

    }
    public function Demographics_pie()
    {
        $aoData = \Utility\Db::query("select
                p.Gender,
                avg(p.Value) as Value
            from
                DataFb f
            inner join DataFb_PageFansGenderAge p on p.DataFbID = f.DataFbID
            where
               f.ConnectionID = ? and
               f.`Date` between ? and ? and
               p.Gender in ('F','M')
            group by p.Gender
            order by p.Gender desc",array($this->iConnection,$this->from,$this->to));

        $aChartData = array();
        foreach($aoData as $oR)
        {
            $aChartData['label'][] = ( $oR->Gender == 'M' ? 'Male' : 'Female' );
            $aChartData['line1'][] = (int)$oR->Value;
        }

        $oChart = new \Utility\Phantom_chart(
            ($this->aQuaryArray[2] == 'img' ? 260 : '100%'),
            ($this->aQuaryArray[2] == 'img' ? 195 : '200'),
            $aChartData['label'] //array('4/1','4/2','4/3','4/4','4/5','4/6','4/7')
        );
        $oChart->addLinear(
            $aChartData['line1'], //array(3500,4000,3200,5000,4050,4800,4900),
            'Gender',
            '#9ad2d5'
        );

        return $oChart->show('PieChart',$this->aQuaryArray[2],array('colors' => array('#9ad2d5','#ed7467','#59c16a','#f9d34e','#8f44c8'), 'legend' => array('position' => 'bottom')));
    }

    public function ReachBreakdown()
    {
        $aoData = \Utility\Db::query("select
                date_format(`Date`,'%m/%d') day,
                PageFans,
                PageFansOnlinePerDay,
                PageImpressionsUnique
            from
                DataFb
            where
                ConnectionID = ? and
                `Date` between ? and ?
            order by `Date`",array($this->iConnection,$this->from,$this->to));

        $aChartData = array();
        foreach($aoData as $oR)
        {
            $aChartData['label'][] = $oR->day;
            $aChartData['line1'][] = (int)$oR->PageFans;
            $aChartData['line2'][] = (int)$oR->PageFansOnlinePerDay;
            $aChartData['line3'][] = (int)$oR->PageImpressionsUnique;
        }

        $oChart = new \Utility\Phantom_chart(
            ($this->aQuaryArray[2] == 'img' ? 260 : '100%'),
            ($this->aQuaryArray[2] == 'img' ? 330 : '300'),
            $aChartData['label'] //array('4/1','4/2','4/3','4/4','4/5','4/6','4/7')
        );
        $oChart->addLinear(
            $aChartData['line1'], //array(3500,4000,3200,5000,4050,4800,4900),
            'Fans',
            '#9ad2d5'
        );

        $oChart->addLinear(
            $aChartData['line2'], //array(1000,900,1500,2000,3000,1800,2000),
            'Online',
            '#ed7467'
        );

        $oChart->addLinear(
            $aChartData['line3'], //array(1000,900,1500,2000,3000,1800,2000),
            'Reach',
            '#59c16a'
        );

        return $oChart->show('LineChart',$this->aQuaryArray[2],array('pointSize' => 0));

    }

    public function OrganicVsPaidLikes()
    {
         //test
       /* $a= \Utility\Db::query("select
                date_format(f.`Date`,'%m/%d') day,
                sum(COALESCE(s1.Value,0)) as paid,
                sum(COALESCE(s2.Value,0)) as free
            from
                DataFb f
            left join DataFb_PageFansByLikeSource s1 on s1.DataFbID = f.DataFbID and s1.Source in ('ads','mobile_ads')
            left join DataFb_PageFansByLikeSource s2 on s2.DataFbID = f.DataFbID and s2.Source in ('api','fan_context_story','feed_chaining','feed_pyml','hovercard',
                'invitations','like_story','mobile','mobile_page_browser','mobile_page_suggestions_on_liking','needy_page_suggestion_megaphone','page_browser','page_browser_chaining',
                'page_invite_escape_hatch','page_profile','photo_snowlift','recommended_pages','reminder_box_invite','reminder_box_invite_like_all','reminder_box_recommendation','search',
                'sponsored_story','ticker','timeline','timeline_collection','external_connect','favorites')
            where
                f.ConnectionID = ? and
                f.`Date` between ? and ?
            group by f.`Date`
            order by f.`Date`",array($this->iConnection,$this->from,$this->to));

        foreach ($a as $ab) {
           echo "<br>....";
           print_r($ab);
        }
        exit;*/

        /*
        $aoData = \Utility\Db::query("select
                date_format(`Date`,'%m/%d') day,
                PageImpressionsOrganic,
                PageImpressionsPaid
            from
                DataFb
            where
                ConnectionID = ? and
                `Date` between ? and ?
            order by `Date`",array($this->iConnection,$this->from,$this->to));
        */

        $aoData = \Utility\Db::query("select
                date_format(f.`Date`,'%m/%d') day,
                sum(COALESCE(s1.Value,0)) as paid,
                sum(COALESCE(s2.Value,0)) as free
            from
                DataFb f
            left join DataFb_PageFansByLikeSource s1 on s1.DataFbID = f.DataFbID and s1.Source in ('ads','mobile_ads')
            left join DataFb_PageFansByLikeSource s2 on s2.DataFbID = f.DataFbID and s2.Source in ('api','fan_context_story','feed_chaining','feed_pyml','hovercard',
                'invitations','like_story','mobile','mobile_page_browser','mobile_page_suggestions_on_liking','needy_page_suggestion_megaphone','page_browser','page_browser_chaining',
                'page_invite_escape_hatch','page_profile','photo_snowlift','recommended_pages','reminder_box_invite','reminder_box_invite_like_all','reminder_box_recommendation','search',
                'sponsored_story','ticker','timeline','timeline_collection','external_connect','favorites')
            where
                f.ConnectionID = ? and
                f.`Date` between ? and ?
            group by f.`Date`
            order by f.`Date`",array($this->iConnection,$this->from,$this->to));

        $aChartData = array();
        foreach($aoData as $oR)
        {
            $aChartData['label'][] = $oR->day;
            $aChartData['line1'][] = (int)$oR->free;
            $aChartData['line2'][] = (int)$oR->paid;
        }

        $oChart = new \Utility\Phantom_chart(
            ($this->aQuaryArray[2] == 'img' ? 400 : '100%'),
            300,
            $aChartData['label'] //array('4/1','4/2','4/3','4/4','4/5','4/6','4/7')
        );
        $oChart->addLinear(
            $aChartData['line1'], //array(3500,4000,3200,5000,4050,4800,4900),
            'Organic Likes',
            '#9ad2d5'
        );

        $oChart->addLinear(
            $aChartData['line2'], //array(1000,900,1500,2000,3000,1800,2000),
            'Paid Likes',
            '#ed7467'
        );

        return $oChart->show('AreaChart',$this->aQuaryArray[2],array('pointSize' => 0,'chartArea'=>array('left'=>45,'top'=>10,'width'=>'82%')));

    }

    public function RecentCommunityGrowth()
    {
        $aoData = \Utility\Db::query("select
                date_format(`Date`,'%m/%d') day,
                PageFans,
                PageFanAddsUnique
            from
                DataFb
            where
                ConnectionID = ? and
                `Date` between ? and ?
            order by `Date`",array($this->iConnection,$this->from,$this->to));

        $aChartData = array();
       
        foreach($aoData as $oR)
        {
            $aChartData['label'][] = $oR->day;
            $aChartData['line1'][] = (int)$oR->PageFans;            
            $aChartData['line2'][] = (int)$oR->PageFanAddsUnique;
        }

        /*print_r($aChartData);
        exit;*/
        
        $oChart = new \Utility\Phantom_chart(
            ($this->aQuaryArray[2] == 'img' ? 400 : '100%'),
            ($this->aQuaryArray[2] == 'img' ? 280 : 300),
            $aChartData['label'] //array('4/1','4/2','4/3','4/4','4/5','4/6','4/7')
        );
        $oChart->addLinear(
            $aChartData['line1'], //array(3500,4000,3200,5000,4050,4800,4900),
            'Total Fans',
            '#9ad2d5'
        );

        $oChart->addLinear(
            $aChartData['line2'], //array(1000,900,1500,2000,3000,1800,2000),
            'Net New Fans',
            '#ed7467'
        );

        return $oChart->show('ComboChart',$this->aQuaryArray[2],array('chartArea'=>array('left'=>45,'top'=>10,'width'=>'82%','height'=>'70%'),'legend'=>array('position'=>'in','alignment'=>'end'),'series' => array(array('targetAxisIndex'=>0),array('targetAxisIndex'=>1,'type'=>'bars'))));

    }


    public function ActiveDemographics()
    {
        $aoData = \Facebook_data::activeDemographicGroups($this->iConnection,$this->from,$this->to);

        $aChartData = array();
        foreach($aoData as $oR)
        {
            $aChartData['label'][] = \Facebook_data::$naming[$oR->Gender].' '.$oR->Age;
            $aChartData['line1'][] = (int)$oR->val;
        }

        $oChart = new \Utility\Phantom_chart(
            ($this->aQuaryArray[2] == 'img' ? 400 : '100%'),
            ($this->aQuaryArray[2] == 'img' ? 370 : 300),
            $aChartData['label'] //array('Male 13-17','Female 18-24','Male 25-34','Female 35-44','Male 25-34','Female 35-44','Male 45-54')
        );
        $oChart->addBar(
            $aChartData['line1'],
            'Avgs',
            '#ed7467',
            '0.8'
        );
        return $oChart->show('BarChart',$this->aQuaryArray[2]);

    }
    public function Communitygrowth()
    {
        $aoData = \Utility\Db::query("select
                date_format(`Date`,'%m/%d') day,
                PageEngagedUsers,
                PageStorytellers
            from
                DataFb
            where
                ConnectionID = ? and
                `Date` between ? and ?
            order by `Date`",array($this->iConnection,$this->from,$this->to));

        $aChartData = array();
        foreach($aoData as $oR)
        {
            $aChartData['label'][] = $oR->day;
            $aChartData['line1'][] = (int)$oR->PageEngagedUsers;
            $aChartData['line2'][] = (int)$oR->PageStorytellers;
        }

        $oChart = new \Utility\Phantom_chart(
            ($this->aQuaryArray[2] == 'img' ? 400 : '100%'),
            300,
            $aChartData['label'] //array('4/1','4/2','4/3','4/4','4/5','4/6','4/7')
        );
        $oChart->addLinear(
            $aChartData['line1'], //array(3500,4000,3200,5000,4050,4800,4900),
            'Engaged Users',
            '#9ad2d5'
        );

        $oChart->addLinear(
            $aChartData['line2'], //array(1000,900,1500,2000,3000,1800,2000),
            'Talking About',
            '#ed7467'
        );

        return $oChart->show('AreaChart',$this->aQuaryArray[2]);
    }

    public function Followergrowth($iUserId)
    {
        $aoData = \Utility\Db::query("select
                date_format(g.`date`,'%m/%d') day,
                g.FollowersCount NewFollowers
            from DataTwUser_followers_history g
            where
                g.DataTwUserID = ? and
                g.`date` between ? and ?
            group by g.`date`
            ",array($iUserId,$this->from,$this->to),true);

        $aChartData = array();
        foreach($aoData as $oR)
        {
            $aChartData['label'][] = $oR->day;
            $aChartData['line1'][] = (int)$oR->NewFollowers;
        }

        $oChart = new \Utility\Phantom_chart(
            ($this->aQuaryArray[2] == 'img' ? 400 : '100%'),
            200,
            $aChartData['label'] //array('4/1','4/2','4/3','4/4','4/5','4/6','4/7')
        );
        $oChart->addLinear(
            $aChartData['line1'], //array(3500,4000,3200,5000,4050,4800,4900),
            'New Followers',
            '#ed7467'
        );

        return $oChart->show('AreaChart',$this->aQuaryArray[2],array('chartArea'=>array('left'=>50,'top'=>10,'width'=>'87%','height'=>'65%')));
    }
}