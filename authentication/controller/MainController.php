<?php

namespace controller;

class MainController {
    private $loginView;
    private $dateTimeView;
    private $layoutView;
    private $registerView;

    private $authenticationModel;
    
    private $loginController;
    private $registerController;

    private $userStorage;    

    public function __construct()
    {
        $this->layoutView = new \view\LayoutView();
        $this->loginView = new \view\LoginView();
        $this->registerView = new \view\RegisterView();
        $this->dateTimeView = new \view\DateTimeView();
        
        $this->userStorage = new \model\UserStorage();
        $this->authenticationModel = new \model\AuthenticationModel();
        
        $this->loginController = new \controller\LoginController($this->loginView, $this->authenticationModel, $this->userStorage);
        $this->registerController = new \controller\RegisterController($this->registerView, $this->authenticationModel);
    }
    
    public function run() 
    {
        $this->changeState();
        $this->showOutput();
    }

    public function changeState() 
    {        
        if ($this->getLoggedInUser()) {
            $this->authenticationModel->setIsUserLoggedIn(true);
        } elseif ($this->loginView->userHasCookie()) {
            $this->authenticationModel->setIsUserLoggedIn($this->loginController->loginWithCookie());
        }

        if ($this->isLoggedIn()) {
            if ($this->loginView->userWantToLogout()) {
                $this->loginController->logout();
            }
        } else {
            if ($this->registerView->userWantToRegister()) {
                $this->registerController->registerNewUser();
            } elseif ($this->loginView->userWantToLogIn()) {
                $this->authenticationModel->setIsUserLoggedIn($this->loginController->login());
            }
        }            
    }
    
    
    public function showOutput()
    {
        $this->layoutView->render($this->authenticationModel->getIsUserLoggedIn(), $this->getHTML(), $this->getDateTimeView());
    }

    public function getHTML() 
    {
        if ($this->loginView->userNavigatesToRegister()) {
            return $this->registerView;
        } else {
            return $this->loginView;
        }
    }

    private function getLoggedInUser()
    {
        return $this->userStorage->loadUser();
    }

    public function isLoggedIn()
    {
        return $this->authenticationModel->getIsUserLoggedIn();
    }

    public function getLoggedInUserName()
    {
        $user = $this->userStorage->loadUser();
        return  $user->getUserName();
    }

    public function getDateTimeView()
    {
        return $this->dateTimeView;
    }
}