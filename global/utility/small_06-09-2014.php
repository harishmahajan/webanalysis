<?php
/**
 * Created by Indrek Päri
 * Date: 2.04.14 8:41
 */

namespace Utility;

class Small
{

    public static function date_decrease($d,$i)
    {
        $aParts = explode('-', $d);
        return date(
            'Y-m-d',
            mktime(0, 0, 0, $aParts[1], $aParts[2] - $i, $aParts[0])
        );
    }

}