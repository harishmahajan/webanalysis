<?php
/**
 * Created by Indrek Päri
 * Date: 20.03.14 17:21
 */

require_once('global/config.php');

// add include path
set_include_path(
    implode(
        PATH_SEPARATOR,
        array(
            get_include_path(),
            'application/'.APPLICATION.'/classes/',
        )
    )
);