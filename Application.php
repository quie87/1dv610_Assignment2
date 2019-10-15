<?php

session_start(); 

//INCLUDE THE FILES NEEDED...
require_once('LayoutView.php');
require_once('authentication/view/LoginView.php');
require_once('authentication/view/DateTimeView.php');
require_once('authentication/view/RegisterView.php');

require_once('authentication/model/DateTimeModel.php');
require_once('authentication/model/AuthenticationModel.php');
require_once('authentication/model/UserModel.php');
require_once('authentication/model/AuthenticationModel.php');
require_once('authentication/model/UserStorage.php');
require_once('authentication/model/RegistrationModel.php');
require_once('authentication/model/Exceptions.php');

require_once('authentication/controller/LoginController.php');
require_once('authentication/controller/RegisterController.php');

class Application {
    private $loginView;
    private $dateTimeView;
    private $layoutView;
    private $registerView;

    private $authenticationModel;
    
    private $loginController;
    private $registerController;

    private $userStorage;

    private $userNavigatesToRegister;
    

    public function __construct()
    {
        $this->layoutView = new LayoutView();
        $this->loginView = new \view\LoginView();
        $this->registerView = new \view\RegisterView();
        $this->dateTimeView = new DateTimeView();
        
        $this->userStorage = new \model\UserStorage();
        $this->authenticationModel = new \model\AuthenticationModel();
        
        $this->loginController = new \controller\LoginController($this->loginView, $this->authenticationModel, $this->userStorage);
        $this->registerController = new \controller\RegisterController($this->registerView, $this->authenticationModel);
    }
    
    public function run() {
        $this->changeState();
        $this->generateOutput();
    }

    
	private function changeState() {
        $userHasSession = $this->userStorage->loadUser();
        $userHasCookie = $this->loginView->userHasCookie();

        $this->userNavigatesToRegister = $this->layoutView->userNavigatesToRegister();

        $userWantToRegister = $this->registerView->userWantToRegister();
        $userWantToLoggIn = $this->loginView->userWantToLogIn();
        
        if($userHasSession) {
            $this->authenticationModel->setIsUserLoggedIn(true);
        } else if ($userHasCookie){
            $this->authenticationModel->setIsUserLoggedIn($this->loginController->loginWithCookie());
        }

        if ($this->authenticationModel->getIsUserLoggedIn()) {
            if ($this->loginView->userWantToLogout()) {
                $this->loginController->logout();
            }
        } else {
            if($userWantToRegister) {
                $this->registerController->registerNewUser();
            } else if ($userWantToLoggIn) {
                $this->authenticationModel->setIsUserLoggedIn($this->loginController->login());
            }
        }            
    }
    
	private function generateOutput() {
        if ($this->userNavigatesToRegister) {
            $this->layoutView->render($this->authenticationModel->getIsUserLoggedIn(), $this->registerView, $this->dateTimeView);
        } else {
            $this->layoutView->render($this->authenticationModel->getIsUserLoggedIn(), $this->loginView, $this->dateTimeView);
        }
	}
}