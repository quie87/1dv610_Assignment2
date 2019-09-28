<?php

namespace controller;

use \model\UserNameToShortException;


class RegisterController {
    private $view;
    private $authenticationModel;

    public function __construct(\view\RegisterView $view, \model\AuthenticationModel $authenticationModel)
    {
        $this->view = $view;
        $this->authenticationModel = $authenticationModel;
    }

    public function registerNewUser() {
        $credentials = $this->view->getRegisterCredentials();

        try {
            $this->authenticationModel->saveUser($credentials);
        } catch (\model\UserNameToShortException $e){
            $this->view->setMessage($e);
        } 
    }
}