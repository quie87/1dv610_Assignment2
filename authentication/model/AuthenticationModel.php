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
        // $this->database->validateUser($userCredentials);
        //TODO: Search the database for existing user
    
        if ($userCredentials->getUserName() == 'Admin' && $userCredentials->getUserPassword() == 'Password') {
            $this->setIsUserLoggedIn(true);
        }
    }

    public function getIsUserLoggedIn() {
        return $this->isLoggedIn;
    }

    public function setIsUserLoggedIn (bool $state) {
        $this->isLoggedIn = $state;
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

    public function logout() {
        $this->setIsUserLoggedIn(false);
    }
}