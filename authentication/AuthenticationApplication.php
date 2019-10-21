<?php

//INCLUDE THE FILES NEEDED...

# View
require_once('view/LayoutView.php');
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/RegisterView.php');

# model
require_once('model/AuthenticationModel.php');
require_once('model/DataBase.php');
require_once('model/UserModel.php');
require_once('model/AuthenticationModel.php');
require_once('model/UserStorage.php');
require_once('model/RegistrationModel.php');
require_once('model/Exceptions.php');

# Controller
require_once('controller/MainController.php');
require_once('controller/LoginController.php');
require_once('controller/RegisterController.php');

#Config
require_once('LocalSettings.php');
require_once('ProductionSettings.php');

// Start session
session_start(); 

class AuthenticationApplication
{
    private $mainController;

    public function __construct()
    {   
        $this->mainController = new \controller\MainController();
    }

    /**
     * Function to be called if the application is to be runned on its own
     * @return controller\MainController - And calls its Run function
     */
    public function runMainController()
    {
        return $this->mainController->run();
    }

    /**
     * Funktion to be called if the application is to be user together with
     * a nother application.
     * @return controller\MainController
     */
    public function getMainController()
    {
        return $this->mainController;
    }

}