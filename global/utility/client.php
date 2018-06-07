<?php
/**
 * Created by Indrek Päri
 * Date: 21.03.14 14:12
 */

namespace Utility;

class Client
{
    private static function getClientDetails($sName)
    {
        return ( isset($_SESSION['authorized']->$sName) ? $_SESSION['authorized']->$sName : false );
    }

    public static function getClientId()
    {
        return self::getClientDetails('ClientID');
    }

    public static function getFullName()
    {
        return self::getClientDetails('Firstname').' '.self::getClientDetails('Lastname');
    }

    public static function getEmail()
    {
        return self::getClientDetails('Email');
    }

    public static function isLoggedIn()
    {
        // we kill the session if no activity in the last 30 minutes
        if(isset($_SESSION['_last_activity']) && (time() - $_SESSION['_last_activity'] > 3600))
        {
            self::logOut();
        }
        else
        {
            $_SESSION['_last_activity'] = time(); // update last activity time stamp
        }

        return isset($_SESSION['authorized']);
    }

    public static function register($sFirstname, $sLastname, $sEmail, $sPassword)
    {
        // lets avoid duplicate accounts
        if( $oClient = \Utility\Db::query("select 1 from `Client` where Email = ? limit 1", array($sEmail)) )
        {
            return false;
        }
        else
        {
            \Utility\Db::query("INSERT INTO `Client` (`Firstname`, `Lastname`, `Email`, `Password`, `Active`) VALUES (?, ?, ?, ?, 1)",array(
                $sFirstname, $sLastname, $sEmail, sha1($sPassword)
            ));

            self::logIn($sEmail, $sPassword);
        }
    }

    public static function logIn($sEmail, $sPassword)
    {
        if( $oLoginData = \Utility\Db::query("
            select
                c.ClientID,
                c.Firstname,
                c.Lastname,
                c.Email
            from
                Client c
            where
                c.Active = 1 and
                c.Email = ? and
                c.Password = ?
            limit 1",
            array(
                $sEmail,
                sha1($sPassword)
            )
        ))
        {
            // client is logged in
            $_SESSION['authorized'] = $oLoginData;

            \Utility\Url::phpRedirect();
        }

        return false;
    }
    public static function logOut()
    {
        $_SESSION['authorized'] = array();
        unset($_SESSION['authorized']);

        // regenerate session id
        session_regenerate_id(true);

        session_unset();
        session_destroy();

        ///\Utility\Url::phpRedirect('log/in/');
        header('Location: http://'.$_SERVER['HTTP_HOST'].'/log/in');
        //echo "log out";
        exit();
    }
}