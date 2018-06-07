<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
	define('APPLICATION', 'public');
	chdir('/var/www/');

	require_once('application/'.APPLICATION.'/config.php');
	class delete_account_cron 
	{
		
		function __construct()
		{
			$date=date("Y/m/d",strtotime("-29 days"));
			$cutDate=date("Y/m/d");

			//echo "current date: ".$cutDate." -30 date ".$date;
			//get Account ids
			$AccountID = \Utility\Db::query("select AccountID from webanalysis.Account where IsActive=0 and DeactiveDate < '$date'",array());
			print_r($AccountID);
			foreach ($AccountID as $value) {
				$AccountIDstr.=$value->AccountID.",";
			}

			$AccountIDstr=substr($AccountIDstr, 0, -1);
			
			//get connection id
			$connectionid=\Utility\Db::query("select ConnectionID,ExternalConnectionID from webanalysis.Connection where AccountID in ($AccountIDstr)",array());
			foreach ($connectionid as $value) {
				$connectionidstr.=$value->ConnectionID.",";
				$ExternalConnectionIDstr.=$value->ExternalConnectionID.",";
			}
			$connectionidstr=substr($connectionidstr, 0, -1);
			$ExternalConnectionIDstr=substr($ExternalConnectionIDstr, 0, -1);
			echo $connectionidstr.PHP_EOL;
			echo $ExternalConnectionIDstr.PHP_EOL;

			//twitter

			//DataTwMentation
			\Utility\Db::query("delete from webanalysis.DataTwMentation where ConnectionID in ($connectionidstr)",array());

			//DataTwTweet
			\Utility\Db::query("delete from webanalysis.DataTwTweet where ConnectionID in ($connectionidstr)",array());
			
			//DataTwUser_followers_history
			\Utility\Db::query("delete from webanalysis.DataTwUser_followers_history where DataTwUserID in (select DataTwUserID webanalysis.DataTwUser where TwUserID in ($ExternalConnectionIDstr))",array());

			//DataTwUser
			\Utility\Db::query("delete from webanalysis.DataTwUser where TwUserID in ($ExternalConnectionIDstr)",array());

			//facebook

									
			$FBID = \Utility\Db::query("select DataFbID from webanalysis.DataFb where ConnectionID in ($connectionidstr)",array());			
			foreach ($FBID as $value) {
				$FBIDstr.=$value->DataFbID.",";
			}
			$FBIDstr=substr($FBIDstr, 0, -1);
			echo $FBIDstr.PHP_EOL;
			//DataFb_PageFansByLikeSource   
			\Utility\Db::query("delete from webanalysis.DataFb_PageFansByLikeSource where DataFbID in ($FBIDstr)",array());
			
			//DataFb_PageFansCity    
			\Utility\Db::query("delete from webanalysis.DataFb_PageFansCity where DataFbID in ($FBIDstr)",array());
			
			//DataFb_PageFansCountry    
			\Utility\Db::query("delete from webanalysis.DataFb_PageFansCountry where DataFbID in ($FBIDstr)",array());
			
			//DataFb_PageFansGenderAge    
			\Utility\Db::query("delete from webanalysis.DataFb_PageFansGenderAge where DataFbID in ($FBIDstr)",array());
			
			//DataFb_PageStorytellersByAgeGender    
			\Utility\Db::query("delete from webanalysis.DataFb_PageStorytellersByAgeGender where DataFbID in ($FBIDstr)",array());
			
			//DataFb_PageViewsExternalReferrals    
			\Utility\Db::query("delete from webanalysis.DataFb_PageViewsExternalReferrals where DataFbID in ($FBIDstr)",array());
			
			//DataFb_Posts    
			\Utility\Db::query("delete from webanalysis.DataFb_Posts where DataFbID in ($FBIDstr)",array());
			
			//DataFb
			\Utility\Db::query("delete from webanalysis.DataFb where ConnectionID in ($connectionidstr)",array());

			//Connection delete
			\Utility\Db::query("delete from webanalysis.Connection where ConnectionID in ($connectionidstr)",array());

			//account delete
			\Utility\Db::query("delete from webanalysis.Account where IsActive=0 and DeactiveDate < '$date'",array());
		}
	}

	$obj= new delete_account_cron();
	
?>