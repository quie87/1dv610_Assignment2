<?php

namespace controller;

class AuthController {

    // private $user;
    private $view;

    public function __construct(\model\UserModel $user, \view\LoginView $view)
    {
        $this->user = $user;
        $this->view = $view;
    }

    function checkForUserInput() {
        // Kolla om en användare finns - Hämta först från session och sedan från formuläret
        // Om det inte finns en användare i session, hämta input från LoginView
        // Kolla om den användaren finns i databasen.
        // Om det inte finns en registrerad användare, visa felmeddelande
        // Annars logga in användaren via LoginView

        if ($this->view->userWantToLogIn()) {
            try {
                $name = $this->view->getUserName();
                var_dump($name);
                $this->user->setUserName($name);
            } catch (\Exeption $e) {
                $this->view->errorMessage($e);
            }
        }


        $user = \model\LoginModel::validateUserInput($this->user);
            if ($user === true) {
                return true;
            } else {
                return false;
            }
    }

    private function getUserFromSession(){
        throw new Exception('Not implemented yet');
    }
}