<?php

namespace model;

use Exception;

class LoginModel {
    private $user;

    public function __construct(\model\UserModel $user)
    {
        $this->user = $user;
    }

    public static function validateUserInput() {
        return true;
    }

    private function checkIfUserInputName() {
        if (strlen($this->user) > 2) {
            return true;
        } else {
            throw new Exception('Username is to short');
        }
    }
}