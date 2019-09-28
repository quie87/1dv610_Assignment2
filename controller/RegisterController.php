<?php

namespace controller;

use Exception;
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
        try {
            $credentials = $this->view->getRegisterCredentials();
        } catch (\model\UserNameToShortException $e){
            $this->view->setMessage($e->getMessage());
        } 
        try {
            $this->authenticationModel->saveUser($credentials);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong' . $e);
        }
    }
}