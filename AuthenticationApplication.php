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
        $this->user = new model\UserModel('', '', false);
        $this->layoutView = new LayoutView();
        $this->loginView = new view\LoginView();
        $this->dateTimeView = new DateTimeView();
        $this->controller = new \controller\AuthController($this->user, $this->loginView);
    }

    public function run() {
        $this->changeState();
        $this->generateOutput();
    }

    
	private function changeState() {
        //change this. Varible "userIsAuthenticated" should not be used. Try get this information from the Userobject in session instead.
        // If no user in session, then try to either Register a user or signin depending on what the user is trying to do.

        if ($this->user->getKeepOnline()) {
            return;
        } else {
            $this->controller->tryToLoginUser();
            // var_dump($this->user); // -------------------------------------------------------------------------------------Var_dump here
            // Save user function
        }
    }
    
	private function generateOutput() {
        $this->layoutView->render($this->user->getKeepOnline(), $this->loginView, $this->dateTimeView);
	}
}