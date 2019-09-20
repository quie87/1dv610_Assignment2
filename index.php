<?php

//INCLUDE THE FILES NEEDED...
// require_once('View/LoginView.php');
// require_once('View/DateTimeView.php');
// require_once('View/LayoutView.php');
// require_once('Model/DateTimeModel.php');
// require_once('Model/LoginModal.php');
// require_once('Controller/AuthenticationController.php');
require_once('AuthenticationApplication.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');


//CREATE OBJECTS OF THE VIEWS
// $v = new LoginView();
// $dtv = new DateTimeView();
// $lv = new LayoutView();
// $auth = new AuthenticationController($v);

// $userIsAuthenticated = $auth->checkForUserInput();

// Kolla med controllern om användaren är inloggad, i så fall skicka med "true" i anropet nedan "$lv->render($userloggedinornot, $v, $dtv)"


// $lv->render($userIsAuthenticated, $v, $dtv);

$app = new AuthenticationApplication();
$app->run();
