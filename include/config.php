<?php
ob_start();
session_start();

/*define( 'DB_HOST', 'localhost' );
define( 'DB_USERNAME', 'anaadit');
define( 'DB_PASSWORD', 'L@rryCP14');
define( 'DB_NAME', 'db_photorunner');*/

error_reporting(E_ALL);
ini_set('display_errors', 1);

//define( 'DB_HOST', 'photorunnerdb.cwehmqf1ahbp.eu-west-1.rds.amazonaws.com' );
define( 'DB_HOST', 'photorunner.mysql.domeneshop.no' );
define( 'DB_USERNAME', 'photorunner');
define( 'DB_PASSWORD', 'p6Fu8nS6TEADgoW');
define( 'DB_NAME', 'photorunner');


if (!defined("PAGILIMIT")) define("PAGILIMIT", 20);

if (!defined("APP_NAME")) define("APP_NAME", "Photo Runner");
if (!defined("ADMIN_EMAIL")) define("ADMIN_EMAIL", "info@photorunner.no");


$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? "https" : "http";


if (!defined("APP_FOLDER")) define("APP_FOLDER", "");
if (!defined("APP_ROOT")) define("APP_ROOT", $_SERVER["DOCUMENT_ROOT"]."/".APP_FOLDER);
if (!defined("APP_URL")) define("APP_URL", $protocol."://".$_SERVER["HTTP_HOST"]."/".APP_FOLDER);
if (!defined("APP_FULL_URL")) define("APP_FULL_URL", $protocol."://".$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']);

define('UPLOADED_IMAGE', "/tmp/");
define('WATERMARK_IMAGE', "https://s3-eu-west-1.amazonaws.com/photorunner.thumb/");
define('BIGWATERMARK_IMAGE', "https://s3-eu-west-1.amazonaws.com/photorunner.view/");
define('DESIGN_IMAGE', "https://s3-eu-west-1.amazonaws.com/photorunner.design/");
define('GALLERY_IMAGE', "https://s3-eu-west-1.amazonaws.com/photorunner.gallery/");
define('PROFILE_IMAGE', "https://s3-eu-west-1.amazonaws.com/photorunner.profile/");

require_once(APP_ROOT.'include/aws-autoloader.php');


$msgs  = new Cl_Messages();
$common  = new Cl_Common();

?>
