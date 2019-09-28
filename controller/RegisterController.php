<?php

namespace controller;

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
            $this->authenticationModel->saveUser();
        } catch (\Exception $e){
            throw new \Exception('Failed to add new user' . $e);
        }
    }
}