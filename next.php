<?php

session_start();

require_once('vendor/autoload.php');

use Facebook\FacebookRequest;
use Facebook\FacebookSession;
use Facebook\GraphUser;

FacebookSession::setDefaultApplication('YOUR FACEBOOK ID', 'YOUR FACEBOOK SECRET');

$session = new FacebookSession('YOUR ACCESS TOKEN');

if($session){
    echo 'logged in by access token.<br>';

    try{
        echo 'use graph api.';
        $request = new FacebookRequest($session, 'GET', '/me');
        $response = $request->execute();
        $graphObject = $response->getGraphObject();
        var_dump($graphObject);
        echo '--------<br>';

        echo 'use graph api another method.';
        $me = (new FacebookRequest(
            $session, 'GET', '/me'
        ))->execute()->getGraphObject(GraphUser::className());
        var_dump($me);
        echo '--------<br>';

        echo 'use graph api.fb_exchange_token.';
        $request = new FacebookRequest($session,'GET','/oauth/access_token',array(
            'grant_type' => 'fb_exchange_token',
            'client_id' => 'YOUR FACEBOOK ID',
            'client_secret' => 'YOUR FACEBOOK SECRET',
            'fb_exchange_token' => 'YOUR ACCESS TOKEN'
        ));
        $response = $request->execute();
        if ($response){
            $graphObject = $response->getGraphObject();
            var_dump($graphObject);
        }else{
            echo 'failed.';
        }
        echo '--------<br>';

    }catch (Exception $ex){
        var_dump($ex);
    }
}