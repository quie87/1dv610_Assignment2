<?php

namespace controller;

class AuthController {

    private static $name;
    private static $password;
    private static $keep;
    private $user;
    private $view;
    private $loginModal;

    public function __construct(\model\UserModel $user, \view\LoginView $view)
    {
        $this->user = $user;
        $this->view = $view;
        $this->loginModal = new \model\LoginModel($this->user);
    }

    public function tryToLoginUser() {
        if ($this->view->userWantToLogIn()) {
            $this->loginUser();
        }
    }
    
    private function loginUser() {
        $this->getUserCredentials();
        // $this->setUserCredentials();

        return $this->validateUserLoginCredentials();
    }

    private function validateUserLoginCredentials() {
        $user = \model\LoginModel::validateUserInput();
            if ($user === true) {
                return true;
            } else {
                return false;
            }
    }

    private function getUserCredentials() {
        self::$name = $this->view->getUserName();
        self::$password = $this->view->getUserPassword();
        // self::$keep = $this->view->getUserKeep(); //getUserKeep funkar inte just nu
        // var_dump(self::$name . self::$password);
    }

    private function setUserCredentials() {
        $this->user->setUserName();
        $this->saveUserCredentialsToDB();
        $this->saveUserCredentialsSession();
    }

    private function saveUserCredentialsToDB() {
        throw new Exception('Not implemented yet');
    }

    private function saveUserCredentialsSession() {
        throw new Exception('Not implemented yet');
    }

    private function getUserFromSession(){
        throw new Exception('Not implemented yet');
    }
}