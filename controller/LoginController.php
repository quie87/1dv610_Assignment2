<?php

namespace controller;

use Exception;

class LoginController {
    private $view;
    private $authenticationModel;

    public function __construct(\view\LoginView $view)
    {
        $this->view = $view;
        $this->authenticationModel = new \model\AuthenticationModel();
    }

    public function doesUserWantToLogin() {
        if ($this->view->userWantToLogIn()) {
            $this->tryToLoginUser();
        }
    }
    
    private function tryToLoginUser() {
        // $this->getValidUserInput();
        $credentials = $this->view->getUserCredentials();

        if ($this->authenticationModel->tryToLogin($credentials)) {
            return true;
        } else {
            $this->view->setMessage('Wrong name or password');
            return false;
        }
        
    }
    
    private function getValidUserInput() {
        // Hämta credentials. Kolla så de är korrekta. I så fall se till så att login kommer åt den datan
        $credentials = $this->view->getUserCredentials();
        if ($this->verifyCredentials($credentials)) {
            return true;
        } else {
            $this->view->setMessage('Wrong name or password');
            return false;
        }
    }

    private function verifyCredentials($credentials) {
        $this->verifyUserName($credentials);
        $this->verifyPassword($credentials);
    }

    private function verifyPassword($credentials) {
        return;
    }
}