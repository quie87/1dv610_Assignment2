<?php

namespace TodoController;

class MainController {    
    private $layoutView;
    private $todoView;

    private $authController;
    private $todoController;

    public function __construct($authController)
    {
        $this->authController = $authController;

        $this->layoutView = new \Todoview\LayoutView();
        $this->todoView = new \TodoView\TodoView($authController);

        $this->todoController = new \TodoController\TodoController($this->todoView);
    }

    public function run() {
        $this->changeState();
        $this->generateOutput();
    }

    public function changeState() {
        if ($this->todoView->doUserWantToAddNewTodo())
        {
            $this->todoController->addTodo();
        }

        if ($this->todoView->doUserWantToDeleteTodo())
        {
            $this->todoController->deleteTodo();
        }
    }

    public function getHTML()
    {
        return $this->todoView;
    }

    public function generateOutput() {
        $this->layoutView->render($this->getHTML());
    }
}