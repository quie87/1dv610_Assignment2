<?php

namespace controller;

use Exception;
use \model\UserNameToShortException;
use \model\PasswordIsToShortException;
use \model\PasswordDidNotMatchException;
use \model\UserAllReadyExistException;
use \model\UsernameAndPasswordEmpty;
use \model\UserHasInvalidCharacters;


class RegisterController {
    private $view;
    private $authenticationModel;

    public function __construct(\view\RegisterView $view, \model\AuthenticationModel $authenticationModel)
    {
        $this->view = $view;
        $this->authenticationModel = $authenticationModel;
    }

    public function registerNewUser() {
        $success = false;
        
        try {
            $newUserCredentials = $this->view->getRegisterCredentials();
            $newUser = new \model\RegistrationModel($newUserCredentials[0], $newUserCredentials[1], $newUserCredentials[2]);

            $success = $this->authenticationModel->saveUser($newUser);
        } catch (\model\UsernameAndPasswordEmpty $e) {
            $this->view->setMessage($e->getMessage());
        } catch (\model\UserNameToShortException $e){
            $this->view->setMessage($e->getMessage());
        } catch (\model\PasswordIsToShortException $e) {
            $this->view->setMessage($e->getMessage());
        } catch (\model\PasswordDidNotMatchException $e) {
            $this->view->setMessage($e->getMessage());
        } catch (\model\UserAllReadyExistException $e) {
            $this->view->setMessage($e->getMessage());
        } catch (\model\UserHasInvalidCharacters $e) {
            $this->view->setMessage($e->getMessage());
        } 
        
        if ($success) {
            $this->view->setMessage('Successful registration');
        } 
    }
}