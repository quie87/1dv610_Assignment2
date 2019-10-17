<?php

require_once('authentication/AuthenticationApplication.php');
require_once('todoApplication/todoApp.php');


class Appliction 
{
    private $authentication;
    private $todo;

    public function __construct ()
    {
        $this->authentication = new AuthenticationApplication();
        $this->todo = new TodoApp();
    }

    public function run()
    {
        // $this->todo->run();
        $this->authentication->run();
    }
}