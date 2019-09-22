<?php

namespace model;

class AuthenticationModel {
    private $isLoggedIn;

    public function __construct() {}

    public function tryToLogin($credentials) {
        $user = $this->validateUserInput($credentials);

        if ($user === true) {
            return true;
        } else {
            return false;
        }
    }

    public static function validateUserInput($credentials) {
        return true;
    }

    private function setUserCredentials() {
        // $this->user->setUserName();
        // $this->saveUserCredentialsToDB();
        // $this->saveUserCredentialsSession();
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