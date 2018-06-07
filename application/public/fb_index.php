#!/usr/bin/php
<?php
set_time_limit(0);

define('APPLICATION', 'public');
chdir('/var/www/');

require('application/'.APPLICATION.'/fb_controller.php');

