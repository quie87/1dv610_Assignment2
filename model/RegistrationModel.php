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
        $this->validateNewUserCredentials($userName, $password, $repeatPassword);

        $this->userName = $this->applyFilter($userName);
        $this->password = $this->applyFilter($password);
        $this->repeatPassword = $this->applyFilter($repeatPassword);

    }

    private function validateNewUserCredentials($userName, $password, $repeatPassword) {
        if ($this->checkIfContainsInvalidCharacters($userName)) {
            throw new UserHasInvalidCharacters('Username contains invalid characters.');
        }

        if (strlen($userName) < $this->userNameLength) {
            throw new UserNameToShortException("Username has too few characters, at least 3 characters.");
        }
        if (strlen($password) < $this->passwordLength) {
            throw new PasswordIsToShortException("Password has too few characters, at least 6 characters.");
        }
        if (!$this->passwordMatch($password, $repeatPassword)) {
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
        return $userName != htmlspecialchars($userName) ? true : false; 
    }

    private function passwordMatch($password, $repeatPassword) : bool {
        return $password == $repeatPassword ? true : false;
    }

    public static function applyFilter(string $rawInput) : string {
        return trim(htmlentities($rawInput));
    } 
}