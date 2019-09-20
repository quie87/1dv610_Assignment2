<?php

class UserModel {
    private $userID = '';
    private $userName = '';
    private $passWord = '';
    private $users = (object) array(
        'admin' => '12345'
    );


    //var_dump($users->{'admin'});

    // public function __construct($userName, $passWord) {
    //     $this->userName = $userName;
    //     $this->passWord = $passWord;

    public function compareUserCredentials($userNameInput, $passWordInput) {
        $this->findUser($userNameInput);

        throw new Exception('Not implemented yet');
    }

    private function findUser($userNameInput) {
        throw new Exception('Not implemented yet');
    }

    public function getUserName() {
        return $this->userName;
    }

    public function setUserName() {
        throw new Exception('Not implemented yet');
    }

    public function setPassWord() {
        throw new Exception('Not implemented yet');
    }
}