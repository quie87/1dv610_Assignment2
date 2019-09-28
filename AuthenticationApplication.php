<?php

session_start(); 

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');

require_once('model/DateTimeModel.php');
require_once('model/AuthenticationModel.php');
require_once('model/UserModel.php');
require_once('model/AuthenticationModel.php');
require_once('model/UserStorage.php');
require_once('model/Cookie.php');

require_once('controller/LoginController.php');

class AuthenticationApplication {
    private $loginView;
    private $dateTimeView;
    private $layoutView;

    private $authenticationModel;
    
    private $loginController;
    private $userStorage;
    private $cookie;

    private $isLoggedIn = false; // Get and uppdate this from authModel instead 
    

    public function __construct()
    {
        $this->layoutView = new LayoutView();
        $this->loginView = new \view\LoginView();
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
        $userWantToLoggIn = $this->loginView->userWantToLogIn();
        $userHasCookie = $this->cookie->userHasCookie();
        
        if($userHasSession) {
            $this->isLoggedIn = true;
        } else if ($userHasCookie){
            $this->isLoggedIn = $this->loginController->loginWithCookie();
        }

        if ($this->isLoggedIn) {
            if ($this->loginView->userWantToLogout()) {
                $this->loginController->logout();
                $this->isLoggedIn = false;
            }
        } else {
            if ($userWantToLoggIn){
                $this->isLoggedIn = $this->loginController->login();
            } // put the registration here
        }            
    }
    
	private function generateOutput() {
        $this->layoutView->render($this->isLoggedIn, $this->loginView, $this->dateTimeView);
	}
}