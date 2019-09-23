<?php

namespace model;

class AuthenticationModel {
    private $isLoggedIn = false;
    private $userCredentials;

    public function __construct() {
    }

    public function tryToLogin(\model\UserModel $userCredentials) {
        // $this->isLoggedIn = true;
        return true;
    }

    public static function validateUserInput() {
        $this->isLoggedIn = true;
        return true;
    }

    public function getIsUserLoggedIn() {
        return $this->isLoggedIn;
    }

}