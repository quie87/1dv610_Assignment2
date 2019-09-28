<?php

namespace model;

class AuthenticationModel {
    private $isLoggedIn = false;

    public function __construct() {
    }

    public function tryToLogin(\model\UserModel $userCredentials) {
        if ($userCredentials->getUserName() == 'Admin' && $userCredentials->getUserPassword() == 'Password') {
            return true;
        } else {
            return false;
        }
    }

    public function getIsUserLoggedIn() {
        return $this->isLoggedIn;
    }

    public function setIsUserLoggedIn (bool $state) {
        $this->isLoggedIn = $state;
    }

    public function saveUser($credentials) {
        // TODO: Save user to database
        if ($credentials->getUserName() == 'Admin') {
            throw new UserAllReadyExistException("User exists, pick another username.");
        }
        return;
    }

    public function logout() {
        $this->setIsUserLoggedIn(false);
    }
}