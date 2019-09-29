<?php

namespace controller;

use Exception;
use \model\UserNameToShortException;
use \model\PasswordIsToShortException;
use \model\PasswordDidNotMatchException;
use \model\UserAllReadyExistException;
use \model\UsernameAndPasswordEmpty;
use \model\UserHasInvalidCharacters;
use view\LoginView;

class RegisterController {
    private $view;
    private $loginview;
    private $authenticationModel;

    public function __construct(\view\RegisterView $view, \model\AuthenticationModel $authenticationModel)
    {
        $this->view = $view;
        $this->loginView = $loginview;
        $this->authenticationModel = $authenticationModel;
    }

    public function registerNewUser() {
        $success = false;
        
        try {
            $newUserCredentials = $this->view->getRegisterCredentials();
            $success = $this->authenticationModel->saveUser($newUserCredentials);
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
            $this->loginView->setMessage('Successful registration');
            header('Location: ./');
        } 
    }
}