<?php

namespace model;

class RegistrationModel {
    private $userName;
    private $password;
    private $repeatPassword;

    private $userNameLength = 3;
    private $passwordLength = 6;

    public function __construct(string $userName, string $password, string $repeatPassword)
    {
        $this->checkIfContainsInvalidCharacters($userName);
        
        $this->userName = $this->applyFilter($userName);
        $this->password = $this->applyFilter($password);
        $this->repeatPassword = $this->applyFilter($repeatPassword);

        if (strlen($this->userName) < $this->userNameLength) {
            throw new UserNameToShortException("Username has too few characters, at least 3 characters.");
        }
        if (strlen($this->password) < $this->passwordLength) {
            throw new PasswordIsToShortException("Password has too few characters, at least 6 characters.");
        }
        if (!$this->passwordMatch()) {
            throw new PasswordDidNotMatchException("Passwords do not match.");
        }
    }

    public function getUserName() {
        return $this->userName;
    }

    public function getUserPassword() {
        return $this->password;
    }

    public function getRepeatPassword() {
        return $this->repeatPassword;
    }

    private function checkIfContainsInvalidCharacters(string $userName) : bool { 
        return $userName != strip_tags($userName) ? true : false; 
    }

    private function passwordMatch() : bool {
        $pwd = $this->getUserPassword();
        $pwd2 = $this->getRepeatPassword();

        return ($pwd == $pwd2) ? true: false;
    }

    public static function applyFilter(string $rawInput) : string {
        return trim(htmlentities($rawInput));
    } 
}