<?php

namespace controller;

use Exception;

class LoginController {
    private $view;
    private $authenticationModel;
    private $userStorage;
    private $cookie;

    public function __construct(\view\LoginView $view, \model\AuthenticationModel $authenticationModel, 
                                \model\UserStorage $userStorage, \model\Cookie $cookie)
    {
        $this->view = $view;
        $this->authenticationModel = $authenticationModel;
        $this->userStorage = $userStorage;
        $this->cookie = $cookie;
    }

    public function login() 
    {
        $credentials = $this->view->getUserCredentials();
        $isAuthenticated = $this->authenticationModel->tryToLogin($credentials);
        $wantsToSaveCredentials = $credentials->getStayLoggedIn();

        // TODO: Add try block on saving user to session and cookie
        if ($isAuthenticated && $wantsToSaveCredentials) {
            $this->userStorage->saveUser($credentials); 
            $this->cookie->saveCookie($credentials);
            $this->view->setMessage('Welcome and you will be remembered');
            return true;
        } else if($isAuthenticated) {
            $this->view->setMessage('Welcome');
            $this->userStorage->saveUser($credentials);
            return true;
        } else {
            $this->view->setMessage('Wrong name or password');
            return false;
        }
    }

    public function loginWithCookie() {
        $cookieCredentials = $this->cookie->getUserByCookie();
        throw new Exception('Not implemented yet');
        // return false;
        // $isAuthenticated = $this->authenticationModel->tryToLogin($cookieCredentials);

    }

    // Lägg till en funktion för registrering
    
    public function logout() {
        $this->userStorage->destroySession();
        $this->view->setMessage('Bye bye!');
        $this->authenticationModel->logout();
    }
}