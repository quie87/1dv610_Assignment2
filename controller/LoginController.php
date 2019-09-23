<?php

namespace controller;

use Exception;

class LoginController {
    private $view;
    private $authenticationModel;

    public function __construct(\view\LoginView $view, \model\AuthenticationModel $authenticationModel)
    {
        $this->view = $view;
        $this->authenticationModel = $authenticationModel;
    }

    public function login() {
        // $this->getValidUserInput();
        $credentials = $this->view->getUserCredentials();

        $isAuthenticated = $this->authenticationModel->tryToLogin($credentials);
        if($isAuthenticated) {
            return true;
        } else {
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
}