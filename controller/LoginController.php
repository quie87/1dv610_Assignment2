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
        $credentials = $this->view->getUserCredentials();

        $isAuthenticated = $this->authenticationModel->tryToLogin($credentials);

        if ($isAuthenticated && $this->view->getStayLoggedIn()) {
            $this->view->setMessage('Welcome and what ever this should say');
            //save to cookie
            return true;
        } else if($isAuthenticated) {
            $this->view->setMessage('Welcome');
            return true;
        } else {
            $this->view->setMessage('Wrong name or password');
            return false;
        }
    }

    // Lägg till en funktion som sparar session/cookie eller vad nu behövs
    
    public function logout() {
        $this->view->setMessage('Bye bye!');
        $this->authenticationModel->logout();
    }
}