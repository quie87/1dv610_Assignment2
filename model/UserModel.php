<?php

// require error handler
namespace model;

class UserModel {
    private $name = null;
    private $password = null;
    private $keep = false;

    public function __construct(string $userName, string $password, bool $stay)
    {
        $this->name = $this->applyFilter($userName);
        $this->password = $password;
        $this->keep = $stay;
    }
    
    public function getUserName() {
        return $this->name;
    }

    public function setUserName(UserModel $newName) {
        $this->name = $newName->getUserName();
    }

    public function getUserPassword() {
        return $this->password;
    }

    public function setUserPassword(UserModel $password) {
        $this->password = $password->getUserPassword();
    }

    public function getKeepOnline() {
        return $this->keep;
    }
    
    public function setKeepOnline(UserModel $keep) {
        $this->keep = $keep->getKeepOnline();
    }

    public static function applyFilter(string $rawInput) : string {
        return trim(htmlentities($rawInput));
    }
}