<?php

class Appliction 
{
    private $authentication;

    private $isLoggedIn = false;

    public function __construct ()
    {
        $this->authentication = new AuthenticationApplication();
    }

    public function run()
    {
        if ($this->isLoggedIn)
        {
            new TodoApp();
        } else
        {
            $this->isLoggedIn = $this->authentication->run();
        }
    }
}