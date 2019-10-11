<?php

require_once('AuthenticationApplication/AuthenticationApplication.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// Initiat the application
$app = new AuthenticationApplication();
$app->run();
