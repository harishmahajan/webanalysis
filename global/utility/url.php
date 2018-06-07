<?php
/**
 * Created by Indrek Päri
 * Date: 21.03.14 14:31
 */

namespace Utility;

class Url
{
    public static function build($sPath = '')
    {
        return WEBROOT . trim($sPath,'/');
    }

    public static function phpRedirect($sTo = '')
    {
        //header('Location: '.self::build($sTo));
    
        header('Location: '.$sTo);
        exit();
    }

    public static function phpRedirectTo($sTo = '')
    {
        header('Location: '.$sTo);
        exit();
    }

}