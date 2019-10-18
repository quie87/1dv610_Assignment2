<?php

//INCLUDE THE FILES NEEDED...

# View
require_once('view/LayoutView.php');
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/RegisterView.php');

# model
require_once('model/AuthenticationModel.php');
require_once('model/UserModel.php');
require_once('model/AuthenticationModel.php');
require_once('model/UserStorage.php');
require_once('model/RegistrationModel.php');
require_once('model/Exceptions.php');

# Controller
require_once('controller/MainController.php');
require_once('controller/LoginController.php');
require_once('controller/RegisterController.php');

// Start session
session_start(); 

class AuthenticationApplication
{
    private $mainController;

    public function __construct()
    {   
        $this->mainController = new \controller\MainController();
    }

    public function runMainController()
    {
        return $this->mainController->run();
    }

    public function getMainController()
    {
        return $this->mainController;
    }

}