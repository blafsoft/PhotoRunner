<?php
//session_start();
//include('config/config.php');
include_once("src/Google_Client.php");
include_once("src/contrib/Google_Oauth2Service.php");
######### edit details ##########


$clientId = '276006470189-4323267sjl9bvitifku1gvdkol0u875h.apps.googleusercontent.com'; //Google CLIENT ID
$clientSecret = 'QbVfh4h8TFJWH42s7gStayus'; //Google CLIENT SECRET
$redirectUrl = 'https://test.photorunner.no/google_index.php';  //return url (url to script)
$homeUrl = 'https://test.photorunner.no/log-in.php';  //return to home


##################################

$gClient = new Google_Client();
$gClient->setApplicationName('Login to codexworld.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectUrl);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>
