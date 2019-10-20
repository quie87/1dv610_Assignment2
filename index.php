<?php

require_once('Application.php');
require_once('MainView.php');
require_once('authentication/AuthenticationApplication.php');
require_once('todoApplication/todoApp.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
// error_reporting(E_ALL);
// ini_set('display_errors', 'On');
// ini_set('display_startup_errors', 'on');

$app = new Appliction();
$app->run();
