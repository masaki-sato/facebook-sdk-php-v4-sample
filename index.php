<?php
session_start();

require_once('vendor/autoload.php');

use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSession;

echo 'login page<br>';

$scope = array('email');

FacebookSession::setDefaultApplication('YOUR FACEBOOK ID', 'YOUR FACEBOOK SECRET');

try{
    $helper = new FacebookRedirectLoginHelper('http://test.com/facebook-sdk-php-v4-sample/fb_connect.php');
    $loginUrl = $helper->getLoginUrl();
}catch (Exception $ex){
    echo $ex->getMessage();
}

if($helper->getSessionFromRedirect()){
    echo 'logged in';
}else{
    echo '<a href="'.$helper->getLoginUrl().'">Login with facebook</a>';
}