<?php

namespace controller;

class LoginController {

    private static $name;
    private static $password;
    private static $stayLoggedIn;
    private $user;
    private $view;
    private $authenticationModel;

    public function __construct(\view\LoginView $view)
    {
        // $this->user = $user;
        $this->view = $view;
        $this->authenticationModel = new \model\AuthenticationModel();
    }

    public function tryToLoginUser() {
        if ($this->view->userWantToLogIn()) {
            $this->loginUser();
        }
    }
    
    private function loginUser() {
        // $this->getUserCredentials();
        $credentials = $this->view->getUserCredentials();
        // var_dump($credentials);
        // $this->setUserCredentials();
        $this->authenticationModel->tryToLogin($credentials);
        // $this->validateUserLoginCredentials();
    }

    
    private function getUserCredentials() {
        self::$name = $this->view->getUserName();
        self::$password = $this->view->getUserPassword();
        self::$stayLoggedIn = $this->view->getStayLoggedIn();
        var_dump(self::$name . '<br>' . self::$password . '<br>' . self::$stayLoggedIn);
    }

}