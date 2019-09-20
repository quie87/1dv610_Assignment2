<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/DateTimeModel.php');
require_once('model/LoginModel.php');
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
        $this->loginView = new LoginView();
        $this->dateTimeView = new DateTimeView();
        $this->layoutView = new LayoutView();
        $this->controller = new AuthController($this->loginView);
    }

    public function run() {
        $this->changeState();
        $this->generateOutput();
    }

    
	private function changeState() {
        $this->userIsAuthenticated = $this->controller->checkForUserInput();
    }
    
	private function generateOutput() {
        $this->layoutView->render($this->userIsAuthenticated, $this->loginView, $this->dateTimeView);
	}
}