<?php
/**
 * Created by Indrek Päri
 * Date: 20.03.14 17:09
 */

error_reporting(1);
error_reporting(E_ALL & ~E_NOTICE);

//define('WEBROOT', 'http://webanalysis.co/');
//define('WEBROOT', 'http://localhost/webanalysis/');
define('WEBROOT', 'webanalysis.mybluemix.net/');
define('ADMIN','indrek.pari@devlab.ee');

$_dbhost = 'us-cdbr-iron-east-03.cleardb.net';
$_dbuser = 'b6e33f46feda20';
$_dbpass = '8a9e8cc5';
$_dbname = 'ad_5190e5be64d2882';

// $_dbhost = 'localhost';

// $_dbuser = 'root';
// $_dbpass = 'jack123';
// $_dbname = 'webanalysis';

// $_dbhost = 'localhost';
// $_dbuser = 'webanal';
// $_dbpass = '34&TwgrweDFwe4%';
// $_dbname = 'webanalysis';

date_default_timezone_set('America/Los_Angeles');

include('utility/autoloader.php');
spl_autoload_register('\Utility\Autoloader::autoload');

define('TWITTER_OAUTH_CALLBACK', WEBROOT.'twitter/callback');
define('TWITTER_CONSUMER_KEY', 'S2fiSzaWweR1nZH0tAEu5WtEd');
define('TWITTER_CONSUMER_SECRET', 'iMH4pzz3UGxFOPoTW5UGwQAkXIllaZMB5lIt6eWAZjl39NlMqH');

define('FACEBOOK_APP_ID', '483975525054185');
define('FACEBOOK_APP_SECRET', '0324ef96769de8de5deddefedd912758');