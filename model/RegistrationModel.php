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
        
        $this->userName = $this->applyFilter($userName);
        $this->password = $this->applyFilter($password);
        $this->repeatPassword = $this->applyFilter($repeatPassword);
        
        $this->validateInput($this->userName, $this->password, $this->repeatPassword);

    }

    private function validateInput ($name, $password, $repeatPassword) {
        if ((!$name && !$password && !$repeatPassword) || (!$name && !$password)) {
			throw new UsernameAndPasswordEmpty("Username has too few characters, at least 3 characters. <br> Password has too few characters, at least 6 characters.");
        }
        
        if (strlen($name) < $this->userNameLength) {
            throw new UserNameToShortException("Username has too few characters, at least 3 characters.");
        }

        if (strlen($password) < $this->passwordLength) {
            throw new PasswordIsToShortException("Password has too few characters, at least 6 characters.");
        }

        if (!$this->passwordMatch($password, $repeatPassword)) {
            throw new PasswordDidNotMatchException("Passwords do not match.");
        }

        // if (htmlspecialchars($this->userName)) {
        //     throw new UserHasInvalidCharacters("Username contains invalid characters.");
        // }
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

    private function passwordMatch($password, $repeatPassword) : bool {
        // $pwd = $this->getUserPassword();
        // $pwd2 = $this->getRepeatPassword();

        if ($password == $repeatPassword) {
            return true;
        } else {
            return false;
        }
    }

    public static function applyFilter(string $rawInput) : string {
        return trim(htmlentities($rawInput));
    } 
}