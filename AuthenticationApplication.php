<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/DateTimeModel.php');
require_once('model/AuthenticationModel.php');
require_once('model/UserModel.php');
require_once('controller/LoginController.php');
require_once('model/AuthenticationModel.php');

class AuthenticationApplication {
    private $loginView;
    private $dateTimeView;
    private $layoutView;
    private $loginController;
    private $isLoggedIn;
    private $authenticationModel;

    public function __construct()
    {
        $this->layoutView = new LayoutView();
        $this->loginView = new view\LoginView();
        $this->dateTimeView = new DateTimeView();
        $this->authenticationModel = new \model\AuthenticationModel();
        $this->loginController = new \controller\LoginController($this->loginView, $this->authenticationModel);
    }
    
    public function run() {
        $this->changeState();
        $this->generateOutput();
    }

    
	private function changeState() {
        $this->isLoggedIn = $this->authenticationModel->getIsUserLoggedIn();
        // TODO: Implement function to see if there is a session and a function to see if there is a cookie saved. Aka, if there is a user stored
        // If no session and no cookie, check if user wants to register or tries to login
        // if (!$this->isLoggedIn && $this->loginView->userWantToLogIn) {
        // } else {
        //     $this->registerController->register();
        // }
        if (!$this->isLoggedIn) {
            $wantToLoggIn = $this->loginView->userWantToLogIn();
            
            if($wantToLoggIn) {
                $this->isLoggedIn = $this->loginController->login();
            }
            //else $this->registerController->register();
        }
    }
    
	private function generateOutput() {
        $this->layoutView->render($this->isLoggedIn, $this->loginView, $this->dateTimeView);
	}
}