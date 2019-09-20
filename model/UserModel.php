<?php

// require error handler

class UserModel {
    private static $minNameLength = 2;
    private $name = null;
    private $password = null;

    public function __construct(string $userName, string $password)
    {
        $this->name = $this->applyFilter($userName);
        $this->password = $password;

        if(strlen($this->name) < self::$minNameLength) {
            throw new Exception('Name is to short');
        }
    }

    public function setName(UserName $userName) {
        $this->name = $userName->getUserName();
    }

    public function getUserName() {
        return $this->name;
    }

    public function setPassWord(UserPassWord $password) {
        $this->password = $password->getPassWord();
    }

    public static function applyFilter(string $rawInput) : string {
        return trim(htmlentities($rawInput));
    }
}