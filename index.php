<?php

require_once('Application.php');
require_once('todoApplication/todoApp.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'on');

// Initiat the application
$app = new Application();
$app->run();

// $app = new TodoApp();
// $app->run();