<?php

//INCLUDE THE FILES NEEDED...
require_once('View/LoginView.php');
require_once('View/DateTimeView.php');
require_once('View/LayoutView.php');
require_once('Model/DateTimeModel.php');
require_once('Model/LoginModal.php');
require_once('Controller/AuthenticationController.php');

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
        $this->controller = new AuthenticationController($this->loginView);
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