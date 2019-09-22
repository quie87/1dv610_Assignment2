<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/DateTimeModel.php');
require_once('model/LoginModel.php');
require_once('model/UserModel.php');
require_once('controller/LoginController.php');

class AuthenticationApplication {
    private $user;
    private $loginView;
    private $dateTimeView;
    private $layoutView;
    private $loginController;

    public function __construct()
    {
        $this->user = new model\UserModel('', '', false);
        $this->layoutView = new LayoutView();
        $this->loginView = new view\LoginView();
        $this->loginController = new \controller\LoginController($this->user, $this->loginView);
    }
    
    public function run() {
        $this->dateTimeView = new DateTimeView();
        $this->changeState();
        $this->generateOutput();
    }

    
	private function changeState() {
        $isLoggedIn = $this->loginController->tryToLoginUser();
            // var_dump($this->user); // -------------------------------------------------------------------------------------Var_dump here
            // Save user function
        
    }
    
	private function generateOutput() {
        $this->layoutView->render($this->user->getKeepOnline(), $this->loginView, $this->dateTimeView);
	}
}