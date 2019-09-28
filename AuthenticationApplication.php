<?php

session_start(); 

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegistrationView.php');

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
    private $registrationView;

    private $authenticationModel;
    
    private $loginController;
    private $userStorage;
    private $cookie;

    private $isLoggedIn = false; // Get and uppdate this from authModel instead
    private $userWantsToRegister = false;
    

    public function __construct()
    {
        $this->layoutView = new LayoutView();
        $this->loginView = new \view\LoginView();
        $this->registrationView = new \view\RegistrationView();
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
        $userWantToLoggIn = $this->loginView->userWantToLogIn();
        
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
            if($this->loginView->userWantsToRegister()) {
                $this->userWantsToRegister = true;
            } else if ($userWantToLoggIn) {
                $this->isLoggedIn = $this->loginController->login();
            }
        }            
    }
    
	private function generateOutput() {
        // if ($this->userWantsToRegister) {
        //     $vts = $this->registrationView;
        // } else {
        //     $vts = $this->loginView;
        // }
        
        // $this->layoutView->render($this->isLoggedIn, $vts, $this->dateTimeView);


        if ($this->userWantsToRegister) {
            $this->layoutView->render($this->isLoggedIn, $this->registrationView, $this->dateTimeView);
        } else {
            $this->layoutView->render($this->isLoggedIn, $this->loginView, $this->dateTimeView);
        }
	}
}