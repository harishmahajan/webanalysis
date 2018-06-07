<?php
/**
 * Created by Indrek Päri
 * Date: 1.04.14 14:13
 */

class Connection{

    public static function getAccountConnections($iAccountID){
        return \Utility\Db::query("select ConnectionID, AccountID, Name, ExternalConnectionID, Type, FromDate, ToDate from Connection where AccountID = ?", array($iAccountID), true);
    }
    public static function getFacebookConnection($iAccountID){        
        return \Utility\Db::query("select ConnectionID, AccountID, Name, ExternalConnectionID, Type, FromDate, ToDate from Connection where AccountID = ? and Type = ?", array($iAccountID,'facebook'));
    }

    public static function updateConnectionExtData($iConnectionID,$aData)
    {
        \Utility\Db::query("update Connection set ExternalConnectionData = ? where ConnectionID = ? limit 1",array(json_encode($aData),$iConnectionID));
    }

}