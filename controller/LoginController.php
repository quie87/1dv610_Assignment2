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
        $credentials = $this->view->getUserCredentials();
        $this->authenticationModel->tryToLogin($credentials);
        var_dump($credentials);
        // $this->setUserCredentials();
        // $this->validateUserLoginCredentials();
    }
}