<?php

session_start(); 

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');

require_once('model/DateTimeModel.php');
require_once('model/AuthenticationModel.php');
require_once('model/UserModel.php');
require_once('model/AuthenticationModel.php');
require_once('model/UserStorage.php');
require_once('model/Cookie.php');
require_once('model/RegistrationModel.php');

require_once('controller/LoginController.php');

class AuthenticationApplication {
    private $loginView;
    private $dateTimeView;
    private $layoutView;
    private $registerView;

    private $authenticationModel;
    
    private $loginController;
    private $userStorage;
    private $cookie;

    // private $isLoggedIn = false; // Get and uppdate this from authModel instead
    private $userWantsToRegister;
    

    public function __construct()
    {
        $this->layoutView = new LayoutView();
        $this->loginView = new \view\LoginView();
        $this->registerView = new \view\RegisterView();
        $this->dateTimeView = new DateTimeView();
        
        $this->userStorage = new \model\UserStorage();
        $this->cookie = new \model\Cookie();
        
        $this->authenticationModel = new \model\AuthenticationModel();
        $this->loginController = new \controller\LoginController($this->loginView, $this->authenticationModel, $this->userStorage);
    }
    
    public function run() {
        $this->changeState();
        $this->generateOutput();
    }

    
	private function changeState() {
        $userHasSession = $this->userStorage->loadUser();
        $userHasCookie = $this->cookie->userHasCookie();
        $userWantsToRegister = $this->layoutView->userWantsToRegister();
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
            if($userWantsToRegister) {
                $this->userWantsToRegister = true;
            } else if ($userWantToLoggIn) {
                $this->authenticationModel->setIsUserLoggedIn($this->loginController->login());
            }
        }            
    }
    
	private function generateOutput() {
        if ($this->userWantsToRegister) {
            $this->layoutView->render($this->authenticationModel->getIsUserLoggedIn(), $this->registerView, $this->dateTimeView);
        } else {
            $this->layoutView->render($this->authenticationModel->getIsUserLoggedIn(), $this->loginView, $this->dateTimeView);
        }
	}
}