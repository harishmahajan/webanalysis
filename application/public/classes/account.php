<?php
/**
 * Created by Indrek Päri
 * Date: 25.03.14 14:55
 */
class Account{   

    public static function isMyAccount($iClientID,$iAccountID){
        return \Utility\Db::query("select AccountID from `Account` where ClientID = ? and AccountID = ?", array($iClientID,$iAccountID));
    }
    public static function getName($iAccountID){
        $oR = \Utility\Db::query("select Name from `Account` where AccountID = ?", array($iAccountID));
        return $oR->Name;
    }
    public static function getClientAccounts($iClientID){
        return \Utility\Db::query("select AccountID, Name from `Account` where ClientID = ? and IsActive=1 order by Name", array($iClientID), true);
    }  

 public static function isDeletedAccountName($iClientID,$sAccountName)
    {
//echo "client id".$iClientID." sAccountName".$sAccountName."<br>";
	return(\Utility\Db::query("select AccountID from `Account` where ClientID = ? and  Name = ? and IsActive=0", array($iClientID,$sAccountName)) ? false : true);

    }
 
    public static function isUniqueAccountName($iClientID,$sAccountName)
    {
        return (\Utility\Db::query("select AccountID from `Account` where ClientID = ? and  Name = ?", array($iClientID,$sAccountName)) ? false : true);
//echo "client id".$iClientID." sAccountName".$sAccountName."<br>";
	
    }

    public static function GetErrors($acid)
    {
        $ConErrors = array();
        $ConErrors["ConErr"]=\Utility\Db::query("select * from webanalysis.ConnectionError where AccountID = ? and Hide=0", array($acid));

        $ConErrors["FbNullTok"]=\Utility\Db::query("select 1 from webanalysis.Connection where AccountID = ? and ExternalConnectionData is null", array($acid));

        return $ConErrors;
    }

    public static function HideErrors($acid)
    {
        \Utility\Db::query("update webanalysis.ConnectionError set Hide=1 where AccountID = ?", array($acid));
    }

    public static function addNew($iClientID,$sAccountName='',$timezone){

        if(empty($sAccountName))
            throw new \DataException('Account name cannot be empty!');
    	if(!self::isDeletedAccountName($iClientID,$sAccountName))
    	{
    		\Utility\Db::query("update `Account` set IsActive=1 where ClientID=? and Name=?", array($iClientID,$sAccountName));
    		\Utility\Url::phpRedirect('/dashboard/view/');
    	}
    	else
    	{
    		if(!self::isUniqueAccountName($iClientID,$sAccountName))
            {			
    		    throw new \DataException('This account name already in use. Please create another account name.');	
            }
            {
        		\Utility\Db::query("INSERT INTO `Account` (`ClientID`, `Name`,Timezone) VALUES (?, ?, ?)", array($iClientID,$sAccountName,$timezone));

        		return \Utility\Db::last_insert_id();
            }
    	}
            
    }

    public static function DeleteAccount($acid)
    {
        $now=date('Y-m-d');
        \Utility\Db::query("update webanalysis.Account set IsActive=0 ,DeactiveDate = '$now' where AccountID = ?", array($acid));        
        \Utility\Db::query("update webanalysis.Connection set IsActive=0 ,DeactiveDate = '$now' where AccountID = ?", array($acid));
        return 1;
    }

}
