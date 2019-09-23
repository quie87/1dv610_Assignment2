<?php

namespace model;

class AuthenticationModel {
    private $isLoggedIn = false;

    public function __construct() {
    }

    public function tryToLogin(\model\UserModel $userCredentials) {
        if ($userCredentials->getUserName() === 'Admin' && $userCredentials->getUserPassword() === 'Password') {
            return true;
        } else {
            return false;
        }
    }

    public function getIsUserLoggedIn() {
        return $this->isLoggedIn;
    }

    public function logout() {
        $this->isLoggedIn = false;
        return;
    }
}