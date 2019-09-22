<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/DateTimeModel.php');
require_once('model/AuthenticationModel.php');
require_once('model/UserModel.php');
require_once('controller/LoginController.php');

class AuthenticationApplication {
    private $loginView;
    private $dateTimeView;
    private $layoutView;
    private $loginController;
    private $isLoggedIn;

    public function __construct()
    {
        $this->layoutView = new LayoutView();
        $this->loginView = new view\LoginView();
        $this->dateTimeView = new DateTimeView();
        $this->loginController = new \controller\LoginController($this->loginView);
    }
    
    public function run() {
        $this->changeState();
        $this->generateOutput();
    }

    
	private function changeState() {
        $this->isLoggedIn = $this->loginController->tryToLoginUser();        
    }
    
	private function generateOutput() {
        $this->layoutView->render($this->isLoggedIn, $this->loginView, $this->dateTimeView);
	}
}