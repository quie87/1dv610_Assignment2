<?php

namespace controller;

use Exception;
use \model\UserNameToShortException;
use \model\PasswordIsToShortException;
use \model\PasswordDidNotMatchException;
use \model\UserAllReadyExistException;


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
            $credentials = $this->view->getRegisterCredentials();
            $success = $this->authenticationModel->saveUser($credentials);
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