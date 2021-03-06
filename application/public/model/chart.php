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
        $sFrom=$this->from." 00:00:00";
        $To=$this->to." 23:59:59";

        $aoData = \Utility\Db::query("select date_format(CreatedAt,'%m/%d') day,sum(IsMention) as mentions from webanalysis.`DataTwMentation` where ConnectionID=? and CreatedAt between ? and ? group by DATE_FORMAT(CreatedAt, '%Y/%m/%d')",array($this->iConnection,$sFrom,$To),true);

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
        if($this->aQuaryArray[2] != 'img')
            return $oChart->show('AreaChart',$this->aQuaryArray[2],array('fontSize'=> array('10'),'chartArea'=>array('left'=>45,'top'=>10,'width'=>'82%'),'series' => array(array('targetAxisIndex'=>0),array('targetAxisIndex'=>0),array('targetAxisIndex'=>1,'type'=>'bars'))));
        else
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
            return $oChart->show('PieChart',$this->aQuaryArray[2],array('colors' => array('#9ad2d5','#ed7467','#59c16a','#f9d34e','#8f44c8'),'legend' => array('position' => 'none','textStyle'=>'fontSize: 8}')));

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
        $aChartData = array();
        $temp = array();
        $aoData = \Utility\Db::query("select date_format(f.`Date`,'%m/%d') day,sum(s1.Value) as free from webanalysis.DataFb as f,webanalysis.DataFb_PageFansByLikeSource as s1 where f.DataFbID=s1.DataFbID and s1. source in('api','fan_context_story','feed_chaining','feed_pyml','hovercard',
                'invitations','like_story','mobile','mobile_page_browser','mobile_page_suggestions_on_liking','needy_page_suggestion_megaphone','page_browser','page_browser_chaining',
                'page_invite_escape_hatch','page_profile','photo_snowlift','recommended_pages','reminder_box_invite','reminder_box_invite_like_all','reminder_box_recommendation','search',
                'sponsored_story','ticker','timeline','timeline_collection','external_connect','favorites') and s1.DataFbID in(select DataFbID from webanalysis.DataFb where ConnectionID=?  and Date between ? and ?) group by f.DataFbID order by f.Date",array($this->iConnection,$this->from,$this->to));
        $aoData1 = \Utility\Db::query("select date_format(f.`Date`,'%m/%d') day,sum(s1.Value) as paid from webanalysis.DataFb as f,webanalysis.DataFb_PageFansByLikeSource as s1 where f.DataFbID=s1.DataFbID and s1. source in ('ads','mobile_ads') and s1.DataFbID in(select DataFbID from webanalysis.DataFb where ConnectionID=?  and Date between ? and ?) group by f.DataFbID order by f.Date",array($this->iConnection,$this->from,$this->to));

        if(count($aoData)>count($aoData1))
            $MAX=count($aoData);
        else
            $MAX=count($aoData1);
        for ($i=0; $i < $MAX; $i++) 
        { 
            if(count($aoData)>count($aoData1))
                $aChartData['label'][] = $aoData[$i]->day;
            else
                $aChartData['label'][] = $aoData1[$i]->day;

            if(!empty($aoData[$i]->free))
                $aChartData['line1'][] = (int)$aoData[$i]->free;
            else
                $aChartData['line1'][] =0;

            if(!empty($aoData1[$i]->paid))
                $aChartData['line2'][] = (int)$aoData1[$i]->paid;
            else
                $aChartData['line2'][] =0;          
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
        if($this->aQuaryArray[2] != 'img')
            return $oChart->show('ComboChart',$this->aQuaryArray[2],array('fontSize'=> array('10'),'chartArea'=>array('left'=>45,'top'=>10,'width'=>'82%','height'=>'70%'),'legend'=>array('position'=>'in','alignment'=>'end'),'series' => array(array('targetAxisIndex'=>0),array('targetAxisIndex'=>1,'type'=>'bars'))));
        else
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
        $sFrom=$this->from." 00:00:00";
        $To=$this->to." 23:59:59";

        $aoData = \Utility\Db::query("select date_format(CreatedAt,'%m/%d') day,FollowersCount NewFollowers from webanalysis.DataTwMentation where ConnectionID = ? and CreatedAt between ? and ? group by day;",array($iUserId,$sFrom,$To),true);

        $aChartData = array();
        foreach($aoData as $oR)
        {
            $aChartData['label'][] = $oR->day;
            $aChartData['line1'][] = (int)$oR->NewFollowers;
        }

        $oChart = new \Utility\Phantom_chart(
            ($this->aQuaryArray[2] == 'img' ? 400 : '100%'),
            ($this->aQuaryArray[2] == 'img' ? 220 : 200),
            $aChartData['label'] //array('4/1','4/2','4/3','4/4','4/5','4/6','4/7')
        );
        $oChart->addLinear(
            $aChartData['line1'], //array(3500,4000,3200,5000,4050,4800,4900),
            'New Followers',
            '#ed7467'
        );
        if($this->aQuaryArray[2] != 'img')
            return $oChart->show('LineChart',$this->aQuaryArray[2],array('chartArea'=>array('left'=>50,'top'=>10,'width'=>'87%','height'=>'65%')));
        else
            return $oChart->show('LineChart',$this->aQuaryArray[2],array('legend' => array('position' => 'none'),'chartArea'=>array('left'=>50,'top'=>10,'width'=>'87%','height'=>'80%')));        
    }
}