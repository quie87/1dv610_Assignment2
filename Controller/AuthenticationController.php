<?php

use \Modal\LoginModal;

class AuthenticationController {

    private $view;
    private $user;

    public function __construct($view)
    {
        $this->view = $view;
    }

    function checkForUserInput() {
        // $user = LoginModal::validateUserInput($this->view::getRequestUserName());
        // var_dump($user);
        $user = LoginModal::validateUserInput();

        // if($this->view->userWantToRegister) {
        //     throw new Exception('not implemented yet');
        // } else if ($this->view->userWantsToLogIn) {
        // }
                if ($user === true) {
                    return true;
                } else {
                    return false;
                }

    }
}