<?php

namespace model;

class AuthenticationModel {
    private $isLoggedIn = false;
    private $userCredentials;

    public function __construct() {
    }

    public function tryToLogin(\model\UserModel $userCredentials) {
        // var_dump($userCredentials);
        // $user = $this->validateUserInput();
        $this->isLoggedIn = true;
        return true;

        // if ($user === true) {
        //     return true;
        // } else {
        //     return false;
        // }
    }

    public static function validateUserInput() {
        $this->isLoggedIn = true;
        return true;
    }

    public function getIsUserLoggedIn() {
        return $this->isLoggedIn;
    }

}