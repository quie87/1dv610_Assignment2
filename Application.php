<?php

class Appliction 
{
    private $view;

    private $authenticationApplication;
    private $todoApplication;
    private $authController;

    public function __construct ()
    {
        $this->authenticationApplication = new AuthenticationApplication();
        $this->authController = $this->authenticationApplication->getMainController();

        $this->todoApplication = new TodoApp();
        $this->todoController = $this->todoApplication->getMainController();

        $this->view = new MainView();
    }

    public function run()
    {
        $this->changeState();
        $this->generateOutput();
    }
    
    public function changeState()
    {
        $this->authController->changeState();
        
        if ($this->authController->isLoggedIn())
        {
            $this->todoController->changeState();
        }
    }
    
    public function generateOutput()
    {
        $this->view->render($this->authController->isLoggedIn(), $this->authController->getHTML());

        if ($this->authController->isLoggedIn())
        {
            $this->view->render($this->authController->isLoggedIn(), $this->todoController->getHTML());
        } 
    }
}