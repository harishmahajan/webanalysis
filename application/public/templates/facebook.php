<?php
/**
 * Created by Indrek Päri
 * Date: 28.03.14 14:16
 */

class Facebook{

    private $iAccountId;
    private $iConnectionId;

    public function __construct($iAccountId, $pageID)
    {
        $this->iAccountId = $iAccountId;

        // select facebook connection
        if($oConnection = \Utility\Db::query("select ConnectionID from Connection where AccountID = ? and ExternalConnectionID = ? and type='facebook'",array($this->iAccountId, $pageID)))
        {
            $this->iConnectionId = $oConnection->ConnectionID;
        }
        else
        {
            \Utility\Db::query("INSERT INTO `Connection` (`AccountID`, `ExternalConnectionID`, `Type`) VALUES (?, ?, 'facebook')",array($this->iAccountId, $pageID));
            $this->iConnectionId = \Utility\Db::last_insert_id();
        }

    }

    public function updateminMax(){
        \Utility\Db::query("update
                `Connection` c
            left join ( select dat.ConnectionID, min(dat.Date) mi, max(dat.Date) ma from DataFb dat where dat.ConnectionID = ?) as d
            ON d.ConnectionID = c.ConnectionID
            set
                c.FromDate = d.mi,
                c.ToDate = d.ma
            where c.ConnectionID = ?",array($this->iConnectionId,$this->iConnectionId));
    }

    public function update_page_fans($aData)
    {
        if(empty($aData)) return;

        foreach($aData as $sDate => $iValue)
        {
            // we need to deduct 1 day from post date
            $new_date = date("Y-m-d", strtotime('-1 day', strtotime($sDate)));

            $iDataFbID = $this->getDataFbId($new_date);
            $this->_update_DataFb($iDataFbID,array('PageFans'=>$iValue));
        }
    }

    public function update_DataFb_Posts($aData)
    {
        if(empty($aData)) return;

        $iDataFbID = $this->getDataFbId($aData['day']);

        // remove old
        \Utility\Db::query("delete from `DataFb_Posts` where DataFbID = ? and `Post_id` = ?",array($iDataFbID, $aData['id']));

        // insert new
        \Utility\Db::query("INSERT INTO `DataFb_Posts` SET
            `DataFbID`= ?,
            `Post_id` = ?,
            `Post_link`=?,
            `Post_message`=?,
            `Post_story_adds`=?,
            `Post_impressions_unique`=?,
            `Post_impressions`=?,
            `Post_impressions_viral_unique`=?,
            `Post_impressions_fan_unique`=?,
            `Post_consumptions`=?,
            `Post_engaged_users`=?,
            `Post_like`=?,
            `Post_comment`=?,
            `Post_share`=?
        ",array(
            $iDataFbID,
            $aData['id'],
            $aData['link'],
            $aData['message'],
            $aData['post_story_adds'],
            $aData['post_impressions_unique'],
            $aData['post_impressions'],
            $aData['post_impressions_viral_unique'],
            $aData['post_impressions_fan_unique'],
            $aData['post_consumptions'],
            $aData['post_engaged_users'],
            (is_array($aData['post_stories_by_action_type'])?$aData['post_stories_by_action_type']['like']:$aData['post_stories_by_action_type']->like),
            (is_array($aData['post_stories_by_action_type'])?$aData['post_stories_by_action_type']['comment']:$aData['post_stories_by_action_type']->comment),
            (is_array($aData['post_stories_by_action_type'])?$aData['post_stories_by_action_type']['share']:$aData['post_stories_by_action_type']->share)
        ));
//\Utility\Db::query("delete from DataFb_Posts where Post_link is null and Post_story_adds=0 and Post_impressions_unique =0 and Post_impressions =0 and Post_impressions_fan_unique =0 and Post_consumptions =0 and Post_engaged_users =0 and Post_like is null and Post_comment is null and Post_share is null");
echo "hiua";
exit;

    }
    public function update_DataFb($aData)
    {
        $sqlFieldNameKeyMap = array(
            'page_storytellers' => 'PageStorytellers',
            'page_impressions_unique' => 'PageImpressionsUnique',
            'page_impressions' => 'PageImpressions',
            'page_engaged_users' => 'PageEngagedUsers',
            'page_fans_online_per_day' => 'PageFansOnlinePerDay',
            'page_impressions_paid' => 'PageImpressionsPaid',
            'page_impressions_organic' => 'PageImpressionsOrganic',
            'page_fan_removes' => 'PageFanRemoves',
            'page_fan_adds_unique' => 'PageFanAddsUnique',
            'page_consumptions' => 'PageConsumptions',
            'page_comment' => 'PageComment',
            'page_like' => 'PageLike',
            'page_link' => 'PageLink'
        );

        if(empty($aData)) return;

        $aDateNameValue = array();
        foreach($aData as $sName => $aValues)
        {
            foreach($aValues as $sDate => $iValue)
            {
                $aDateNameValue[$sDate][$sqlFieldNameKeyMap[$sName]] = (empty($iValue)?0:$iValue);
            }
        }

        foreach($aDateNameValue as $sDate => $aNameValue)
        {
            // we need to deduct 1 day from post date
            $new_date = date("Y-m-d", strtotime('-1 day', strtotime($sDate)));

            $iDataFbID = $this->getDataFbId($new_date);
            $this->_update_DataFb($iDataFbID,$aNameValue);
        }
    }

