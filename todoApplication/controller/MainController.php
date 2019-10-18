<?php

namespace TodoController;

class MainController {
    private $persistantDataModel;
    
    private $layoutView;
    private $todoView;

    private $todoController;

    public function __construct()
    {
        $this->persistantDataModel = new \TodoModel\PersistantDataModel();

        $this->layoutView = new \Todoview\LayoutView();
        $this->todoView = new \TodoView\TodoView($this->persistantDataModel);

        $this->todoController = new \TodoController\TodoController($this->persistantDataModel, $this->todoView);
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

        if ($this->todoView->userClickedDelete())
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