<?php

namespace model;

class AuthenticationModel {
    private $isLoggedIn;
    private $userCredentials;

    public function __construct() {
    }

    public function tryToLogin(\model\UserModel $userCredentials) {
        // var_dump($userCredentials);
        $user = $this->validateUserInput();

        if ($user === true) {
            return true;
        } else {
            return false;
        }
    }

    public static function validateUserInput() {
        return true;
    }

    private function checkIfThereIsAUserName() {

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