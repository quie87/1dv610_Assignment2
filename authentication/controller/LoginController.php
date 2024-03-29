<?php

namespace controller;

class LoginController 
{
    private $view;
    private $authenticationModel;
    private $userStorage;

    public function __construct(\view\LoginView $view, \model\AuthenticationModel $authenticationModel, \model\UserStorage $userStorage)
    {
        $this->view = $view;
        $this->authenticationModel = $authenticationModel;
        $this->userStorage = $userStorage;
    }

    public function login() 
    {
        $credentials = $this->view->getUserCredentials();
        $this->authenticationModel->tryToLogin($credentials);

        if ($this->authenticationModel->getIsUserLoggedIn() && $credentials->getStayLoggedIn()) {
            $this->userStorage->saveUser($credentials); 
            $this->view->saveCookie($credentials);
            $this->view->setMessage('Welcome and you will be remembered');
            return true;
        } else if($this->authenticationModel->getIsUserLoggedIn()) {
            $this->view->setMessage('Welcome');
            $this->userStorage->saveUser($credentials);
            return true;
        } else {
            $this->view->setMessage('Wrong name or password');
            return false;
        }
    }

    public function loginWithCookie() 
    {
        $cookieCredentials = $this->view->getUserByCookie();
        $this->authenticationModel->tryToLogin($cookieCredentials);

        if($this->authenticationModel->getIsUserLoggedIn()) {
            $this->userStorage->saveUser($cookieCredentials);
            $this->view->setMessage('Welcome back with cookie');
            return true;
        } else {
            $this->view->setMessage('Cookie is wrong');
            return false;
        }
    }
    
    public function logout() 
    {
        $this->userStorage->destroySession();
        $this->view->removeCookie();
        $this->view->setMessage('Bye bye!');
        $this->authenticationModel->logout();
    }

}