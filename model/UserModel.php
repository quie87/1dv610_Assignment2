<?php

// require error handler
namespace Model;

class UserModel {
    // private static $minNameLength = 2;
    private $name;

    public function __construct(string $userName)
    {
        $this->name = $this->applyFilter($userName);

        // if(strlen($this->name) < self::$minNameLength) {
        //     throw new Exception('Name is to short');
        // }
    }

    public function setUserName(UserModel $newName) {
        $this->name = $newName;
    }

    public function getUserName() {
        return $this->name;
    }

    public static function applyFilter(string $rawInput) : string {
        return trim(htmlentities($rawInput));
    }
}