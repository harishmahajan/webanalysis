<?php
/**
 * Created by Indrek Päri
 * Date: 20.03.14 17:16
 */

namespace Utility;

abstract class Autoloader
{
    public static function autoload($sClassName)
    {
        // straight match from include path
        if($sFileName = stream_resolve_include_path(strtolower($sClassName).'.php'))
        {
            include($sFileName);
            return true;
        }
        // namespaces
        elseif(is_file($sFileName='application/'.APPLICATION.'/'.str_replace('\\', '/', strtolower($sClassName)).'.php'))
        {
            include($sFileName);
            return true;
        }
        elseif(is_file($sFileName='global/'.str_replace('\\', '/', strtolower($sClassName)).'.php'))
        {
            include($sFileName);
            return true;
        }

        return false;
    }
}