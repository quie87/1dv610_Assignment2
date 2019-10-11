<?php

namespace model;

class AuthenticationModel {
    private $isLoggedIn = false;

    public function __construct() {
    }

    public function tryToLogin(\model\UserModel $userCredentials) {
        //TODO: Search the database for existing user
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
        } else {
            return true;
        }
    }

    public function logout() {
        $this->setIsUserLoggedIn(false);
    }
}