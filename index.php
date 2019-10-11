<?php

require_once('authenticationApplication/AuthenticationApplication.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'on');

// Initiat the application
$app = new AuthenticationApplication();
$app->run();
