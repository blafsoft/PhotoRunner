<?php
ob_start();
session_start();

/*define( 'DB_HOST', 'localhost' );
define( 'DB_USERNAME', 'anaadit');
define( 'DB_PASSWORD', 'L@rryCP14');
define( 'DB_NAME', 'db_photorunner');*/

error_reporting(E_ALL);
ini_set('display_errors', 1);

define( 'DB_HOST', 'photorunnerdb.cwehmqf1ahbp.eu-west-1.rds.amazonaws.com' );
define( 'DB_USERNAME', 'photorunner');
define( 'DB_PASSWORD', 'p6Fu8nS6TEADgoW');
define( 'DB_NAME', 'photorunner');


if (!defined("PAGILIMIT")) define("PAGILIMIT", 20);

if (!defined("APP_NAME")) define("APP_NAME", "Photo Runner");
if (!defined("ADMIN_EMAIL")) define("ADMIN_EMAIL", "info@photorunner.no");

if (!defined("APP_FOLDER")) define("APP_FOLDER", "");
if (!defined("APP_ROOT")) define("APP_ROOT", $_SERVER["DOCUMENT_ROOT"]."/".APP_FOLDER);
if (!defined("APP_URL")) define("APP_URL", "http://".$_SERVER["HTTP_HOST"]."/".APP_FOLDER);
if (!defined("APP_FULL_URL")) define("APP_FULL_URL", "http://".$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']);

define('REAL_IMAGE', APP_ROOT."uploads/photos/real/");
//define('WATERMARK_IMAGE', APP_ROOT."uploads/photos/watermark/");
define('WATERMARK_IMAGE', "https://s3-eu-west-1.amazonaws.com/photorunner.thumb/");
//define('BIGWATERMARK_IMAGE', APP_ROOT."uploads/photos/bigwatermark/");
define('BIGWATERMARK_IMAGE', "http://photorunner.view.s3-website-eu-west-1.amazonaws.com/");
define('DESIGN_IMAGE', "https://s3-eu-west-1.amazonaws.com/photorunner.design/");


//function __autoload($class)
//{
//	$parts = end(explode('_', $class));
//	require_once APP_ROOT.'include/' . $parts . '.php';
//}

require_once(APP_ROOT.'include/aws-autoloader.php');


$msgs  = new Cl_Messages();
$common  = new Cl_Common();

?>
