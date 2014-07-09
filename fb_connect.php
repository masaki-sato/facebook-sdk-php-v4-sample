<?php
session_start();

require_once('vendor/autoload.php');

use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequestException;
use Facebook\FacebookSession;

if($_GET['error'] == 'access_denied'){
    echo 'access_denied';
    exit();
}
FacebookSession::setDefaultApplication('YOUR FACEBOOK ID', 'YOUR FACEBOOK SECRET');

try {
    $helper = new FacebookRedirectLoginHelper('http://test.com/facebook-sdk-php-v4-sample/fb_connect.php');
    $session = $helper->getSessionFromRedirect();
} catch(FacebookRequestException $ex) {
    // When Facebook returns an error
    var_dump($ex);
} catch(Exception $ex) {
    // When validation fails or other local issues
    var_dump($ex);
}
if ($session) {
    echo 'Login!<br>';
    echo $session->getAccessToken();
}