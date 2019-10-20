<?php

namespace model;

class AuthenticationModel {
    private $isLoggedIn = false;
    private $database;

    public function __construct() 
    {
        $this->database = new \model\Database();
    }

    public function tryToLogin(\model\UserModel $userCredentials) {
        $username = $userCredentials->getUserName();
        $password = $userCredentials->getUserPassword();

        if ($this->database->validateUser($username, $password)) {
            $this->setIsUserLoggedIn(true);
        }
    }

    public function registerUser($credentials) {
        $username = $credentials->getUserName();
        $password = $credentials->getUserPassword();

        if ($this->database->doesUserExist($username))
        {
            throw new UserAllReadyExistException("User exists, pick another username.");
        } else {
            $this->database->saveUser($username, $password);
            return true;
        }
    }

    public function getIsUserLoggedIn() {
        return $this->isLoggedIn;
    }

    public function setIsUserLoggedIn (bool $state) {
        $this->isLoggedIn = $state;
    }

    public function logout() {
        $this->setIsUserLoggedIn(false);
    }
}