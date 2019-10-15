<?php

use TodoController\TodoController;

require_once('view/LayoutView.php');
require_once('view/TodoView.php');

require_once('model/TodoModel.php');
require_once('model/PersistantDataModel.php');

require_once('controller/TodoController.php');

class TodoApp {
    private $database;
    private $layoutView;
    private $todoView;

    private $todoController;

    public function __construct()
    {
        $this->database = new \TodoModel\PersistantDataModel();

        $this->layoutView = new \Todoview\LayoutView();
        $this->todoView = new \TodoView\TodoView($this->database);

        $this->todoController = new TodoController($this->todoView, $this->database);
    }

    public function run() {
        $this->changeState();
        $this->generateOutput();
    }

    private function changeState() {
        $userWantToAddTodo = $this->todoView->doUserWantToAddNewTodo();
        $userWantToDeleteTodo = $this->todoView->userClickedDelete();

        if ($userWantToAddTodo)
        {
            $this->todoController->addTodo();
        }

        if ($userWantToDeleteTodo)
        {
            $this->todoController->deleteTodo();
        }
    }

    private function generateOutput() {
        $this->layoutView->render($this->todoView);
    }
}