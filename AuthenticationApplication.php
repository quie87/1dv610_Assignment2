<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/DateTimeModel.php');
require_once('model/LoginModel.php');
require_once('model/UserModel.php');
require_once('controller/AuthController.php');

class AuthenticationApplication {
    private $user;
    private $loginView;
    private $dateTimeView;
    private $layoutView;
    private $controller;
    private $userIsAuthenticated;

    public function __construct()
    {
        $this->user = new model\UserModel('Default');
        $this->loginView = new view\LoginView($this->user);
        $this->dateTimeView = new DateTimeView();
        $this->layoutView = new LayoutView();
        $this->controller = new \controller\AuthController($this->user, $this->loginView);
    }

    public function run() {
        $this->changeState();
        $this->generateOutput();
    }

    
	private function changeState() {
        if ($this->userIsAuthenticated) {
            return;
        } else {
            $this->userIsAuthenticated = $this->controller->checkForUserInput();
            // Save user function
        }
    }
    
	private function generateOutput() {
        $this->layoutView->render($this->userIsAuthenticated, $this->loginView, $this->dateTimeView);
	}
}