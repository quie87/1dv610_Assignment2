<?php

namespace model;

class UserModel {
    private $userName;
    private $password;
    private $stayLoggedIn;

    public function __construct(string $userName, string $password, bool $stay)
    {
        $this->userName = $this->applyFilter($userName);
        $this->password = $this->applyFilter($password);
        $this->stayLoggedIn = $stay;
    }
    
    public function getUserName() {
        return $this->userName;
    }

    public function getUserPassword() {
        return $this->password;
    }

    public function getStayLoggedIn() : bool {
        return $this->stayLoggedIn;
    }

    public static function applyFilter(string $rawInput) : string {
        $input = htmlspecialchars($rawInput);
        return trim(htmlentities($input));
    }
}