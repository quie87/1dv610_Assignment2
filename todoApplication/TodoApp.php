<?php

use TodoController\TodoController;

require_once('view/LayoutView.php');
require_once('view/TodoView.php');

require_once('model/TodoModel.php');

require_once('controller/TodoController.php');

class TodoApp {
    private $layoutView;
    private $todoView;

    private $todoModel;

    private $todoController;

    public function __construct()
    {
        $this->layoutView = new \Todoview\LayoutView();
        $this->todoView = new \TodoView\TodoView();
        $this->todoModel = new \TodoModel\TodoModel();

        $this->todoController = new TodoController($this->todoView, $this->todoModel);
    }

    public function run() {
        $this->changeState();
        $this->generateOutput();
    }

    private function changeState() {
        $userWantToAddTodo = $this->todoView->doUserWantToAddNewTodo();

        if($userWantToAddTodo)
        {
            $this->todoController->addTodo();
        }
    }

    private function generateOutput() {
        $this->layoutView->render($this->todoView);
    }
}