<?php

namespace controller;

use Exception;

class LoginController {
    private $view;
    private $authenticationModel;
    private $userStorage;

    public function __construct(\view\LoginView $view, \model\AuthenticationModel $authenticationModel, \model\UserStorage $userStorage)
    {
        $this->view = $view;
        $this->authenticationModel = $authenticationModel;
        $this->userStorage = $userStorage;
    }

    public function login() {
        $credentials = $this->view->getUserCredentials();

        $isAuthenticated = $this->authenticationModel->tryToLogin($credentials);

        if ($isAuthenticated && $this->view->getStayLoggedIn()) {
            // Get the username as a model of user
            // $this->userStorage->saveUser($name);
            $this->view->setMessage('Welcome and you will be remembered');
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
        $this->userStorage->destroySession();
        $this->view->setMessage('Bye bye!');
        $this->authenticationModel->logout();
    }
}