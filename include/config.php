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
define( 'DB_HOST', 'test.photorunner.no' );
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

define('UPLOADED_IMAGE', APP_URL."uploads/photos/real/");
define('WATERMARK_IMAGE', "https://s3-eu-west-1.amazonaws.com/photorunner.thumb/");
define('BIGWATERMARK_IMAGE', "https://s3-eu-west-1.amazonaws.com/photorunner.view/");
define('DESIGN_IMAGE', APP_URL."uploads/photos/real/");
define('GALLERY_IMAGE', "https://s3-eu-west-1.amazonaws.com/photorunner.gallery/");
define('PROFILE_IMAGE', "https://s3-eu-west-1.amazonaws.com/photorunner.profile/");

if(!empty($ENV['MODE'])){
    define('MODE', $ENV['MODE']);
} else {
    define('MODE', 'dev'); //mode can be test, prod or dev
}


if(MODE == 'prod') {
    define('SECRET_KEY', 'sk_live_f0Zb65LFbH3jQV4zGbzb1AMV');
    define('PUBLISHABLE_KEY', 'pk_live_obp9GmiNdWLl0DWA5wYW6rCv');
} else {
    define('SECRET_KEY', 'sk_test_xitA2poC7TfjnP1IGD0FT6rp');
    define('PUBLISHABLE_KEY', 'pk_test_inM99ehBADdrzRTf3wa3ggu2');
}


require_once(APP_ROOT.'include/aws-autoloader.php');


$msgs  = new Cl_Messages();
$common  = new Cl_Common();

?>
