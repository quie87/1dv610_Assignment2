<?php

use model\UserStorage;

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

require_once('controller/LoginController.php');

class AuthenticationApplication {
    private $loginView;
    private $dateTimeView;
    private $layoutView;

    private $authenticationModel;
    
    private $loginController;
    private $userStorage;
    private $cookie;
    
    private $isLoggedIn = false;
    

    public function __construct()
    {
        $this->layoutView = new LayoutView();
        $this->loginView = new view\LoginView();
        $this->dateTimeView = new DateTimeView();
        $this->userStorage = new \model\UserStorage();
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
        
        // Temporary code to get session working
        if($userHasSession) {
            $this->isLoggedIn = true;
        } 
        
        if ($this->isLoggedIn) {
            if ($this->loginView->userWantToLogout()) {
                $this->loginController->logout();
                $this->isLoggedIn = false;
            }
        } else {
            if ($userWantToLoggIn){
                $this->isLoggedIn = $this->loginController->login();
                $this->userStorage->saveUser($this->loginView->getUserCredentials());
                
            } 
        }
        
        // Code to use when session is working. Then continue with cookie
        // if ($userHasSession) {
        //     $this->isLoggedIn = true;
        // } else if (!$this->isLoggedIn && !$this->cookie->getCookie()) {
        //     $wantToLoggIn = $this->loginView->userWantToLogIn();
            
        //     if($wantToLoggIn) {
        //         $this->isLoggedIn = $this->loginController->login();
        //     }
        //     //else if $this->registerController->WantsToRegister();
        //     // $this->registerController->register();

        // } else if (!$this->isLoggedIn && $this->cooki->getCookie) {
        //     $this->isLoggedIn = true;
        // } else if ($this->isLoggedIn) {
        //     // First make sure that the user have clicked the logoutbutton
        //     $this->loginController->logout();
        // }else {
        //     throw new Exception('Something went wrong');
        // }

        // TODO: Implement function to see if there is a session and a function to see if there is a cookie saved. Aka, if there is a user stored
        // If no session and no cookie, check if user wants to register or tries to login
        // if (!$this->isLoggedIn && $this->loginView->userWantToLogIn) {
            
    }
    
	private function generateOutput() {
        $this->layoutView->render($this->isLoggedIn, $this->loginView, $this->dateTimeView);
	}
}