    public function update_page_fans_city($aData)
    {
        $this->_update_table('DataFb_PageFansCity','City','Value',$aData);
    }

    public function update_page_fans_country($aData)
    {
        $this->_update_table('DataFb_PageFansCountry','Country','Value',$aData);
    }
    public function update_page_views_external_referrals($aData)
    {
        $this->_update_table('DataFb_PageViewsExternalReferrals','Referral','Value',$aData);
    }
    public function update_page_fans_by_like_source($aData)
    {
        $this->_update_table('DataFb_PageFansByLikeSource','Source','Value',$aData);
    }

    public function update_page_fans_gender_age($aData)
    {
        $this->_update_table2('DataFb_PageFansGenderAge','Gender','Age','Value',$aData);
    }
    public function update_page_storytellers_by_age_gender($aData)
    {
        $this->_update_table2('DataFb_PageStorytellersByAgeGender','Gender','Age','Value',$aData);
    }

    private function _update_table($sTable, $sNameField, $sValueField, $aData)
    {
        foreach($aData as $sDate => $aValues)
        {
            $iDataFbID = $this->getDataFbId($sDate);

            // clean old
            \Utility\Db::query("delete from `".$sTable."` where DataFbID = ?",array($iDataFbID));

            // add new
            foreach($aValues as $sName => $iValue)
            {
                \Utility\Db::query("INSERT INTO `".$sTable."` (`DataFbID`, `".$sNameField."`, `".$sValueField."`) VALUES (?, ?, ?)",array($iDataFbID,$sName,$iValue));
            }

        }
    }
    private function _update_table2($sTable, $sNameField, $sNameField2, $sValueField, $aData)
    {
        foreach($aData as $sDate => $aValues)
        {
            $iDataFbID = $this->getDataFbId($sDate);

            // clean old
            \Utility\Db::query("delete from `".$sTable."` where DataFbID = ?",array($iDataFbID));

            // add new
            foreach($aValues as $sName => $iValue)
            {
                $key = explode( '.', $sName );
                \Utility\Db::query("INSERT INTO `".$sTable."` (`DataFbID`, `".$sNameField."`, `".$sNameField2."`, `".$sValueField."`) VALUES (?, ?, ?, ?)",array($iDataFbID,$key[0],$key[1],$iValue));
            }

        }
    }


    private function _update_DataFb($iDataFbID,$aData)
    {
        $sql = "update DataFb set LastUpdate = NOW()";
        $aValues = array();
        foreach($aData as $k => $v)
        {
            $sql .= ", `".$k."` = ? ";
            $aValues[] = $v;
        }
        $sql .= " where DataFbID = ? limit 1";
        $aValues[] = $iDataFbID;

        \Utility\Db::query($sql,$aValues);
    }

    private function getDataFbId($sDate)
    {
        if($oRow = \Utility\Db::query("select DataFbID from `DataFb` where ConnectionID = ? and Date = ?", array($this->iConnectionId, $sDate)))
        {
            //echo 'FOUND['.$this->iConnectionId.']: '.$sDate.PHP_EOL;
            return $oRow->DataFbID;
        }
        else
        {
            //echo 'ADDED['.$this->iConnectionId.']: '.$sDate.PHP_EOL;
            return $this->getCreateNewDay($sDate);
        }
    }

    private function getCreateNewDay($sDate)
    {
        // insert day
        \Utility\Db::query("INSERT INTO `DataFb` (`ConnectionID`, `Date`) VALUES (?, ?)",array($this->iConnectionId,$sDate));

        // return inserted id
        return \Utility\Db::last_insert_id();
    }


}