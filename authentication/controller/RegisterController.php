<?php

namespace controller;

use Exception;
use \model\UserNameToShortException;
use \model\PasswordIsToShortException;
use \model\PasswordDidNotMatchException;
use \model\UserAllReadyExistException;
use \model\UsernameAndPasswordEmpty;
use \model\UserHasInvalidCharacters;

class RegisterController 
{
    private $rv;
    private $authenticationModel;

    public function __construct(\view\RegisterView $rv, \model\AuthenticationModel $authenticationModel)
    {
        $this->rv = $rv;
        $this->authenticationModel = $authenticationModel;
    }

    public function registerNewUser() {
        $successfulRegistration = false;

        try {
            $newUserCredentials = $this->rv->getRegisterCredentials();
            $successfulRegistration = $this->authenticationModel->saveUser($newUserCredentials);
        } catch (\model\UsernameAndPasswordEmpty $e) {
            $this->rv->setMessage($e->getMessage());
        } catch (\model\UserNameToShortException $e){
            $this->rv->setMessage($e->getMessage());
        } catch (\model\PasswordIsToShortException $e) {
            $this->rv->setMessage($e->getMessage());
        } catch (\model\PasswordDidNotMatchException $e) {
            $this->rv->setMessage($e->getMessage());
        } catch (\model\UserAllReadyExistException $e) {
            $this->rv->setMessage($e->getMessage());
        } catch (\model\UserHasInvalidCharacters $e) {
            $this->rv->setMessage($e->getMessage());
        } 

        if ($successfulRegistration) {
            $this->rv->succesfulRegistration();
        }
    }
}