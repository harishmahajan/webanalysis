<?php
/**
 * Created by Indrek Päri
 * Date: 08/05/14 13:05
 */

exec('sudo phantomjs --debug=true /var/www/html/pha/cap.js 2>&1',$o);
print_r($o);